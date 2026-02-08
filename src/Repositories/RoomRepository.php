<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Repository;

class RoomRepository extends Repository
{
    public function getRoomWithDetails(int $roomId, int $hotelId = 1): ?array
    {
        $stmt = $this->db->prepare("SELECT room.*, roomtype.*
                                    FROM room JOIN roomtype
                                    ON room.typeID = roomtype.typeID
                                    WHERE room.hotelID = :hotelId AND room.roomID = :roomId");
        $stmt->execute(['hotelId' => $hotelId, 'roomId' => $roomId]);
        $data = $stmt->fetch();
        
        if ($data) {
            $data['roomimg'] = "/upload/roomtype/" . ($data['room_imgpath'] ?: 'default.jpg');
        }
        
        return $data ?: null;
    }

    public function getAllAvailableRooms(int $hotelId = 1): array
    {
        $stmt = $this->db->prepare("SELECT room.*, roomtype.*, room.roomID as roomID
                                    FROM room JOIN roomtype
                                    ON room.typeID = roomtype.typeID
                                    WHERE room.hotelID = :hotelId AND room.roomstatus = 'available'");
        $stmt->execute(['hotelId' => $hotelId]);
        return $stmt->fetchAll();
    }

    public function getAll(int $hotelId = 1): array
    {
        $stmt = $this->db->prepare("SELECT room.*, roomtype.name as typeName, roomtype.price, roomtype.capacity
                                    FROM room JOIN roomtype
                                    ON room.typeID = roomtype.typeID
                                    WHERE room.hotelID = :hotelId");
        $stmt->execute(['hotelId' => $hotelId]);
        return $stmt->fetchAll();
    }

    public function getRoomTypes(int $hotelId = 1): array
    {
        $stmt = $this->db->prepare("SELECT * FROM roomtype WHERE hotelID = :hotelId");
        $stmt->execute(['hotelId' => $hotelId]);
        return $stmt->fetchAll();
    }

    public function createRoomType(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO roomtype (hotelID, name, description, price, capacity, room_imgpath) 
                                    VALUES (:hotelId, :name, :description, :price, :capacity, :img)");
        return $stmt->execute($data);
    }

    public function deleteRoomType(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM roomtype WHERE typeID = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function findRoomTypeById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM roomtype WHERE typeID = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO room (hotelID, typeID, roomNo, roomstatus) VALUES (:hotelId, :typeId, :roomNo, :status)");
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE room SET typeID = :typeId, roomNo = :roomNo, roomstatus = :status WHERE roomID = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->db->prepare("UPDATE room SET roomstatus = :status WHERE roomID = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM room WHERE roomID = :id");
        return $stmt->execute(['id' => $id]);
    }
}
