<?php namespace App\Models;

use CodeIgniter\Model;

class TableModel extends Model
{
    protected $table = 'tables';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'cafe_id',
        'floor_id',
        'title',
        'qr_code',
        'capacity',
        'position_x',
        'position_y',
        'shape',
        'width',
        'height',
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

    public function getTablesByFloor($floor_id)
    {
        return $this->where('floor_id', $floor_id)->findAll();
    }
}