<?php
class BookingRepository {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getBookingsTable($status) {
        $sql = "SELECT b.bookID, g.guestName, r.roomNo,
                       b.checkInDate, b.checkOutDate, b.status
                FROM booking b
                JOIN guest g ON b.guestID = g.guestID
                JOIN room r ON b.roomID = r.roomID
                WHERE b.status = ?
                ORDER BY b.checkInDate DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateBookingStatus($bookingId, $status) {
        $sql = "UPDATE booking SET status = ? WHERE bookID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $bookingId]);
    }
}
?>
