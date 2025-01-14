<?php

use PHPUnit\Framework\TestCase;

class CheckInOutTest extends TestCase
{
    protected $conn;

    protected function setUp(): void
    {
        global $conn;
        $this->conn = $conn;

        // Add test data
        $roomsql = "INSERT INTO room (hotelID, typeID, roomstatus, roomNo)
        VALUES (1, 'single', 'unavailable', '101')";
        mysqli_query($this->conn, $roomsql);

        $booksql = "INSERT INTO booking(roomID, guestID, serviceID, check_in, check_out, total_price, status)
        VALUES(101, 1, 1, '2024-01-01', '2024-01-02', 100, 'pending')";
        mysqli_query($this->conn, $booksql);
    }

    public function testCheckIn()
    {
        // Test check-in functionality
        $bookId = 1;
        $sql = "UPDATE booking SET status = 'checkin' WHERE bookID = $bookId";

        $result = mysqli_query($this->conn, $sql);
        $this->assertTrue($result);

        // Verify status was updated
        $checkSql = "SELECT status FROM booking WHERE bookID = $bookId";
        $result = mysqli_query($this->conn, $checkSql);
        $booking = mysqli_fetch_assoc($result);

        $this->assertEquals('checkin', $booking['status']);
    }

    public function testCheckOut()
    {
        // Test check-out functionality
        $bookId = 1;
        $sql = "UPDATE booking SET status = 'checkout' WHERE bookID = $bookId";

        $result = mysqli_query($this->conn, $sql);
        $this->assertTrue($result);

        // Verify status was updated
        $checkSql = "SELECT status FROM booking WHERE bookID = $bookId";
        $result = mysqli_query($this->conn, $checkSql);
        $booking = mysqli_fetch_assoc($result);

        $this->assertEquals('checkout', $booking['status']);
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
        // Clean up test data
        mysqli_query($this->conn, "DELETE FROM booking WHERE bookID = 1");
        mysqli_query($this->conn, "DELETE FROM room WHERE roomID = 101");
    }
}
