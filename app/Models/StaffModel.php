<?php namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'first_name', 'last_name', 'phone', 'email', 'image',
        'position', 'hire_date', 'salary', 'is_active'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAllStaff(): array
    {
        return $this->orderBy('first_name', 'ASC')->findAll();
    }

    public function getActiveStaff(): array
    {
        return $this->where('is_active', 1)
            ->orderBy('first_name', 'ASC')
            ->findAll();
    }

    public function searchStaff($term): array
    {
        return $this->like('first_name', $term)
            ->orLike('last_name', $term)
            ->orLike('email', $term)
            ->orLike('position', $term)
            ->orderBy('first_name', 'ASC')
            ->findAll();
    }

    /**
     * Pozisyonlara göre personel listesi getir
     */
    public function getActiveStaffByPositions(array $positions = []): array
    {
        $builder = $this->where('is_active', 1);

        if (!empty($positions)) {
            $builder->whereIn('position', $positions);
        }

        return $builder->orderBy('position', 'ASC')
            ->orderBy('first_name', 'ASC')
            ->findAll();
    }
}