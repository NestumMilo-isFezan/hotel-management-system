<?php

use PHPUnit\Framework\TestCase;

class RoomManagementTest extends TestCase
{
    protected $conn;

    protected function setUp(): void
    {
        global $conn;
        $this->conn = $conn;

        // Reset test database state
        mysqli_query($this->conn, "DELETE FROM booking WHERE roomID = 101");
        mysqli_query($this->conn, "DELETE FROM room WHERE roomID = 101");
        mysqli_query($this->conn, "DELETE FROM roomtype WHERE typeID = 1");

        // Add test data for room management
        mysqli_query($this->conn, "INSERT INTO roomtype (typeID, hotelID, name, price)
            VALUES (1, 1, 'Standard', 100.00)");
    }

    public function testRoomCreation()
    {
        // Test room creation with actual schema
        $roomData = [
            'roomNo' => '101',
            'roomstatus' => 'available',
            'typeID' => 1
        ];

        $sql = "INSERT INTO room (roomID, hotelID, typeID, roomstatus, roomNo)
                VALUES ({$roomData['roomID']}, {$roomData['hotelID']}, {$roomData['typeID']},
                        '{$roomData['roomstatus']}', '{$roomData['roomNo']}')";

        $this->assertTrue(mysqli_query($this->conn, $sql));

        // Verify room was created
        $result = mysqli_query($this->conn, "SELECT * FROM room WHERE roomID = 101");
        $room = mysqli_fetch_assoc($result);

        $this->assertNotNull($room);
        $this->assertEquals($roomData['roomstatus'], $room['roomstatus']);
        $this->assertEquals($roomData['roomNo'], $room['roomNo']);
    }

    protected function tearDown(): void
    {
        // Clean up test data
        mysqli_query($this->conn, "DELETE FROM booking WHERE roomID = 101");
        mysqli_query($this->conn, "DELETE FROM room WHERE roomID = 101");
        mysqli_query($this->conn, "DELETE FROM roomtype WHERE typeID = 1");
    }
}
