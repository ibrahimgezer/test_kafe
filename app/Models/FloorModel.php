<?php namespace App\Models;

use CodeIgniter\Model;

class FloorModel extends Model
{
    protected $table = 'floors';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'cafe_id',
        'title',
        'floor_number',
        'layout_image',
        'description',
        'status',
        'subscriber_id',
        'created_by',
        'updated_at'
    ];
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getFloorsByCafe($cafe_id)
    {
        return $this->where('cafe_id', $cafe_id)->findAll();
    }
}