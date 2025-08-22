<?php namespace App\Models;

use CodeIgniter\Model;
use Random\RandomException;
use ReflectionException;

class QRCodeModel extends Model
{
    protected $table = 'qr_codes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'subscriber_id', 'cafe_id', 'floor_id', 'table_id', 'code', 'url', 'status'
    ];
    protected $useTimestamps = true;

    /**
     * @throws ReflectionException
     * @throws RandomException
     */
}