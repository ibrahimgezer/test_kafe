<?php namespace App\Models;

use CodeIgniter\Model;

class MenuProductImageModel extends Model
{
    protected $table = 'menu_products_images';
    protected $allowedFields = ['cafe_id', 'product_id','image','is_default'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}