<?php
declare(strict_types=1);

namespace App\Core;

use PDO;

abstract class Seeder
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    abstract public function run(): void;
}
