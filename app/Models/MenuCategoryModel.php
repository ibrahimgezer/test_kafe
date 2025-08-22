<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuCategoryModel extends Model
{
    protected $table = 'menu_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'subscriber_id',
        'cafe_id',
        'title',
        'description',
        'status',
    ];
    protected $useAutoIncrement = true;

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getMenuByCafe($cafe_id):array
    {
        return $this->where('cafe_id', $cafe_id)->findAll();
    }
}
