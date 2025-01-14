<?php

use PHPUnit\Framework\TestCase;

class BookingManagementTest extends TestCase
{
    protected $conn;

    protected function setUp(): void
    {
        global $conn;
        $this->conn = $conn;

        // Reset test database state
        mysqli_query($this->conn, "DELETE FROM booking WHERE bookID IN (1, 2, 3)");
        mysqli_query($this->conn, "DELETE FROM room WHERE roomID = 101");

        // Add test data setup for actual tables
        mysqli_query($this->conn, "INSERT INTO roomtype (typeID, hotelID, name, description, price, capacity)
            VALUES (1, 1, 'Test Type', 'Test Description', 100.00, 2)");
        mysqli_query($this->conn, "INSERT INTO room (roomID, hotelID, typeID, roomstatus, roomNo)
            VALUES (101, 1, 1, 'available', '101')");
    }

    public function testCreateBooking()
    {
        // First create a test room
        mysqli_query($this->conn, "INSERT INTO room (roomID, roomstatus) VALUES (101, 'available')");

        $bookingData = [
            'guestID' => 1,
            'roomID' => 101,
            'checkin' => '2024-03-20',
            'checkout' => '2024-03-25',
            'status' => 'confirmed'
        ];

        $sql = "INSERT INTO booking (guestID, roomID, checkin, checkout, status)
                VALUES ({$bookingData['guestID']}, {$bookingData['roomID']},
                        '{$bookingData['checkin']}', '{$bookingData['checkout']}',
                        '{$bookingData['status']}')";

        $result = mysqli_query($this->conn, $sql);
        $this->assertTrue($result);

        // Verify booking exists
        $checkSql = "SELECT * FROM booking WHERE guestID = 1 AND roomID = 101";
        $result = mysqli_query($this->conn, $checkSql);
        $booking = mysqli_fetch_assoc($result);

        $this->assertNotNull($booking);
        $this->assertEquals($bookingData['checkin'], $booking['checkin']);
        $this->assertEquals($bookingData['checkout'], $booking['checkout']);
    }

    public function testDateValidation()
    {
        $checkin = '2024-03-25';
        $checkout = '2024-03-20';

        // Simple date validation
        $this->assertFalse(strtotime($checkout) > strtotime($checkin));
    }

    public function testRoomAvailabilityForBooking()
    {
        $roomId = 101;
        $checkin = '2024-03-20';
        $checkout = '2024-03-25';

        // Check if room is available for given dates
        $sql = "SELECT COUNT(*) as count FROM booking
                WHERE roomID = $roomId
                AND status != 'cancelled'
                AND (
                    (checkin <= '$checkin' AND checkout >= '$checkin')
                    OR (checkin <= '$checkout' AND checkout >= '$checkout')
                    OR (checkin >= '$checkin' AND checkout <= '$checkout')
                )";

        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $this->assertEquals(0, $row['count']);
    }

    public function testBookingCreation()
    {
        // Test booking creation with actual table structure
        $sql = "INSERT INTO booking (guestID, roomID, serviceID, checkin, checkout, totalprice, status)
                VALUES (1, 101, 1, '2024-03-20', '2024-03-25', 500.00, 'pending')";
        $result = mysqli_query($this->conn, $sql);
        $this->assertTrue($result);

        // Verify booking exists
        $checkSql = "SELECT * FROM booking WHERE guestID = 1 AND roomID = 101";
        $result = mysqli_query($this->conn, $checkSql);
        $booking = mysqli_fetch_assoc($result);

        $this->assertNotNull($booking);
        $this->assertEquals('2024-03-20', $booking['checkin']);
        $this->assertEquals('2024-03-25', $booking['checkout']);
    }

    protected function tearDown(): void
    {
        // Clean up with correct table names
        mysqli_query($this->conn, "DELETE FROM booking WHERE roomID = 101");
        mysqli_query($this->conn, "DELETE FROM room WHERE roomID = 101");
        mysqli_query($this->conn, "DELETE FROM roomtype WHERE typeID = 1");
    }
}
