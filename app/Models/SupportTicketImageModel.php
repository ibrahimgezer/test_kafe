<?php namespace App\Models;

use CodeIgniter\Model;

class SupportTicketImageModel extends Model
{
    protected $table = 'support_ticket_images';
    protected $allowedFields = ['ticket_id', 'message_id','image'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}