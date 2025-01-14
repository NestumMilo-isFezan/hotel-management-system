<?php
// Use realpath and dirname to dynamically resolve paths
include_once realpath(dirname(__FILE__) . '/../../directory.php');
require_once TEMP_DIR . '/bookpart.php';

// Reusable function to fetch bookings by status
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

// Fetch data for tabs
$pendingBookings = getBookingsByStatus($conn, 'pending');
$confirmedBookings = getBookingsByStatus($conn, 'confirmed');
$cancelledBookings = getBookingsByStatus($conn, 'cancelled');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manage Guest Booking</title>
        <link href="" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Staatliches" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body class="vh-100" data-bs-theme="dark"> 
        <!-- Sidebar -->
        <div class="offcanvas offcanvas-start h-100" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <a href="./index.php" class="d-flex align-items-center mb-0 mb-md-3 me-md-auto text-white text-decoration-none">
                        <img src="<?= $hotelicon ?>" alt="<?= $hotelname ?>" width="33" height="33" class="me-sm-2">
                        <span class="fs-5 fw-bold"><?= $hotelname ?></span>
                    </a>
                    <hr>
                    <!-- Sidebar Navigation -->
                    <ul class="flex-column mb-auto list-group mx-1">
                        <li class="list-group-item"><a href="../index.php" class="nav-link text-white"><i class='bx bxs-home me-sm-2 fs-4'></i> Home</a></li>
                        <li class="list-group-item"><a href="../hotel-info/index.php" class="nav-link text-white"><i class='bx bxs-building-house me-sm-2 fs-4'></i> Manage Hotel</a></li>
                        <li class="list-group-item"><a href="../book/index.php" class="nav-link text-white active"><i class='bx bxs-book-bookmark me-sm-2 fs-4'></i> Manage Booking</a></li>
                        <li class="list-group-item"><a href="../checkin/index.php" class="nav-link text-white"><i class='bx bx-list-check me-sm-2 fs-4'></i> Manage Check In</a></li>
                        <li class="list-group-item"><a href="../checkout/index.php" class="nav-link text-white"><i class='bx bx-list-minus me-sm-2 fs-4'></i> Manage Check Out</a></li>
                    </ul>
                    <hr>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="h-100">
                <!-- Header -->
                <div class="text-center mh-50" style="background-image: url('<?= $hotelimg ?>'); background-size:cover; background-repeat: no-repeat;">
                    <div class="px-2 pt-2 w-100 y-100 h-100 d-flex" style="background: linear-gradient(90deg, rgba(32,32,39,0.3), rgba(53,53,78,0.3));">
                        <div class="px-2 pt-2 pt-sm-3 m-auto">
                            <h1 class="display-5"><?= $hotelname ?><br><span class="display-2" style="color:#22092C;">Manage Guest Booking</span></h1>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <nav class="mt-3">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-booked-tab" data-bs-toggle="tab" data-bs-target="#nav-booked" type="button" role="tab">Requested</button>
                        <button class="nav-link" id="nav-confirmed-tab" data-bs-toggle="tab" data-bs-target="#nav-confirmed" type="button" role="tab">Confirmed</button>
                        <button class="nav-link" id="nav-cancel-tab" data-bs-toggle="tab" data-bs-target="#nav-cancel" type="button" role="tab">Cancelled</button>
                    </div>
                </nav>

                <div class="tab-content mt-3 vh-100" id="nav-tabContent">
                    <!-- Pending Bookings -->
                    <div class="tab-pane fade show active" id="nav-booked" role="tabpanel">
                        <table class="table table-hover table-bordered border-danger">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Guest Name</th>
                                    <th>Room No.</th>
                                    <th>Service</th>
                                    <th>Check In Date</th>
                                    <th>Check Out Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($pendingBookings->num_rows > 0) {
                                    $numrow = 0;
                                    while ($row = $pendingBookings->fetch_assoc()) {
                                        $numrow++;
                                ?>
                                <tr>
                                    <td><?= $numrow ?></td>
                                    <td><?= $row["firstName"] . " " . $row["lastName"] ?></td>
                                    <td><?= $row["roomNo"] ?></td>
                                    <td><?= $row["name"] ?></td>
                                    <td><?= $row["check_in"] ?></td>
                                    <td><?= $row["check_out"] ?></td>
                                    <td><button class="btn btn-success btn-sm" data-id="<?= $row['bookID'] ?>">Confirm</button></td>
                                </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="7">No pending bookings found.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Add confirmed and cancelled sections similarly -->
                </div>
            </div>
        </div>

        <!-- Toast Notifications -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="action.js"></script>
    </body>
</html>
