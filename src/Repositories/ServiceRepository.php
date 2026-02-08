<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Repository;

class ServiceRepository extends Repository
{
    public function getAvailableServices(int $hotelId = 1): array
    {
        $stmt = $this->db->prepare("SELECT * FROM hotelservice WHERE hotelID = :hotelId AND servicestatus = 'available'");
        $stmt->execute(['hotelId' => $hotelId]);
        return $stmt->fetchAll();
    }

    public function getAll(int $hotelId = 1): array
    {
        $stmt = $this->db->prepare("SELECT * FROM hotelservice WHERE hotelID = :hotelId");
        $stmt->execute(['hotelId' => $hotelId]);
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM hotelservice WHERE serviceID = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO hotelservice (hotelID, name, description, price, servicestatus) 
                                    VALUES (:hotelId, :name, :description, :price, :status)");
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE hotelservice SET name = :name, description = :description, price = :price, servicestatus = :status 
                                    WHERE serviceID = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM hotelservice WHERE serviceID = :id");
        return $stmt->execute(['id' => $id]);
    }
}
