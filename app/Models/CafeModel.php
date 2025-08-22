<?php namespace App\Models;

use CodeIgniter\Model;

class CafeModel extends Model
{
    protected $table = 'cafes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title',
        'location',
        'owner_name',
        'owner_phone',
        'owner_email',
        'active_staff',
        'logo',
        'created_by',
        'subscriber_id',
        'updated_at'
    ];
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}