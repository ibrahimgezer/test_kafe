<?php namespace App\Models;

use CodeIgniter\Model;

class SupportTicketModel extends Model
{
    protected $table = 'supports';
    protected $allowedFields = [
        'subscriber_id', 'title', 'message', 'status',
        'priority', 'response', 'response_by'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Kafe sahibinin talepleri
    public function getTicketsBySubscriber($subscriberId): array
    {
        return $this->where('subscriber_id', $subscriberId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    // Sistem admini için tüm talepler
    public function getAllTickets(): array
    {
        return $this->select('supports.*, subscribers.title as subscriber_name')
            ->join('subscribers', 'subscribers.id = supports.subscriber_id')
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }
}