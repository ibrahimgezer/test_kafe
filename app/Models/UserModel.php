<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class UserModel extends Model
{
    protected $table = 'users'; // Tablo adı
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = [
        'name_surname',
        'email',
        'password',
        'type',
        'subscriber_id'
    ];
    protected $useTimestamps = true; // created_at ve updated_at otomatik yönetilsin
    protected $createdField = 'created_at'; // Oluşturulma tarihi alanı
    protected $updatedField = 'updated_at'; // Güncellenme tarihi alanı
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