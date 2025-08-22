<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class QrMenuController extends BaseController
{
    use ResponseTrait;

    // QR Kodla giriş yapılmış ana sayfası
    public function index($qrCode): ResponseInterface|string
    {
        session()->set('qrCode', $qrCode);

        $qrData = $this->qrModel->where('code', $qrCode)->first();

        if (empty($qrData) || $qrData['status'] != "1") {
            return $this->respondData('error', [], 'Hata oluştu', 500, [
                'message' => "Qr kog geçersiz veya hatalı bu nedenle isteğiniz gerçekleştirilemiyor.",
                'file' => "",
                'line' => ""
            ]);
            //throw PageNotFoundException::forPageNotFound();
        }

        // Cafe bilgilerini getir
        $cafe = $this->cafeModel->find($qrData['cafe_id']);

        // Kategorileri ve ürünleri getir
        $categories = $this->categoryModel
            ->where('cafe_id', $qrData['cafe_id'])
            ->where('status', '1')
            ->findAll();

        // Her kategori için ürünleri getir
        foreach ($categories as &$category) {
            $category['products'] = $this->productModel
                ->where('cafe_id', $qrData['cafe_id'])
                ->where('category_id', $category['id'])
                ->where('status', '1')
                ->findAll();

            // Her ürün için resimleri getir
            foreach ($category['products'] as &$product) {
                $product['images'] = $this->productImageModel
                    ->where('product_id', $product['id'])
                    ->findAll();
            }

            // Kategori resmini getir
            $category['image'] = $this->categoryImageModel
                ->where('category_id', $category['id'])
                ->first();
        }

        $cafeData = session()->get('qrData');

        //var_dump($cafeData);exit();

        if ($cafeData == NULL) {
            session()->set([
                'qrData' => [
                    'data' => $qrData,
                    'cafe' => $cafe,
                    'categories' => $categories,
                    'tableNumber' => $qrData['table_id'],
                    'floorNumber' => $qrData['floor_id']
                ]
            ]);
            return redirect()->to('_qrmenu/' . $qrCode); // Örnek route
        }

        $data = [
            'title' => $cafe['title'] . ' Menü',
        ];

        return $this->render('pages/categories/index', $data);
    }

    public function products($category): ResponseInterface|string
    {
        $cafeData = session()->get('qrData');
        if (!$cafeData) {
            return redirect()->to('/auth');
        }

        // Kategori verisini getir
        $categoryData = $this->categoryModel->select('*')->find($category);

        if (!$categoryData) {
            return $this->respondData('error', [], 'Hata oluştu', 500, [
                'message' => "Kategori numarası geçersiz veya hatalı bu nedenle isteğiniz gerçekleştirilemiyor.",
                'file' => "",
                'line' => ""
            ]);
        }

        // Cafe bilgilerini getir
        $cafe = $this->cafeModel->select('id, title')->find($categoryData['cafe_id']);

        // Kategori resimlerini getir
        $categoryImageData = $this->categoryImageModel
            ->where('category_id', $category)
            ->findAll();

        $categoryData['image'] = $categoryImageData ?? null;

        // Tüm aktif kategorileri getir
        $categories = $this->categoryModel
            ->where('cafe_id', $categoryData['cafe_id'])
            ->where('status', '1')
            ->findAll();

        // Tüm ürünleri getir
        $allProducts = $this->productModel
            ->where('category_id', $category)
            ->where('status', '1')
            ->orderBy('price', 'DESC')
            ->findAll();

        // Ürün resimlerini getir (sadece ürün varsa)
        $productImages = [];
        $imagesByProductId = [];

        if (!empty($allProducts)) {
            $productIds = array_column($allProducts, 'id');
            if (!empty($productIds)) {
                $productImages = $this->productImageModel
                    ->whereIn('product_id', $productIds)
                    ->findAll();

                foreach ($productImages as $image) {
                    $imagesByProductId[$image['product_id']][] = $image;
                }
            }
        }

        // Yeni ürün kontrolü
        $oneWeekAgo = date('Y-m-d H:i:s', strtotime('-1 week'));
        foreach ($allProducts as &$product) {
            $product['images'] = $imagesByProductId[$product['id']] ?? [];
            $product['is_new'] = (!empty($product['created_at']) && $product['created_at'] >= $oneWeekAgo);
        }

        $data = [
            'title' => $cafe['title'] . ' Menü',
            'cafe' => $cafe,
            'categories' => $categories,
            'products' => $allProducts,
            'category' => $categoryData,
            'default_sort' => 'price_desc'
        ];

        //edited_var_dump($data); exit();

        return $this->render('pages/products/index', $data);
    }

    private function respondData($status, $data, $message, $code, $errors = []): ResponseInterface
    {
        return Services::response()->setJSON([
            'status' => $status,
            'data' => $data,
            'message' => $message,
            'errors' => $errors
        ])->setStatusCode($code);
    }

    public function search()
    {
        $request = service('request');
        $term = $request->getGet('term');
        $categoryId = $request->getGet('category');

        // Veritabanında arama yap
        $builder = $this->productModel->builder();

        $builder->select('menu_products.*, menu_products_images.image as image')
            ->join('menu_products_images', 'menu_products_images.product_id = menu_products.id', 'left')
            ->groupBy('menu_products.id')
            ->like('menu_products.title', $term)
            ->where('menu_products.category_id', $categoryId)
            ->where('menu_products.status', 1)
            ->limit(10);

        $results = $builder->get()->getResultArray();

        // Sonuçları formatla
        $formattedResults = array_map(function ($product) {
            return [
                'id' => $product['id'],
                'title' => $product['title'],
                'price' => $product['price'],
                'image' => $product['image'] ?
                    'http://localhost/web_kafe_otomasyon/public/backend/assets/images/products/' . $product['image'] :
                    'http://localhost/web_kafe_otomasyon/public/assets/images/placeholder.jpg'
            ];
        }, $results);

        return $this->response->setJSON([
            'success' => true,
            'results' => $formattedResults
        ]);
    }

}