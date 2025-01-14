<?php
// Use realpath and dirname to dynamically resolve paths
include_once realpath(dirname(__FILE__) . '/../../directory.php');
require_once TEMP_DIR . '/bookpart.php';

// Helper function to fetch bookings by status
function getBookingsByStatus($conn, $status) {
    $sql = "SELECT booking.*, room.*, guest.*, hotelservice.* 
            FROM booking
            JOIN room ON booking.roomID = room.roomID
            JOIN guest ON booking.guestID = guest.guestID
            JOIN hotelservice ON booking.serviceID = hotelservice.serviceID
            WHERE booking.status = ?";
    $stmt = $conn->prepare($sql); // Use prepared statements for better security
    $stmt->bind_param("s", $status); // Bind the 'status' parameter
    $stmt->execute();
    return $stmt->get_result();
}

// Fetch data for the 'pending', 'confirmed', and 'cancelled' bookings
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
        <!-- Navbar and Offcanvas -->
        <!-- (No changes made here) -->

        <div class="container-fluid">
            <div class="h-100">
                <!-- Header -->
                <div class="text-center mh-50" style="background-image: url('<?= $hotelimg?>'); background-size:cover; background-repeat: no-repeat;">
                    <div class="px-2 pt-2 w-100 y-100 h-100 d-flex" style="background: rgb(32,32,39); background: linear-gradient(90deg, rgba(32,32,39,0.3) 0%, rgba(53,53,78, 0.3) 28%, rgba(94,94,108, 0.3) 70%, rgba(111,106,106, 0.3) 100%); backdrop-filter: blur(5px);">
                        <div class="px-2 pt-2 pt-sm-3 m-auto" style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);">
                            <h1 class="display-5" style="font-family: 'Staatliches';"><?= $hotelname?><br><span class="display-2" style="color:#22092C;">Manage Guest Booking</span></h1>
                        </div>
                    </div>
                </div>

                <nav class="mt-3">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-booked-tab" data-bs-toggle="tab" data-bs-target="#nav-booked" type="button" role="tab" aria-controls="nav-booked" aria-selected="true">Requested</button>
                        <button class="nav-link" id="nav-confirmed-tab" data-bs-toggle="tab" data-bs-target="#nav-confirmed" type="button" role="tab" aria-controls="nav-confirmed" aria-selected="false">Confirmed</button>
                        <button class="nav-link" id="nav-cancel-tab" data-bs-toggle="tab" data-bs-target="#nav-cancel" type="button" role="tab" aria-controls="nav-cancel" aria-selected="false">Cancelled</button>
                    </div>
                </nav>

                <div class="tab-content mt-3 vh-100" id="nav-tabContent">
                    <!-- Pending Bookings -->
                    <div class="tab-pane fade show active" id="nav-booked" role="tabpanel" aria-labelledby="nav-booked-tab" tabindex="0">
                        <div class="content">
                            <div>
                                <div class="table header">
                                    <h2>Booking Request List</h2>
                                    <hr>
                                </div>
                                <div class="mx-3" id="confirmcontent">
                                    <table class="table table-hover table-bordered border-danger" id="confirmedtable">
                                        <tr style="--bs-table-bg:#bd3e75;">
                                            <th>No</th>
                                            <th>Guest Name</th>
                                            <th>Room No.</th>
                                            <th>Service</th>
                                            <th>Check In Date</th>
                                            <th>Check Out Date</th>
                                            <th>Modify</th>
                                        </tr>
                                        <tbody class="table-danger table-striped">
                                            <?php
                                            $numrow = 0;
                                            while ($row = $pendingBookings->fetch_assoc()) {
                                                $numrow++;
                                            ?>
                                            <tr>
                                                <td><?= $numrow ?></td>
                                                <td><?= $row["firstName"] ?> <?= $row["lastName"] ?></td>
                                                <td><?= $row["roomNo"] ?></td>
                                                <td><?= $row["name"] ?></td>
                                                <td><?= $row["check_in"] ?></td>
                                                <td><?= $row["check_out"] ?></td>
                                                <td>
                                                    <div class="d-grid gap-2 d-block">
                                                        <button type="button" class="btn btn-success btn-sm update confirmit" data-id="<?= $row['bookID'] ?>" data-room="<?= $row['roomID'] ?>">Confirm</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirmed Bookings -->
                    <div class="tab-pane fade" id="nav-confirmed" role="tabpanel" aria-labelledby="nav-confirmed-tab" tabindex="0">
                        <div class="content">
                            <div>
                                <div class="table header">
                                    <h2>Confirmed Booking List</h2>
                                    <hr>
                                </div>
                                <div class="mx-3">
                                    <table class="table table-hover table-bordered border-warning">
                                        <tr style="--bs-table-bg:#bd9b3e;">
                                            <th>No</th>
                                            <th>Guest Name</th>
                                            <th>Room No.</th>
                                            <th>Service</th>
                                            <th>Check In Date</th>
                                            <th>Check Out Date</th>
                                            <th>Status</th>
                                        </tr>
                                        <tbody class="table-danger table-striped">
                                            <?php
                                            $numrow = 0;
                                            while ($row = $confirmedBookings->fetch_assoc()) {
                                                $numrow++;
                                            ?>
                                            <tr>
                                                <td><?= $numrow ?></td>
                                                <td><?= $row["firstName"] ?> <?= $row["lastName"] ?></td>
                                                <td><?= $row["roomNo"] ?></td>
                                                <td><?= $row["name"] ?></td>
                                                <td><?= $row["check_in"] ?></td>
                                                <td><?= $row["check_out"] ?></td>
                                                <td class="align-middle text-center"><span class="badge text-bg-success"><?= $row["status"] ?></span></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cancelled Bookings -->
                    <div class="tab-pane fade" id="nav-cancel" role="tabpanel" aria-labelledby="nav-cancel-tab" tabindex="0">
                        <div class="content">
                            <div>
                                <div class="table header">
                                    <h2>Cancelled Request List</h2>
                                    <hr>
                                </div>
                                <div class="mx-3" id="cancelcontent">
                                    <table id="canceltable" class="table table-hover table-bordered border-danger">
                                        <tr style="--bs-table-bg:#bd3e3e;">
                                            <th>No</th>
                                            <th>Guest Name</th>
                                            <th>Room No.</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody class="table-danger table-striped">
                                            <?php
                                            $numrow = 0;
                                            while ($row = $cancelledBookings->fetch_assoc()) {
                                                $numrow++;
                                            ?>
                                            <tr>
                                                <td><?= $numrow ?></td>
                                                <td><?= $row["firstName"] ?> <?= $row["lastName"] ?></td>
                                                <td><?= $row["roomNo"] ?></td>
                                                <td class="align-middle text-center"><span class="badge text-bg-danger"><?= $row["status"] ?></span></td>
                                                <td>
                                                    <div class="d-grid gap-2 d-block">
                                                        <button type="button" class="btn btn-danger confirmcancel" data-id="<?= $row['bookID'] ?>">Delete</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notifications -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <!-- Toast code here -->
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="action.js"></script>
    </body>
</html>