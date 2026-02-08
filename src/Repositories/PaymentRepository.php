<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Repository;

class PaymentRepository extends Repository
{
    public function getLatestPaymentByBookingId(int $bookingId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM payment WHERE bookID = :id ORDER BY paymentdate DESC, paymenttime DESC LIMIT 1");
        $stmt->execute(['id' => $bookingId]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO payment (bookID, amountpay, balance, method, paymentdate, paymenttime) 
                                    VALUES (:bookId, :amount, :balance, :method, CURRENT_DATE, CURRENT_TIME)");
        return $stmt->execute($data);
    }
}
