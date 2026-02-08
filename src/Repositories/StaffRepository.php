<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Repository;

class StaffRepository extends Repository
{
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM staff WHERE staffID = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
}
