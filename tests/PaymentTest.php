<?php

use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    protected $conn;

    protected function setUp(): void
    {
        global $conn;
        $this->conn = $conn;

        // Reset test database state
        mysqli_query($this->conn, "DELETE FROM payment WHERE bookID = 1");
        mysqli_query($this->conn, "DELETE FROM booking WHERE bookID = 1");

        // Add test data for payment testing
        mysqli_query($this->conn, "INSERT INTO booking (bookID, guestID, roomID, totalprice, status)
            VALUES (1, 1, 101, 1000.00, 'checkout')");
    }

    public function testProcessPayment()
    {
        $paymentData = [
            'bookID' => 1,
            'amount' => 500.00,
            'method' => 'credit_card',
            'status' => 'pending'
        ];

        $sql = "INSERT INTO payment (bookID, amount, method, status)
                VALUES ({$paymentData['bookID']}, {$paymentData['amount']},
                        '{$paymentData['method']}', '{$paymentData['status']}')";

        $result = mysqli_query($this->conn, $sql);
        $this->assertTrue($result);

        // Update payment status to completed
        $updateSql = "UPDATE payment SET status = 'completed'
                     WHERE bookID = {$paymentData['bookID']}";
        mysqli_query($this->conn, $updateSql);

        // Verify payment status
        $checkSql = "SELECT status FROM payment WHERE bookID = {$paymentData['bookID']}";
        $result = mysqli_query($this->conn, $checkSql);
        $payment = mysqli_fetch_assoc($result);

        $this->assertEquals('completed', $payment['status']);
    }

    public function testRefundCalculation()
    {
        // Insert test booking with total amount
        mysqli_query($this->conn, "INSERT INTO booking (bookID, total_amount) VALUES (1, 1000)");

        $daysStayed = 2;
        $totalDays = 5;
        $totalAmount = 1000;

        $refundAmount = ($totalDays - $daysStayed) * ($totalAmount / $totalDays);
        $this->assertEquals(600, $refundAmount);
    }

    public function testPaymentCalculation()
    {
        // Test payment with actual payment table structure
        $sql = "INSERT INTO payment (bookID, amountpaid, paymentmethod, balance)
                VALUES (1, 1000.00, 'cash', 0.00)";
        $result = mysqli_query($this->conn, $sql);
        $this->assertTrue($result);
    }

    protected function tearDown(): void
    {
        // Clean up test data
        mysqli_query($this->conn, "DELETE FROM payment WHERE bookID = 1");
        mysqli_query($this->conn, "DELETE FROM booking WHERE bookID = 1");
    }
}
