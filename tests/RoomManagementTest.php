<?php

use PHPUnit\Framework\TestCase;

class RoomManagementTest extends TestCase
{
    protected $conn;

    protected function setUp(): void
    {
        global $conn;
        $this->conn = $conn;

        // Reset the test database state
        mysqli_query($this->conn, "DELETE FROM room WHERE roomID IN (101, 102, 103)");
    }

    public function testCreateRoom()
    {
        $roomData = [
            'roomID' => 101,
            'roomstatus' => 'available'
        ];

        // Insert room using direct SQL
        $sql = "INSERT INTO room (roomID, roomstatus)
                VALUES ({$roomData['roomID']}, '{$roomData['roomstatus']}')";
        $result = mysqli_query($this->conn, $sql);

        $this->assertTrue($result);

        // Verify room exists in database
        $checkSql = "SELECT * FROM room WHERE roomID = {$roomData['roomID']}";
        $result = mysqli_query($this->conn, $checkSql);
        $room = mysqli_fetch_assoc($result);

        $this->assertNotNull($room);
        $this->assertEquals($roomData['roomstatus'], $room['roomstatus']);
    }

    public function testRoomTypeAssignment()
    {
        // First create a room type
        $roomTypeSql = "INSERT INTO room_types (name, price) VALUES ('Deluxe', 100)";
        mysqli_query($this->conn, $roomTypeSql);
        $typeId = mysqli_insert_id($this->conn);

        // Create a room
        $roomSql = "INSERT INTO rooms (room_number, type_id) VALUES ('102', $typeId)";
        mysqli_query($this->conn, $roomSql);

        // Verify room type assignment
        $checkSql = "SELECT r.room_number, rt.name, rt.price
                    FROM rooms r
                    JOIN room_types rt ON r.type_id = rt.id
                    WHERE r.room_number = '102'";
        $result = mysqli_query($this->conn, $checkSql);
        $room = mysqli_fetch_assoc($result);

        $this->assertEquals('Deluxe', $room['name']);
        $this->assertEquals(100, $room['price']);
    }

    public function testRoomAvailabilityCheck()
    {
        // Create a room with initial available status
        $sql = "INSERT INTO rooms (room_number, status) VALUES ('103', 'available')";
        mysqli_query($this->conn, $sql);

        // Check initial availability
        $checkSql = "SELECT status FROM rooms WHERE room_number = '103'";
        $result = mysqli_query($this->conn, $checkSql);
        $room = mysqli_fetch_assoc($result);
        $this->assertEquals('available', $room['status']);

        // Update room status to occupied
        $updateSql = "UPDATE rooms SET status = 'occupied' WHERE room_number = '103'";
        mysqli_query($this->conn, $updateSql);

        // Verify status change
        $result = mysqli_query($this->conn, $checkSql);
        $room = mysqli_fetch_assoc($result);
        $this->assertEquals('occupied', $room['status']);
    }

    protected function tearDown(): void
    {
        // Clean up test data
        mysqli_query($this->conn, "DELETE FROM rooms WHERE room_number IN ('101', '102', '103')");
        mysqli_query($this->conn, "DELETE FROM room_types WHERE name = 'Deluxe'");
    }
}
