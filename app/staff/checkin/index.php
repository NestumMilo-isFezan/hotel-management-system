<?php
require("../../directory.php");
require (TEMP_DIR."/adminpart.php");
require_once '../templates/sidebar-nav.php';
renderSidebarNav('checkin');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manage Hotel</title>
        <link href="" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Staatliches" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

<body class="vh-100" data-bs-theme="dark">
    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <i class='bx bx-menu fs-3'></i>
    </button>

    <div class="offcanvas offcanvas-start h-100" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <a href="./index.php" class="d-flex align-items-center mb-0 mb-md-3 me-md-auto text-white text-decoration-none">
                    <img src="<?= $hotelicon?>" alt="<?= $hotelname?>" width="33" height="33" class="me-sm-2">
                    <span class="fs-5 fw-bold"><?= $hotelname?></span>
                </a>
                <hr>
                <ul class="flex-column mb-auto list-group mx-1">
                    <li class="list-group-item">
                        <a href="../index.php" class="nav-link text-white">
                            <i class='bx bxs-home me-sm-2 fs-4'></i>
                            <span class="d-inline-block">Home</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="../hotel-info/index.php" class="nav-link text-white">
                            <i class='bx bxs-building-house me-sm-2 fs-4' ></i>
                            <span class="d-inline-block">Manage Hotel</span>
                        </a>
                    </li>
                    <li class="list-unstyled">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <i class='bx bxs-hotel fs-4' ></i>&nbsp;<span class="ms-1 d-inline-block">Manage Room</span>
                                </button>
                                </h3>
                                <div id="collapseOne" class="accordion-collapse collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="container-fluid w-100 h-100">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal list-group">
                                            <li class="list-group-item"><a href="../room/index.php" class="link-body-emphasis text-decoration-none rounded mb-sm-3"><i class='bx bxs-plus-square me-sm-2 fs-4' ></i><span class="d-inline-block">Hotel Room</span></a></li>
                                            <li class="list-group-item"><a href="../room-type/index.php" class="link-body-emphasis text-decoration-none rounded mb-sm-1"><i class='bx bxs-layer-plus me-sm-2 fs-4'></i><span class="d-inline-block">Room Type</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a href="../service/index.php" class="nav-link text-white">
                        <i class='bx bxs-cog me-sm-2 fs-4' ></i>
                        <span class="d-inline-block">Manage Service</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="../book/index.php" class="nav-link text-white">
                        <i class='bx bxs-book-bookmark me-sm-2 fs-4' ></i>
                        <span class="d-inline-block">Manage Booking</span>
                        </a>
                    </li>
                    <li class="list-group-item active">
                        <a href="../checkin/index.php" class="nav-link text-white">
                        <i class='bx bx-list-check me-sm-2 fs-4' ></i>
                        <span class="d-inline-block">Manage Check In</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="../checkout/index.php" class="nav-link text-white">
                        <i class='bx bx-list-minus me-sm-2 fs-4' ></i>
                        <span class="d-inline-block">Manage Check Out</span>
                        </a>
                    </li>
                </ul>
                <hr>
            </div>
            <div class="dropdown mx-2 align-self-end">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?= $userIcon?>" alt="" width="32" height="32" class="rounded-circle me-sm-2">
                    <span class="d-inline-block"><strong><?= $firstName?></strong></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="../../auth/staff-register.php"><i class='bx bxs-user-plus me-sm-2' ></i><span class="ms-1">Add Staff</span></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="../../auth/logout.php"><i class='bx bxs-log-out me-sm-2' ></i><span class="ms-1">Sign out</span></a></li>
                </ul>
            </div>

            </div>
        </div>
    </div>

            <div class = "container-fluid">
            <div class = "h-100">
                <!-- Header -->
                <div class="col text-center mh-50 mb-3 mx-3" style="background-image: url('<?= $hotelimg?>'); background-size:cover; background-repeat: no-repeat;">
                    <div class="px-2 pt-2 w-100 y-100 h-100 d-flex" style="background: rgb(32,32,39); background: linear-gradient(90deg, rgba(32,32,39,0.3) 0%, rgba(53,53,78, 0.3) 28%, rgba(94,94,108, 0.3) 70%, rgba(111,106,106, 0.3) 100%); backdrop-filter: blur(5px);">
                        <div class="px-2 pt-2 pt-sm-3 m-auto" style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);">
                            <div>
                                <h1 class="display-5" style="font-family: 'Staatliches';"><?= $hotelname?><br><span class="display-2" style="color:#22092C;">Manage Check-In</span></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class = "mx-3">
                    <h2>Customer Check-In List</h2>
                    <hr>
                <div class="mx-3" id="checkincontent">
                    <table id="checkintable" class = "table table-hover table-bordered table-emphasis-color">
                        <tr class="" style="--bs-table-bg:#40cf45;">
                            <th scope="column" width="5%">No</th>
                            <th scope="column" width="35%">Guest Name</th>
                            <th scope="column" width="15%">Room No.</th>
                            <th scope="column" width="15">Check In Date</th>
                            <th scope="column" width="15%">Check Out Date</th>
                            <th scope="column" width="15%">Modify</th>
                        </tr>
                        <tbody class="table-success">

                            <?php
                            require_once('../repositories/BookingRepository.php');
                            $bookingRepo = new BookingRepository($conn);
                            $checkInBookings = $bookingRepo->getBookingsTable('confirmed');

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                $numrow=0;
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $numrow++;
                            ?>
                            <tr>
                            <td><?=$numrow?></td>
                            <td><?= $row["firstName"]?> <?= $row["lastName"]?></td>
                            <td><?= $row["roomNo"]?></td>
                            <td><?= $row["check_in"]?></td>
                            <td><?= $row["check_out"]?></td>

                            <td>
                            <div class="d-grid gap-2 d-block">
                            <button type="button" class="btn btn-success checkinit" data-book="<?= $row['bookID']?>">Check-In</button>
                            <button type="button" class="btn btn-danger cancelit" data-book="<?= $row['bookID']?>" data-room="<?= $row['roomID'] ?>">Cancel</button>
                            </div>
                            </td>
                            </tr>

                            <?php

                            }
                            }
                            else {
                                echo '<tr><td colspan="7">🕵️‍♂️ No customers confirmed bookings founded, Empty data ! 😕 </td></tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>


        <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="editToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
        <strong class="me-auto">System</strong>
        <small>A changes made...</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        Successfully Check-in Guest-san
        </div>
    </div>

    <div id="deleteToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
        <strong class="me-auto">System</strong>
        <small>A changes made...</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        Successfully Cancel Guest-san Last Minute Cancel..
        </div>
    </div>

    <div id="addToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <img src="<?= $hotelicon?>" class="rounded me-2" alt="..." style="width:15px; height:15px;">
        <strong class="me-auto">System</strong>
        <small>A changes made...</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        Successfully Add Hotel Service
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="action.js"></script>
</body>
</html>
