<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;
use Config\Services;
use Psr\Log\LoggerInterface;
use RuntimeException;

class OrderController extends BaseController
{
    use ResponseTrait;

    protected Session $session;

    public function __construct()
    {
        //parent::__construct(); //çağrısını KALDIRIYORUZ
        $this->session = Services::session();
        helper('text');
    }

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        parent::initController($request, $response, $logger);
        // BaseController'daki setup'ı çağır
        $this->setupOrderController();
    }

    public function index(): ResponseInterface|string
    {
        $loggedUser = session()->get('loggedUser');
        $stableSessionId = $this->getStableSessionId(); // BaseController'dan al

        // Kullanıcı giriş yapmışsa customer_id'ye göre, yapmamışsa stable_session_id'ye göre filtrele
        $condition = $loggedUser
            ? ['customer_id' => $loggedUser['id']]
            : ['session_id' => $stableSessionId];

        // Siparişleri durumlarına göre grupla
        $orders = $this->orderModel
            ->select('orders.*, GROUP_CONCAT(order_items.product_name SEPARATOR ", ") as products')
            ->join('order_items', 'order_items.order_id = orders.id')
            ->where($condition)
            ->groupBy('orders.id')
            ->orderBy('orders.created_at', 'DESC')
            ->findAll();

        // Durumlara göre siparişleri ayır
        $data = [
            'activeOrders' => array_filter($orders, fn($order) => in_array($order['status'], ['pending', 'preparing', 'ready'])),
            'completedOrders' => array_filter($orders, fn($order) => $order['status'] === 'completed'),
            'cancelledOrders' => array_filter($orders, fn($order) => $order['status'] === 'cancelled'),
        ];

        return view('pages/orders/index', $data);
    }

    public function status($orderId): ResponseInterface|string
    {
        $loggedUser = session()->get('loggedUser');
        $stableSessionId = $this->getStableSessionId(); // BaseController'dan al

        // Siparişi kontrol et
        $order = $this->orderModel->getOrderWithItems($orderId);

        if (!$order) {
            return redirect()->to('/siparislerim')->with('error', 'Sipariş bulunamadı');
        }

        // Yetki kontrolü - stable_session_id kullan
        $condition = $loggedUser
            ? $order['customer_id'] == $loggedUser['id']
            : $order['session_id'] == $stableSessionId;

        if (!$condition) {
            return redirect()->to('/siparislerim')->with('error', 'Bu siparişi görüntüleme yetkiniz yok');
        }

        // Ödeme yöntemleri
        $paymentMethods = [
            'credit_card' => 'Kredi Kartı',
            'pay_at_table' => 'Masada Ödeme',
            'mobile_payment' => 'Mobil Ödeme'
        ];

        // Durum etiketleri
        $orderStatusArray = [
            'pending' => 'Onay Bekliyor',
            'preparing' => 'Hazırlanıyor',
            'ready' => 'Hazır',
            'completed' => 'Tamamlandı',
            'cancelled' => 'İptal Edildi'
        ];

        return view('pages/orders/status', [
            'order' => $order,
            'paymentMethods' => $paymentMethods,
            'orderStatusArray' => $orderStatusArray,
            'qrInfo' => session()->get('qr_info')
        ]);
    }

    public function createOrder()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON(['success' => false, 'message' => 'Method not allowed']);
        }

        // QR kod bilgilerini al
        $qrCode = session()->get('qrCode');
        if (!$qrCode) {
            return $this->response->setJSON(['success' => false, 'message' => 'QR kod bilgisi bulunamadı']);
        }

        // Sepet bilgilerini session'dan al
        $cartItems = $this->getFormattedCartItems();
        if (empty($cartItems['items'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Sepetiniz boş']);
        }

        // Sipariş numarası oluştur
        $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

        // QR bilgilerini al
        $qrInfo = $this->qrModel->where('code', $qrCode)->first();

        // STABLE session ID kullan (BaseController'dan al)
        $stableSessionId = $this->getStableSessionId();

        $orderData = [
            'session_id' => $stableSessionId, // STABLE ID kullan
            'customer_id' => session()->get('loggedUser')['id'] ?? null,
            'qr_code_id' => $qrInfo['id'],
            'cafe_id' => $qrInfo['cafe_id'],
            'table_id' => $qrInfo['table_id'],
            'order_number' => $orderNumber,
            'total_amount' => $cartItems['totalPrice'],
            'discount' => 0,
            'final_amount' => $cartItems['totalPrice'],
            'status' => 'pending'
        ];

        $db = db_connect();
        $db->transStart();

        try {
            // Siparişi oluştur
            $orderId = $this->orderModel->insert($orderData);

            if (!$orderId) {
                throw new RuntimeException('Sipariş oluşturulamadı');
            }

            // Sipariş öğelerini ekle
            $orderItems = [];
            foreach ($cartItems['items'] as $item) {
                $orderItems[] = [
                    'order_id' => $orderId,
                    'product_id' => $item['id'],
                    'product_name' => $item['title'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'total_price' => $item['price'] * $item['quantity'],
                    'note' => $item['note'] ?? null
                ];
            }

            $this->orderModel->insertOrderItems($orderItems);

            // Sepeti temizle (session'dan)
            $this->session->remove('cart');

            // Sipariş durum geçmişini kaydet
            $this->orderModel->addStatusHistory($orderId, 'pending', 'Sipariş oluşturuldu');

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new RuntimeException('Sipariş işlemi sırasında hata oluştu');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Siparişiniz başarıyla oluşturuldu',
                'order_id' => $orderId,
                'order_number' => $orderNumber
            ]);

        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    protected function getFormattedCartItems(): array
    {
        $cart = $this->session->get('cart') ?? ['items' => [], 'summary' => ['totalItems' => 0, 'totalPrice' => 0]];
        $items = [];
        $totalPrice = 0;
        $totalItems = 0;

        if (!empty($cart['items'])) {
            // Ürün ID'lerini topla
            $productIds = array_column($cart['items'], 'product_id');
            $products = $this->productModel
                ->select('menu_products.*, menu_products_images.image, menu_categories.title as category_title')
                ->join('menu_products_images', 'menu_products_images.product_id = menu_products.id', 'left')
                ->join('menu_categories', 'menu_categories.id = menu_products.category_id', 'left')
                ->whereIn('menu_products.id', array_unique($productIds))
                ->groupBy('menu_products.id')
                ->findAll();

            // Ürünleri ID'ye göre indeksle
            $productsById = array_column($products, null, 'id');

            foreach ($cart['items'] as $cartItemId => $cartItem) {
                if (isset($productsById[$cartItem['product_id']])) {
                    $product = $productsById[$cartItem['product_id']];
                    $items[] = [
                        'cart_item_id' => $cartItemId,
                        'id' => $product['id'],
                        'title' => $product['title'],
                        'category_title' => $product['category_title'],
                        'image' => $product['image'],
                        'price' => $product['price'],
                        'quantity' => $cartItem['quantity'],
                        'note' => $cartItem['note'] ?? '',
                        'subtotal' => $product['price'] * $cartItem['quantity'],
                        'added_at' => $cartItem['added_at']
                    ];
                }
            }

            $totalPrice = $cart['summary']['totalPrice'];
            $totalItems = $cart['summary']['totalItems'];
        }

        return [
            'items' => $items,
            'totalPrice' => $totalPrice,
            'totalItems' => $totalItems
        ];
    }

    public function orderStatus1($orderId)
    {
        $order = $this->orderModel->getOrderWithItems($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Sipariş bulunamadı');
        }

        $data = [
            'order' => $order,
            'qrInfo' => session()->get('qr_info')
        ];

        return view('order_status', $data);
    }

    public function getOrderStatus($orderId)
    {
        $order = $this->orderModel->find($orderId);

        if (!$order) {
            return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'Sipariş bulunamadı']);
        }

        return $this->response->setJSON([
            'success' => true,
            'status' => $order['status'],
            'status_history' => $this->orderModel->getStatusHistory($orderId)
        ]);
    }
}