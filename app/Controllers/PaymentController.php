<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class PaymentController extends BaseController
{
    use ResponseTrait;

    public function processPayment($orderId): ResponseInterface
    {
        $loggedUser = session()->get('loggedUser');
        $orderModel = model('OrderModel');

        $order = $orderModel->find($orderId);
        if (!$order) {
            return $this->respond([
                'success' => false,
                'message' => 'Sipariş bulunamadı'
            ], 404);
        }

        // Yetki kontrolü
        if ($loggedUser && $order['customer_id'] != $loggedUser['id']) {
            return $this->respond([
                'success' => false,
                'message' => 'Bu işlem için yetkiniz yok'
            ], 403);
        }

        // Ödeme işlemini gerçekleştir
        $paymentMethod = $this->request->getPost('payment_method');

        // Ödeme işlemleri burada yapılacak
        // Gerçek bir uygulamada payment gateway entegrasyonu olmalı

        // Ödeme başarılı ise sipariş durumunu güncelle
        $orderModel->update($orderId, [
            'payment_method' => $paymentMethod,
            'payment_status' => 'completed'
        ]);

        // Durum geçmişine ekle
        $orderModel->addStatusHistory($orderId, 'completed', 'Ödeme alındı');

        return $this->respond([
            'success' => true,
            'message' => 'Ödeme başarıyla alındı',
            'data' => [
                'order_id' => $orderId,
                'payment_method' => $paymentMethod
            ]
        ]);
    }
}