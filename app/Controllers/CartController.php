<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;
use Config\Services;

class CartController extends BaseController
{
    use ResponseTrait;

    protected Session $session;

    public function __construct()
    {
        $this->session = Services::session();
        helper('text');
    }

    public function index(): ResponseInterface|string
    {

        $cartItems = $this->getFormattedCartItems();
        $qrInfo = session()->get('qrCode');

        $data = [
            'title' => 'Sepetim',
            'cartItems' => $cartItems,
            'totalPrice' => $cartItems['totalPrice'] ?? 0,
            'totalItems' => $cartItems['totalItems'] ?? 0,
            'discount' => $cartItems['discount'] ?? 0,
            'deliveryCharge' => $cartItems['deliveryCharge'] ?? 0,
            'grandTotal' => ($cartItems['totalPrice'] ?? 0) - ($cartItems['discount'] ?? 0) + ($cartItems['deliveryCharge'] ?? 0),
            'qrInfo' => $qrInfo // QR bilgisini view'a gönderiyoruz
        ];

        return $this->render('pages/cart/index', $data);

        var_dump($this->getStableSessionId());
        exit();
    }
    public function index1(): ResponseInterface|string
    {
        $cartItems = $this->getFormattedCartItems();

        if (empty($cartItems) || $cartItems['totalItems'] <= 0) {
            return redirect()->to(base_url('auth'))->with('error', 'Sepetiniz boş, lütfen giriş yapın');
        }

        $data = [
            'title' => 'Sepetim',
            'cartItems' => $cartItems,
            'totalPrice' => $cartItems['totalPrice'] ?? 0,
            'totalItems' => $cartItems['totalItems'] ?? 0,
            'discount' => $cartItems['discount'] ?? 0,
            'deliveryCharge' => $cartItems['deliveryCharge'] ?? 0,
            'grandTotal' => ($cartItems['totalPrice'] ?? 0) - ($cartItems['discount'] ?? 0) + ($cartItems['deliveryCharge'] ?? 0)
        ];

        return $this->render('pages/cart/index', $data);

    }

    public function add(): ResponseInterface
    {
        $request = service('request');

        if (!$request->isAJAX()) {
            return $this->respondError('Geçersiz istek', 400);
        }

        $json = $request->getJSON();
        $productId = $json->product_id ?? null;
        $quantity = $json->quantity ?? 1;
        $note = $json->note ?? '';

        if (!$productId) {
            return $this->respondError('Ürün ID gereklidir', 400);
        }

        // Ürün varlığını kontrol et
        $product = $this->productModel->find($productId);
        if (!$product) {
            return $this->respondError('Ürün bulunamadı', 404);
        }

        // Sepet yapısını al veya oluştur
        $cart = $this->session->get('cart') ?? [
            'items' => [],
            'summary' => [
                'totalItems' => 0,
                'totalPrice' => 0
            ]
        ];

        // Benzersiz bir cart item ID oluştur
        $cartItemId = uniqid('ci_', true);

        // Yeni ürünü sepete ekle
        $cart['items'][$cartItemId] = [
            'product_id' => $productId,
            'quantity' => $quantity,
            'note' => $note,
            'price' => $product['price'],
            'added_at' => time()
        ];

        // Sepet özetini güncelle
        $cart['summary']['totalItems'] += $quantity;
        $cart['summary']['totalPrice'] += ($product['price'] * $quantity);

        // Session'ı güncelle
        $this->session->set('cart', $cart);

        return $this->respondSuccess([
            'cartCount' => $cart['summary']['totalItems'],
            'cart_item_id' => $cartItemId,
            'message' => 'Ürün sepete eklendi'
        ]);
    }

    public function update(): ResponseInterface
    {
        $request = service('request');

        if (!$request->isAJAX()) {
            return $this->respondError('Geçersiz istek', 400);
        }

        $json = $request->getJSON();
        $cartItemId = $json->cart_item_id ?? null;
        $quantity = $json->quantity ?? 1;
        $note = $json->note ?? null;

        if (!$cartItemId) {
            return $this->respondError('Sepet öğe ID gereklidir', 400);
        }

        $cart = $this->session->get('cart');

        if (!isset($cart['items'][$cartItemId])) {
            return $this->respondError('Sepet öğesi bulunamadı', 404);
        }

        // Eski miktarı ve fiyatı kaydet
        $oldQuantity = $cart['items'][$cartItemId]['quantity'];
        $price = $cart['items'][$cartItemId]['price'];

        // Güncelleme yap
        $cart['items'][$cartItemId]['quantity'] = $quantity;

        if ($note !== null) {
            $cart['items'][$cartItemId]['note'] = $note;
        }

        // Sepet özetini güncelle
        $quantityDiff = $quantity - $oldQuantity;
        $cart['summary']['totalItems'] += $quantityDiff;
        $cart['summary']['totalPrice'] += ($price * $quantityDiff);

        // Session'ı güncelle
        $this->session->set('cart', $cart);

        $formattedCart = $this->getFormattedCartItems();

        return $this->respondSuccess([
            'cartCount' => $cart['summary']['totalItems'],
            'totalPrice' => number_format($formattedCart['totalPrice'], 2),
            'item_subtotal' => number_format($price * $quantity, 2)
        ]);
    }

    public function remove(): ResponseInterface
    {
        $request = service('request');

        if (!$request->isAJAX()) {
            return $this->respondError('Geçersiz istek', 400);
        }

        $json = $request->getJSON();
        $cartItemId = $json->cart_item_id ?? null;

        if (!$cartItemId) {
            return $this->respondError('Sepet öğe ID gereklidir', 400);
        }

        $cart = $this->session->get('cart');

        if (!isset($cart['items'][$cartItemId])) {
            return $this->respondError('Sepet öğesi bulunamadı', 404);
        }

        // Kaldırılacak ürün bilgilerini al
        $removedItem = $cart['items'][$cartItemId];

        // Sepet özetini güncelle
        $cart['summary']['totalItems'] -= $removedItem['quantity'];
        $cart['summary']['totalPrice'] -= ($removedItem['price'] * $removedItem['quantity']);

        // Ürünü sepetten kaldır
        unset($cart['items'][$cartItemId]);

        // Session'ı güncelle
        $this->session->set('cart', $cart);

        $formattedCart = $this->getFormattedCartItems();

        return $this->respondSuccess([
            'cartCount' => $cart['summary']['totalItems'],
            'totalPrice' => number_format($formattedCart['totalPrice'], 2),
            'message' => 'Ürün sepetten kaldırıldı'
        ]);
    }

    public function clear(): ResponseInterface
    {
        if ($this->request->isAJAX()) {
            $this->session->remove('cart');
            return $this->respondSuccess([], 'Sepetiniz başarıyla boşaltıldı');
        }

        $this->session->remove('cart');
        return redirect()->to('sepet')->with('success', 'Sepetiniz başarıyla boşaltıldı');
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

    protected function respondSuccess($data = [], string $message = 'İşlem başarılı'): ResponseInterface
    {
        return $this->response->setJSON([
            'success' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function respondError(string $message, int $statusCode = 400, $errors = []): ResponseInterface
    {
        return $this->response
            ->setStatusCode($statusCode)
            ->setJSON([
                'success' => false,
                'message' => $message,
                'errors' => $errors
            ]);
    }
}