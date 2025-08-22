<?php namespace App\Models;

use CodeIgniter\Model;

class ShiftModel extends Model
{
    protected $table = 'shifts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'staff_id', 'start_time', 'end_time',
        'shift_type', 'notes'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'staff_id' => 'required|numeric',
        'start_time' => 'required|valid_date',
        'end_time' => 'required|valid_date',
        'shift_type' => 'required|in_list[morning,afternoon,evening,night]'
    ];

    public function getShiftsByStaff($staffId)
    {
        return $this->where('staff_id', $staffId)
            ->orderBy('start_time', 'ASC')
            ->findAll();
    }

    public function getUpcomingShifts($limit = 10)
    {
        return $this->where('start_time >=', date('Y-m-d H:i:s'))
            ->orderBy('start_time', 'ASC')
            ->limit($limit)
            ->findAll();
    }

    public function getShiftsByDateRange($startDate, $endDate)
    {
        return $this->where('start_time >=', $startDate)
            ->where('end_time <=', $endDate)
            ->orderBy('start_time', 'ASC')
            ->findAll();
    }

    public function getShiftConflict($staffId, $startTime, $endTime, $excludeId = null)
    {
        $builder = $this->db->table('shifts')
            ->where('staff_id', $staffId)
            ->groupStart()
            ->where('start_time <', $endTime)
            ->where('end_time >', $startTime)
            ->groupEnd();

        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }

        return $builder->get()->getRowArray();
    }

    /**
     * Çakışma kontrolü için metod
     */
    public function isShiftConflict($staffId, $startTime, $endTime, $excludeId = null)
    {
        $builder = $this->db->table($this->table)
            ->where('staff_id', $staffId)
            ->groupStart()
            ->where('start_time <', $endTime)
            ->where('end_time >', $startTime)
            ->groupEnd();

        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }

        return $builder->countAllResults() > 0;
    }
}