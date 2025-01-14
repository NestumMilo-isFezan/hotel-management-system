<?php

use PHPUnit\Framework\TestCase;

class CheckInOutTest extends TestCase
{
    protected $conn;

    protected function setUp(): void
    {
        global $conn;
        $this->conn = $conn;

        // Reset test database state
        mysqli_query($this->conn, "DELETE FROM booking WHERE bookID = 1");
        mysqli_query($this->conn, "DELETE FROM room WHERE roomID = 101");

        // Create test data
        mysqli_query($this->conn, "INSERT INTO room (roomID, roomstatus) VALUES (101, 'available')");
        mysqli_query($this->conn, "INSERT INTO booking (bookID, roomID, status) VALUES (1, 101, 'confirmed')");
    }

    public function testCheckIn()
    {
        $bookingId = 1;

        // Process check-in
        $updateBookingSql = "UPDATE booking SET status = 'checkin' WHERE bookID = $bookingId";
        $updateRoomSql = "UPDATE room r
                         JOIN booking b ON r.roomID = b.roomID
                         SET r.roomstatus = 'occupied'
                         WHERE b.bookID = $bookingId";

        $result1 = mysqli_query($this->conn, $updateBookingSql);
        $result2 = mysqli_query($this->conn, $updateRoomSql);

        $this->assertTrue($result1 && $result2);

        // Verify status changes
        $bookingStatus = $this->getBookingStatus($bookingId);
        $roomStatus = $this->getRoomStatus($bookingId);

        $this->assertEquals('checkin', $bookingStatus);
        $this->assertEquals('occupied', $roomStatus);
    }

    public function testCheckOut()
    {
        $bookingId = 1;

        // Process check-out
        $updateBookingSql = "UPDATE booking SET status = 'checkout' WHERE bookID = $bookingId";
        $updateRoomSql = "UPDATE room r
                         JOIN booking b ON r.roomID = b.roomID
                         SET r.roomstatus = 'available'
                         WHERE b.bookID = $bookingId";

        $result1 = mysqli_query($this->conn, $updateBookingSql);
        $result2 = mysqli_query($this->conn, $updateRoomSql);

        $this->assertTrue($result1 && $result2);

        // Verify status changes
        $bookingStatus = $this->getBookingStatus($bookingId);
        $roomStatus = $this->getRoomStatus($bookingId);

        $this->assertEquals('checkout', $bookingStatus);
        $this->assertEquals('available', $roomStatus);
    }

    private function getBookingStatus($bookingId)
    {
        $sql = "SELECT status FROM booking WHERE bookID = $bookingId";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['status'];
    }

    private function getRoomStatus($bookingId)
    {
        $sql = "SELECT r.roomstatus FROM room r
                JOIN booking b ON r.roomID = b.roomID
                WHERE b.bookID = $bookingId";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['roomstatus'];
    }

    protected function tearDown(): void
    {
        // Clean up test data
        mysqli_query($this->conn, "DELETE FROM booking WHERE bookID = 1");
        mysqli_query($this->conn, "DELETE FROM room WHERE roomID = 101");
    }
}
