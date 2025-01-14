<?php

use PHPUnit\Framework\TestCase;

class ServiceManagementTest extends TestCase
{
    protected $conn;

    protected function setUp(): void
    {
        global $conn;
        $this->conn = $conn;

        // Reset test database state
        mysqli_query($this->conn, "DELETE FROM service WHERE name IN ('Room Cleaning', 'Laundry')");

        // Add test data for service management
        mysqli_query($this->conn, "INSERT INTO hotelservice (serviceID, hotelID, name, price, servicestatus)
            VALUES (1, 1, 'Room Cleaning', 50.00, 'active')");
    }

    public function testCreateService()
    {
        $serviceData = [
            'name' => 'Room Cleaning',
            'price' => 50.00,
            'servicestatus' => 'active'
        ];

        $sql = "INSERT INTO service (name, price, servicestatus)
                VALUES ('{$serviceData['name']}', {$serviceData['price']},
                        '{$serviceData['servicestatus']}')";

        $result = mysqli_query($this->conn, $sql);
        $this->assertTrue($result);

        // Verify service exists
        $checkSql = "SELECT * FROM service WHERE name = '{$serviceData['name']}'";
        $result = mysqli_query($this->conn, $checkSql);
        $service = mysqli_fetch_assoc($result);

        $this->assertNotNull($service);
        $this->assertEquals($serviceData['price'], $service['price']);
        $this->assertEquals($serviceData['servicestatus'], $service['servicestatus']);
    }

    public function testServiceAvailability()
    {
        // Create test service
        mysqli_query($this->conn, "INSERT INTO service (name, servicestatus)
                                 VALUES ('Laundry', 'active')");

        // Check active service
        $sql = "SELECT servicestatus FROM service WHERE name = 'Laundry'";
        $result = mysqli_query($this->conn, $sql);
        $service = mysqli_fetch_assoc($result);
        $this->assertEquals('active', $service['servicestatus']);

        // Update to inactive
        mysqli_query($this->conn, "UPDATE service SET servicestatus = 'inactive'
                                 WHERE name = 'Laundry'");

        // Verify status change
        $result = mysqli_query($this->conn, $sql);
        $service = mysqli_fetch_assoc($result);
        $this->assertEquals('inactive', $service['servicestatus']);
    }

    public function testServiceStatusUpdate() {
        // Test service status update with actual values
        $sql = "UPDATE hotelservice SET servicestatus = 'inactive' WHERE serviceID = 1";
        // ... rest of test
    }

    protected function tearDown(): void
    {
        // Clean up test data
        mysqli_query($this->conn, "DELETE FROM service WHERE name IN ('Room Cleaning', 'Laundry')");
    }
}
