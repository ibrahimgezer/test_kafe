<?php namespace App\Models;

use CodeIgniter\Model;

class SupportTicketMessageModel extends Model
{
    protected $table = 'support_messages';
    protected $allowedFields = ['ticket_id', 'sender_type', 'message'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getMessagesWithImages($ticketId): array
    {
        return $this->select('support_messages.*, 
        GROUP_CONCAT(support_ticket_images.image) as images')
            ->join('support_ticket_images', 'support_ticket_images.message_id = support_messages.id', 'left')
            ->where('support_messages.ticket_id', $ticketId)
            ->groupBy('support_messages.id')
            ->orderBy('support_messages.created_at', 'ASC')
            ->findAll();
    }
}