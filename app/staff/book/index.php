<?php
// Include necessary files
include_once realpath(dirname(__FILE__) . '/../../directory.php');
require_once TEMP_DIR . '/bookpart.php';

// Function to fetch bookings based on status
function getBookingsByStatus($conn, $status) {
    $sql = "SELECT booking.*, room.*, guest.*, hotelservice.* 
            FROM booking
            JOIN room ON booking.roomID = room.roomID
            JOIN guest ON booking.guestID = guest.guestID
            JOIN hotelservice ON booking.serviceID = hotelservice.serviceID
            WHERE booking.status = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $status);
    $stmt->execute();
    return $stmt->get_result();
}

// Fetch data for the tabs
$pendingBookings = getBookingsByStatus($conn, 'pending');
$confirmedBookings = getBookingsByStatus($conn, 'confirmed');
$cancelledBookings = getBookingsByStatus($conn, 'cancelled');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Guest Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body class="vh-100" data-bs-theme="dark">

    <!-- Sidebar -->
    <div class="offcanvas offcanvas-start h-100" tabindex="-1" id="offcanvasExample">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <a href="./index.php" class="d-flex align-items-center mb-3 me-md-auto text-white text-decoration-none">
                <img src="<?= $hotelicon ?>" alt="<?= $hotelname ?>" width="33" height="33" class="me-sm-2">
                <span class="fs-5 fw-bold"><?= $hotelname ?></span>
            </a>
            <hr>
            <ul class="list-group">
                <li class="list-group-item"><a href="../index.php" class="text-white">Home</a></li>
                <li class="list-group-item"><a href="../hotel-info/index.php" class="text-white">Manage Hotel</a></li>
                <li class="list-group-item active"><a href="./index.php" class="text-white">Manage Booking</a></li>
                <li class="list-group-item"><a href="../checkin/index.php" class="text-white">Manage Check In</a></li>
                <li class="list-group-item"><a href="../checkout/index.php" class="text-white">Manage Check Out</a></li>
            </ul>
            <hr>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="text-center py-5" style="background-image: url('<?= $hotelimg ?>'); background-size: cover;">
            <h1 class="text-light">Manage Guest Booking</h1>
        </div>

        <nav class="mt-3">
            <div class="nav nav-tabs">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pending">Requested</button>
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#confirmed">Confirmed</button>
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cancelled">Cancelled</button>
            </div>
        </nav>

        <div class="tab-content mt-4">
            <!-- Pending Bookings -->
            <div class="tab-pane fade show active" id="pending">
                <?= renderTable($pendingBookings, 'Confirm', 'btn-success') ?>
            </div>

            <!-- Confirmed Bookings -->
            <div class="tab-pane fade" id="confirmed">
                <?= renderTable($confirmedBookings, 'Confirmed', 'badge bg-success') ?>
            </div>

            <!-- Cancelled Bookings -->
            <div class="tab-pane fade" id="cancelled">
                <?= renderTable($cancelledBookings, 'Cancelled', 'btn-danger') ?>
            </div>
        </div>
    </div>

    <!-- Toasts -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Helper function to render a booking table
function renderTable($bookings, $actionLabel, $actionClass) {
    ob_start();
    ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Guest Name</th>
                <th>Room No.</th>
                <th>Service</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($bookings->num_rows > 0): ?>
                <?php foreach ($bookings as $index => $booking): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $booking['firstName'] . ' ' . $booking['lastName'] ?></td>
                        <td><?= $booking['roomNo'] ?></td>
                        <td><?= $booking['name'] ?></td>
                        <td><?= $booking['check_in'] ?></td>
                        <td><?= $booking['check_out'] ?></td>
                        <td>
                            <button class="btn <?= $actionClass ?>"><?= $actionLabel ?></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No bookings found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
    return ob_get_clean();
}
?>