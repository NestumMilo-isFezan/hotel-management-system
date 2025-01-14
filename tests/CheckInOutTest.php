<?php

use PHPUnit\Framework\TestCase;

class CheckInOutTest extends TestCase
{
    protected $conn;

    protected function setUp(): void
    {
        global $conn;
        $this->conn = $conn;

        // Start transaction for test isolation
        mysqli_begin_transaction($this->conn);

        // Add test data
        $roomsql = "INSERT INTO room (hotelID, typeID, roomstatus, roomNo)
        VALUES (1, 'single', 'available', '101')";
        mysqli_query($this->conn, $roomsql);

        $booksql = "INSERT INTO booking(roomID, guestID, serviceID, check_in, check_out, total_price, status)
        VALUES(101, 1, 1, '2024-01-01', '2024-01-02', 100, 'pending')";
        mysqli_query($this->conn, $booksql);
    }

    public function testCheckIn()
    {
        $bookId = 1;
        $roomId = 101;

        // Update both booking and room status
        $bookingSql = "UPDATE booking SET status = 'checkin' WHERE bookID = $bookId";
        $roomSql = "UPDATE room SET roomstatus = 'occupied' WHERE roomID = $roomId";

        $bookingResult = mysqli_query($this->conn, $bookingSql);
        $roomResult = mysqli_query($this->conn, $roomSql);

        $this->assertTrue($bookingResult && $roomResult);

        // Verify both statuses were updated
        $checkBookingSql = "SELECT status FROM booking WHERE bookID = $bookId";
        $checkRoomSql = "SELECT roomstatus FROM room WHERE roomID = $roomId";

        $bookingResult = mysqli_query($this->conn, $checkBookingSql);
        $roomResult = mysqli_query($this->conn, $checkRoomSql);

        $booking = mysqli_fetch_assoc($bookingResult);
        $room = mysqli_fetch_assoc($roomResult);

        $this->assertEquals('checkin', $booking['status']);
        $this->assertEquals('occupied', $room['roomstatus']);
    }

    public function testCheckOut()
    {
        $bookId = 1;
        $roomId = 101;

        // Update both booking and room status
        $bookingSql = "UPDATE booking SET status = 'checkout' WHERE bookID = $bookId";
        $roomSql = "UPDATE room SET roomstatus = 'available' WHERE roomID = $roomId";

        $bookingResult = mysqli_query($this->conn, $bookingSql);
        $roomResult = mysqli_query($this->conn, $roomSql);

        $this->assertTrue($bookingResult && $roomResult);

        // Verify both statuses were updated
        $checkBookingSql = "SELECT status FROM booking WHERE bookID = $bookId";
        $checkRoomSql = "SELECT roomstatus FROM room WHERE roomID = $roomId";

        $bookingResult = mysqli_query($this->conn, $checkBookingSql);
        $roomResult = mysqli_query($this->conn, $checkRoomSql);

        $booking = mysqli_fetch_assoc($bookingResult);
        $room = mysqli_fetch_assoc($roomResult);

        $this->assertEquals('checkout', $booking['status']);
        $this->assertEquals('available', $room['roomstatus']);
    }

    public function testInvalidCheckIn()
    {
        $bookId = 999; // Non-existent booking

        $sql = "UPDATE booking SET status = 'checkin' WHERE bookID = $bookId";
        $result = mysqli_query($this->conn, $sql);

        $this->assertTrue($result); // Query should succeed
        $this->assertEquals(0, mysqli_affected_rows($this->conn)); // But affect no rows
    }

    public function testDeleteBooking()
    {
        // Test delete booking functionality
        $bookId = 1;
        $sql = "DELETE FROM booking WHERE bookID = $bookId";

        $result = mysqli_query($this->conn, $sql);
        $this->assertTrue($result);

        // Verify booking was deleted
        $checkSql = "SELECT * FROM booking WHERE bookID = $bookId";
        $result = mysqli_query($this->conn, $checkSql);

        $this->assertEquals(0, mysqli_num_rows($result));
    }

    public function testCancelBooking()
    {
        // Test cancel booking functionality
        $bookId = 1;
        $roomId = 101;

        // Update booking status to cancelled
        $sql = "UPDATE booking SET status = 'cancelled' WHERE bookID = $bookId";
        $result = mysqli_query($this->conn, $sql);
        $this->assertTrue($result);

        // Update room status to available
        $sql = "UPDATE room SET roomstatus = 'available' WHERE roomID = $roomId";
        $result = mysqli_query($this->conn, $sql);
        $this->assertTrue($result);

        // Verify booking status
        $checkBookingSql = "SELECT status FROM booking WHERE bookID = $bookId";
        $bookingResult = mysqli_query($this->conn, $checkBookingSql);
        $booking = mysqli_fetch_assoc($bookingResult);
        $this->assertEquals('cancelled', $booking['status']);

        // Verify room status
        $checkRoomSql = "SELECT roomstatus FROM room WHERE roomID = $roomId";
        $roomResult = mysqli_query($this->conn, $checkRoomSql);
        $room = mysqli_fetch_assoc($roomResult);
        $this->assertEquals('available', $room['roomstatus']);
    }

    protected function tearDown(): void
    {
        // Rollback transaction to clean up test data
        mysqli_rollback($this->conn);
    }
}
