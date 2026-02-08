<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Repository;

class NewsRepository extends Repository
{
    public function getLatestNews(int $limit = 3): array
    {
        $stmt = $this->db->prepare("SELECT newstitle, description, registerdate, registertime 
                                    FROM news ORDER BY registerdate DESC, registertime DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAll(int $hotelId = 1): array
    {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE hotelID = :hotelId ORDER BY registerdate DESC, registertime DESC");
        $stmt->execute(['hotelId' => $hotelId]);
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE newsID = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO news (hotelID, newstitle, description, registerdate, registertime) 
                                    VALUES (:hotelId, :title, :description, CURRENT_DATE, CURRENT_TIME)");
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE news SET newstitle = :title, description = :description WHERE newsID = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM news WHERE newsID = :id");
        return $stmt->execute(['id' => $id]);
    }
}
