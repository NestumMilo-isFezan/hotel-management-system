<?php

use PHPUnit\Framework\TestCase;

class CheckInOutTest extends TestCase
{
    protected $conn;
    protected $testData;

    protected function setUp(): void
    {
        global $conn;
        $this->conn = $conn;

        if (!$this->conn) {
            $this->markTestSkipped('No database connection available');
        }

        // Start transaction for test isolation
        if (!mysqli_begin_transaction($this->conn)) {
            $this->markTestSkipped('Could not start transaction');
        }

        // Add test data
        // 1. First insert hotel
        $hotelsql = "INSERT INTO hotel (name, address, phone, email)
            VALUES ('Test Hotel', 'Test Address', '1234567890', 'test@hotel.com')";
        if (!mysqli_query($this->conn, $hotelsql)) {
            $this->markTestSkipped('Could not insert test hotel data: ' . mysqli_error($this->conn));
        }
        $hotelId = mysqli_insert_id($this->conn);

        // 2. Insert room type
        $roomtype = "INSERT INTO roomtype (hotelID, name, description, price, capacity, room_imgpath)
            VALUES ($hotelId, 'single', 'Test room', 100, 1, 'test.jpg')";
        if (!mysqli_query($this->conn, $roomtype)) {
            $this->markTestSkipped('Could not insert test room type data: ' . mysqli_error($this->conn));
        }
        $typeId = mysqli_insert_id($this->conn);

        // 3. Insert room
        $roomsql = "INSERT INTO room (hotelID, typeID, roomstatus, roomNo)
            VALUES ($hotelId, $typeId, 'available', '101')";
        if (!mysqli_query($this->conn, $roomsql)) {
            $this->markTestSkipped('Could not insert test room data: ' . mysqli_error($this->conn));
        }
        $roomId = mysqli_insert_id($this->conn);

        // 4. Insert guest
        $guestsql = "INSERT INTO guest (name, email, phone, address)
            VALUES ('Test Guest', 'guest@test.com', '1234567890', 'Test Address')";
        if (!mysqli_query($this->conn, $guestsql)) {
            $this->markTestSkipped('Could not insert test guest data: ' . mysqli_error($this->conn));
        }
        $guestId = mysqli_insert_id($this->conn);

        // 5. Insert service (if needed)
        $servicesql = "INSERT INTO service (name, price, description)
            VALUES ('Test Service', 50, 'Test Service Description')";
        if (!mysqli_query($this->conn, $servicesql)) {
            $this->markTestSkipped('Could not insert test service data: ' . mysqli_error($this->conn));
        }
        $serviceId = mysqli_insert_id($this->conn);

        // 6. Finally insert booking
        $booksql = "INSERT INTO booking(roomID, guestID, serviceID, check_in, check_out, total_price, status)
            VALUES($roomId, $guestId, $serviceId, '2024-01-01', '2024-01-02', 100, 'pending')";
        if (!mysqli_query($this->conn, $booksql)) {
            $this->markTestSkipped('Could not insert test booking data: ' . mysqli_error($this->conn));
        }
        $bookingId = mysqli_insert_id($this->conn);

        // Store IDs for use in tests
        $this->testData = [
            'hotelId' => $hotelId,
            'typeId' => $typeId,
            'roomId' => $roomId,
            'guestId' => $guestId,
            'serviceId' => $serviceId,
            'bookingId' => $bookingId
        ];
    }

    public function testCheckIn()
    {
        $bookId = $this->testData['bookingId'];
        $roomId = $this->testData['roomId'];

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
        $bookId = $this->testData['bookingId'];
        $roomId = $this->testData['roomId'];

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
        if ($this->conn) {
            // Rollback transaction to clean up test data
            mysqli_rollback($this->conn);
            mysqli_close($this->conn);
        }
    }
}
