<?php
namespace App\Models;

use CodeIgniter\Model;

class MenuProductModel extends Model
{
    protected $table = 'menu_products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['subscriber_id', 'cafe_id', 'category_id', 'title', 'description', 'price', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}