<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Repository;

class BookingRepository extends Repository
{
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO booking (roomID, guestID, serviceID, check_in, check_out, total_price, status) 
                                    VALUES (:roomId, :guestId, :serviceId, :checkIn, :checkOut, :total, 'pending')");
        return $stmt->execute([
            'roomId' => $data['roomId'],
            'guestId' => $data['guestId'],
            'serviceId' => $data['serviceId'],
            'checkIn' => $data['checkIn'],
            'checkOut' => $data['checkOut'],
            'total' => $data['total']
        ]);
    }

    public function getByStatus(string $status): array
    {
        $stmt = $this->db->prepare("SELECT booking.*, room.roomNo, guest.firstName, guest.lastName, hotelservice.name as serviceName 
                                    FROM booking
                                    JOIN room ON booking.roomID = room.roomID
                                    JOIN guest ON booking.guestID = guest.guestID
                                    LEFT JOIN hotelservice ON booking.serviceID = hotelservice.serviceID
                                    WHERE booking.status = :status");
        $stmt->execute(['status' => $status]);
        return $stmt->fetchAll();
    }

    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->db->prepare("UPDATE booking SET status = :status WHERE bookID = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM booking WHERE bookID = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM booking WHERE bookID = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function getByGuestId(int $guestId): array
    {
        $stmt = $this->db->prepare("SELECT booking.*, room.roomNo, hotelservice.name as serviceName 
                                    FROM booking
                                    JOIN room ON booking.roomID = room.roomID
                                    LEFT JOIN hotelservice ON booking.serviceID = hotelservice.serviceID
                                    WHERE booking.guestID = :guestId
                                    ORDER BY booking.check_in DESC");
        $stmt->execute(['guestId' => $guestId]);
        return $stmt->fetchAll();
    }
}
