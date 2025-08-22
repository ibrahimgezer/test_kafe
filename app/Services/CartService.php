<?php
namespace App\Services;

use CodeIgniter\Session\Session;
use Config\Services;

class CartService
{
    protected Session $session;

    public function __construct()
    {
        $this->session = Services::session();
    }

    public function removeItem($productId): bool
    {
        $cart = $this->session->get('cart') ?? [];

        if(isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->session->set('cart', $cart);
            return true;
        }

        return false;
    }

    public function getItemCount(): int
    {
        $cart = $this->session->get('cart') ?? [];
        return count($cart);
    }

    public function getTotalPrice()
    {
        // Toplam fiyat hesaplama mantığı
    }
}