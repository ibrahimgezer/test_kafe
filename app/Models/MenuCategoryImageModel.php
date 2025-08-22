<?php namespace App\Models;

use CodeIgniter\Model;

class MenuCategoryImageModel extends Model
{
    protected $table = 'menu_categories_images';
    protected $allowedFields = ['cafe_id', 'category_id','image'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}