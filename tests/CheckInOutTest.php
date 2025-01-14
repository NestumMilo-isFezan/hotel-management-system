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

        // 1. Insert test user account first (needed for guest)
        $userSql = "INSERT INTO useracc (username, email, password, userRoles)
            VALUES ('testuser', 'test@example.com', 'password123', 2)";
        if (!mysqli_query($this->conn, $userSql)) {
            $this->markTestSkipped('Could not insert test user data: ' . mysqli_error($this->conn));
        }
        $accId = mysqli_insert_id($this->conn);

        // 2. Insert hotel
        $hotelsql = "INSERT INTO hotel (hotelname, contact, email, address, postcode, city, state, country, info, about, img_path)
            VALUES ('Test Hotel', '1234567890', 'test@hotel.com', 'Test Address', '12345', 'Test City', 'Test State', 'Test Country', 'Test Info', 'Test About', 'test.jpg')";
        if (!mysqli_query($this->conn, $hotelsql)) {
            $this->markTestSkipped('Could not insert test hotel data: ' . mysqli_error($this->conn));
        }
        $hotelId = mysqli_insert_id($this->conn);

        // 3. Insert guest
        $guestsql = "INSERT INTO guest (accID, firstName, lastName, address, postcode, city, state, country)
            VALUES ($accId, 'Test', 'Guest', 'Test Address', '12345', 'Test City', 'Test State', 'Test Country')";
        if (!mysqli_query($this->conn, $guestsql)) {
            $this->markTestSkipped('Could not insert test guest data: ' . mysqli_error($this->conn));
        }
        $guestId = mysqli_insert_id($this->conn);

        // 4. Insert room type
        $roomtype = "INSERT INTO roomtype (hotelID, name, description, price, capacity, room_imgpath)
            VALUES ($hotelId, 'single', 'Test room', 100.00, 1, 'test.jpg')";
        if (!mysqli_query($this->conn, $roomtype)) {
            $this->markTestSkipped('Could not insert test room type data: ' . mysqli_error($this->conn));
        }
        $typeId = mysqli_insert_id($this->conn);

        // 5. Insert room
        $roomsql = "INSERT INTO room (hotelID, typeID, roomstatus, roomNo)
            VALUES ($hotelId, $typeId, 'available', '101')";
        if (!mysqli_query($this->conn, $roomsql)) {
            $this->markTestSkipped('Could not insert test room data: ' . mysqli_error($this->conn));
        }
        $roomId = mysqli_insert_id($this->conn);

        // 6. Insert hotel service
        $servicesql = "INSERT INTO hotelservice (hotelID, name, description, price, servicestatus)
            VALUES ($hotelId, 'Test Service', 'Test Service Description', 50.00, 'available')";
        if (!mysqli_query($this->conn, $servicesql)) {
            $this->markTestSkipped('Could not insert test service data: ' . mysqli_error($this->conn));
        }
        $serviceId = mysqli_insert_id($this->conn);

        // 7. Finally insert booking
        $booksql = "INSERT INTO booking(roomID, guestID, serviceID, check_in, check_out, total_price, status)
            VALUES($roomId, $guestId, $serviceId, '2024-01-01 12:00:00', '2024-01-02 12:00:00', 100.00, 'pending')";
        if (!mysqli_query($this->conn, $booksql)) {
            $this->markTestSkipped('Could not insert test booking data: ' . mysqli_error($this->conn));
        }
        $bookingId = mysqli_insert_id($this->conn);

        // Store IDs for use in tests
        $this->testData = [
            'accId' => $accId,
            'hotelId' => $hotelId,
            'typeId' => $typeId,
            'roomId' => $roomId,
            'guestId' => $guestId,
            'serviceId' => $serviceId,
            'bookingId' => $bookingId
        ];
    }

    /**
     * Helper method to update and verify status changes
     */
    private function updateAndVerifyStatuses(
        int $bookingId,
        int $roomId,
        string $bookingStatus,
        string $roomStatus
    ): void {
        // Update statuses
        $bookingSql = "UPDATE booking SET status = ? WHERE bookID = ?";
        $roomSql = "UPDATE room SET roomstatus = ? WHERE roomID = ?";

        $bookingStmt = mysqli_prepare($this->conn, $bookingSql);
        $roomStmt = mysqli_prepare($this->conn, $roomSql);

        mysqli_stmt_bind_param($bookingStmt, "si", $bookingStatus, $bookingId);
        mysqli_stmt_bind_param($roomStmt, "si", $roomStatus, $roomId);

        $bookingResult = mysqli_stmt_execute($bookingStmt);
        $roomResult = mysqli_stmt_execute($roomStmt);

        $this->assertTrue($bookingResult && $roomResult);

        // Verify status changes
        $this->verifyStatus('booking', 'status', $bookingStatus, $bookingId, 'bookID');
        $this->verifyStatus('room', 'roomstatus', $roomStatus, $roomId, 'roomID');
    }

    /**
     * Helper method to verify a status in any table
     */
    private function verifyStatus(
        string $table,
        string $statusColumn,
        string $expectedStatus,
        int $id,
        string $idColumn
    ): void {
        $sql = "SELECT $statusColumn FROM $table WHERE $idColumn = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        $this->assertEquals($expectedStatus, $row[$statusColumn]);
    }

    public function testCheckIn()
    {
        $this->updateAndVerifyStatuses(
            $this->testData['bookingId'],
            $this->testData['roomId'],
            'checkin',
            'occupied'
        );
    }

    public function testCheckOut()
    {
        $this->updateAndVerifyStatuses(
            $this->testData['bookingId'],
            $this->testData['roomId'],
            'checkout',
            'available'
        );
    }

    public function testInvalidCheckIn()
    {
        $bookId = 999; // Non-existent booking
        $status = "checkin"; // Store status in a variable

        $stmt = mysqli_prepare($this->conn, "UPDATE booking SET status = ? WHERE bookID = ?");
        mysqli_stmt_bind_param($stmt, "si", $status, $bookId);
        $result = mysqli_stmt_execute($stmt);

        $this->assertTrue($result); // Query should succeed
        $this->assertEquals(0, mysqli_stmt_affected_rows($stmt)); // But affect no rows
    }

    public function testDeleteBooking()
    {
        $bookId = $this->testData['bookingId'];
        $stmt = mysqli_prepare($this->conn, "DELETE FROM booking WHERE bookID = ?");
        mysqli_stmt_bind_param($stmt, "i", $bookId);

        $result = mysqli_stmt_execute($stmt);
        $this->assertTrue($result);

        // Verify booking was deleted
        $checkStmt = mysqli_prepare($this->conn, "SELECT * FROM booking WHERE bookID = ?");
        mysqli_stmt_bind_param($checkStmt, "i", $bookId);
        mysqli_stmt_execute($checkStmt);
        $result = mysqli_stmt_get_result($checkStmt);

        $this->assertEquals(0, mysqli_num_rows($result));
    }

    public function testCancelBooking()
    {
        $this->updateAndVerifyStatuses(
            $this->testData['bookingId'],
            $this->testData['roomId'],
            'cancelled',
            'available'
        );
    }

    protected function tearDown(): void
    {
        if ($this->conn) {
            // Rollback transaction to clean up test data
            mysqli_rollback($this->conn);
            // Don't close the connection since it's managed globally
        }
    }
}
