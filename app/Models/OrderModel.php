<?php namespace App\Models;

use CodeIgniter\Database\BaseResult;
use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use ReflectionException;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'session_id', 'customer_id', 'qr_code_id', 'cafe_id', 'table_id', 'order_number',
        'customer_note', 'status', 'total_amount', 'discount', 'final_amount'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function insertOrderItems(array $items): array|bool|int|string
    {
        $db = db_connect();
        return $db->table('order_items')->insertBatch($items);
    }

    public function addStatusHistory($orderId, $status, $notes = null, $changedBy = null): Query|bool|BaseResult
    {
        $data = [
            'order_id' => $orderId,
            'status' => $status,
            'notes' => $notes,
            'changed_by' => $changedBy
        ];

        return $this->db->table('order_status_history')->insert($data);
    }

    public function getStatusHistory($orderId): array
    {
        return $this->db->table('order_status_history')
            ->where('order_id', $orderId)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getOrderWithItems($orderId): array|object|null
    {
        $order = $this->find($orderId);
        if (!$order) return null;

        $order['items'] = $this->db->table('order_items')
            ->where('order_id', $orderId)
            ->get()
            ->getResultArray();

        $order['status_history'] = $this->getStatusHistory($orderId);

        return $order;
    }

    /**
     * @throws ReflectionException
     */
    public function updateOrderStatus($orderId, $newStatus, $notes = null, $changedBy = null): bool
    {
        $result = $this->update($orderId, ['status' => $newStatus]);

        if ($result) {
            $this->addStatusHistory($orderId, $newStatus, $notes, $changedBy);
        }

        return $result;
    }
}