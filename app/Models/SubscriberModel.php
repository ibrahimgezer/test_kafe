<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;
use Exception;

class SubscriberModel extends Model
{
    protected $table = 'subscribers';
    protected $primaryKey = 'id';
    protected $encrypter;

    public function __construct()
    {
        parent::__construct();
        $this->encrypter = Services::encrypter();
    }

    protected $allowedFields = [
        'identification_number',
        'title',
        'authorized_person',
        'phone',
        'email',
        'password',
        'price',
        'logo',
        'invoice_path',
        'note',
        'status',
        'mac_address',
        'ip_address',
        'ip_status',
        'start_date',
        'end_date',
        'created_user',
        'created_at',
        'updated_user',
        'updated_at'
    ];

    // Timestamps (created_at ve updated_at) otomatik olarak yönetilsin mi?
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Veri formatı
    protected $dateFormat = 'datetime';
    // Şifreyi şifreleme
    protected $beforeInsert = ['encryptPassword'];
    protected $beforeUpdate = ['encryptPassword'];

    public function encryptPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = $this->encrypt($data['data']['password']);
        }
        return $data;
    }

    // Şifreleme
    function encrypt($t, $k = '202502'): string
    {
        return base64_encode(openssl_encrypt($t, 'aes-128-ecb', $k));
    }

    // Çözme
    function decrypt($t, $k = '202502'): false|string
    {
        return openssl_decrypt(base64_decode($t), 'aes-128-ecb', $k);
    }



}