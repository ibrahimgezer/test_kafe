<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    // Tablo adı
    protected $table = 'customers';

    // Primary key
    protected $primaryKey = 'id';

    // Otomatik artan ID
    protected $useAutoIncrement = true;

    // Veri ekleme/güncelleme için izin verilen alanlar
    protected $allowedFields = [
        'subscriber_id',
        'fullname',
        'email',
        'phone',
        'email',
        'password',
        'photo',
        'birth_date',
        'status',
        'login_date',
        'created_at',
        'updated_at'
    ];

    // Timestamps kullanımı (created_at ve updated_at otomatik yönetilsin)
    protected $useTimestamps = true;
    protected $createdField = 'created_at'; // Oluşturulma tarihi alanı
    protected $updatedField = 'updated_at'; // Güncellenme tarihi alanı

    // Şifreyi hashleme (kullanıcı eklerken veya güncellerken)
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Şifreyi hashleme işlemi
     *
     * @param array $data
     * @return array
     */
    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    /**
     * E-posta ve şifre ile müşteri bulma
     *
     * @param string $email
     * @param string $password
     * @return array|null
     */
    public function findByEmailAndPassword(string $email, string $password): ?array
    {
        $customer = $this->where('email', $email)->first();

        if ($customer && password_verify($password, $customer['password'])) {
            return $customer;
        }

        return null;
    }

    /**
     * Aktif müşterileri getirme
     *
     * @return array
     */
    public function getActiveCustomers(): array
    {
        return $this->where('status', 1)->findAll();
    }

    /**
     * Belirli bir tarih aralığındaki müşterileri getirme
     *
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function getCustomersByDateRange(string $startDate, string $endDate): array
    {
        return $this->where('start_date >=', $startDate)
            ->where('end_date <=', $endDate)
            ->findAll();
    }
}