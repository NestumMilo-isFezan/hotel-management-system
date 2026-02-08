<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Repositories\UserRepository;
use App\Core\Database;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepo;
    private \PDO $db;

    protected function setUp(): void
    {
        $this->userRepo = new UserRepository();
        $this->db = Database::getConnection();
        $this->db->beginTransaction(); // Wrap test in transaction
    }

    protected function tearDown(): void
    {
        $this->db->rollBack(); // Rollback to keep DB clean
    }

    public function testCreateAndFindUser()
    {
        $data = [
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'password123'
        ];

        $userId = $this->userRepo->create($data);
        $this->assertGreaterThan(0, $userId);

        $user = $this->userRepo->findByEmail('test@example.com');
        $this->assertNotNull($user);
        $this->assertEquals('testuser', $user['username']);
    }
}
