<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Repository;

class DashboardRepository extends Repository
{
    public function getStats(): array
    {
        return [
            'pending' => $this->db->query("SELECT COUNT(*) FROM booking WHERE status = 'pending'")->fetchColumn(),
            'checkin' => $this->db->query("SELECT COUNT(*) FROM booking WHERE status = 'checkin'")->fetchColumn(),
            'checkout' => $this->db->query("SELECT COUNT(*) FROM booking WHERE status = 'checkout'")->fetchColumn(),
            'cancelled' => $this->db->query("SELECT COUNT(*) FROM booking WHERE status = 'cancelled'")->fetchColumn(),
            'total_sales' => (float)$this->db->query("SELECT SUM(amountpay - balance) FROM payment")->fetchColumn(),
            'total_rooms' => $this->db->query("SELECT COUNT(*) FROM room")->fetchColumn(),
            'available_rooms' => $this->db->query("SELECT COUNT(*) FROM room WHERE roomstatus = 'available'")->fetchColumn(),
            'occupied_rooms' => $this->db->query("SELECT COUNT(*) FROM room WHERE roomstatus = 'unavailable'")->fetchColumn()
        ];
    }
}
