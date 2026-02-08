<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Repositories\RoomRepository;
use App\Core\Database;

class RoomRepositoryTest extends TestCase
{
    private RoomRepository $roomRepo;
    private \PDO $db;

    protected function setUp(): void
    {
        $this->roomRepo = new RoomRepository();
        $this->db = Database::getConnection();
        $this->db->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->db->rollBack();
    }

    public function testCreateAndGetRoom()
    {
        // 1. Create Room Type
        $typeData = [
            'hotelId' => 1,
            'name' => 'Test Suite',
            'description' => 'A test suite',
            'price' => 100.00,
            'capacity' => 2,
            'img' => 'test.jpg'
        ];
        $this->roomRepo->createRoomType($typeData);
        $typeId = (int)$this->db->lastInsertId();

        // 2. Create Room
        $roomData = [
            'hotelId' => 1,
            'typeId' => $typeId,
            'roomNo' => 'T101',
            'status' => 'available'
        ];
        $this->roomRepo->create($roomData);
        $roomId = (int)$this->db->lastInsertId();

        // 3. Verify
        $room = $this->roomRepo->getRoomWithDetails($roomId);
        $this->assertNotNull($room);
        $this->assertEquals('T101', $room['roomNo']);
        $this->assertEquals('Test Suite', $room['name']);
    }
}
