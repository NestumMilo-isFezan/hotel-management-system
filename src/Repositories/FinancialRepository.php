<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Repository;

class FinancialRepository extends Repository
{
    public function getSummary(): array
    {
        return [
            'total_revenue' => (float)$this->db->query("SELECT SUM(amountpay) FROM payment")->fetchColumn(),
            'total_transactions' => (int)$this->db->query("SELECT COUNT(*) FROM payment")->fetchColumn(),
            'avg_transaction' => (float)$this->db->query("SELECT AVG(amountpay) FROM payment")->fetchColumn(),
        ];
    }

    public function getRevenueByMethod(): array
    {
        $stmt = $this->db->query("SELECT method, SUM(amountpay) as total, COUNT(*) as count 
                                  FROM payment 
                                  GROUP BY method 
                                  ORDER BY total DESC");
        return $stmt->fetchAll();
    }

    public function getDailyRevenue(int $days = 30): array
    {
        $stmt = $this->db->prepare("SELECT paymentdate, SUM(amountpay) as total 
                                    FROM payment 
                                    WHERE paymentdate >= DATE(NOW() - INTERVAL :days DAY)
                                    GROUP BY paymentdate 
                                    ORDER BY paymentdate ASC");
        $stmt->execute(['days' => $days]);
        return $stmt->fetchAll();
    }

    public function getAllTransactions(): array
    {
        $stmt = $this->db->query("SELECT p.*, g.firstName, g.lastName 
                                  FROM payment p
                                  JOIN booking b ON p.bookID = b.bookID
                                  JOIN guest g ON b.guestID = g.guestID
                                  ORDER BY p.paymentdate DESC, p.paymenttime DESC");
        return $stmt->fetchAll();
    }
}
