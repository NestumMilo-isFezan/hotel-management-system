<?php
require("../directory.php");
require (TEMP_DIR."/adminpart.php");
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
                    <li class="list-group-item active">
                        <a href="index.php" class="nav-link text-white">
                            <i class='bx bxs-home me-sm-2 fs-4'></i>
                            <span class="d-inline-block">Home</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="hotel-info/index.php" class="nav-link text-white">
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
                                            <li class="list-group-item"><a href="room/index.php" class="link-body-emphasis text-decoration-none rounded mb-sm-3"><i class='bx bxs-plus-square me-sm-2 fs-4' ></i><span class="d-inline-block">Hotel Room</span></a></li>
                                            <li class="list-group-item"><a href="room-type/index.php" class="link-body-emphasis text-decoration-none rounded mb-sm-1"><i class='bx bxs-layer-plus me-sm-2 fs-4'></i><span class="d-inline-block">Room Type</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a href="service/index.php" class="nav-link text-white">
                        <i class='bx bxs-cog me-sm-2 fs-4' ></i>
                        <span class="d-inline-block">Manage Service</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="book/index.php" class="nav-link text-white">
                        <i class='bx bxs-book-bookmark me-sm-2 fs-4' ></i>
                        <span class="d-inline-block">Manage Booking</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="checkin/index.php" class="nav-link text-white">
                        <i class='bx bx-list-check me-sm-2 fs-4' ></i>
                        <span class="d-inline-block">Manage Check In</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="checkout/index.php" class="nav-link text-white">
                        <i class='bx bx-list-minus me-sm-2 fs-4' ></i>
                        <span class="d-inline-block">Manage Check Out</span>
                        </a>
                    </li>
                </ul>
                <hr>
            </div>
            <div class="dropdown mx-2 align-self-end">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../img/user_icon.png" alt="" width="32" height="32" class="rounded-circle me-sm-2">
                    <span class="d-inline-block"><strong><?= $firstName?></strong></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#"><i class='bx bxs-user-plus me-sm-2' ></i><span class="ms-1">Add Staff</span></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="../auth/logout.php"><i class='bx bxs-log-out me-sm-2' ></i><span class="ms-1">Sign out</span></a></li>
                </ul>
            </div>
                
            </div>
        </div>
    </div>

    <!--Container Main start-->
    <div class="container-fluid">
        <div id="home" class="text-center h-100" style="height: 150px; background-image: url('<?= $hotelimg?>'); background-size:cover; background-repeat: no-repeat;">
            <div class="px-2 pt-2 w-100 y-100 h-50 d-flex" style="background: rgb(32,32,39); background: linear-gradient(90deg, rgba(32,32,39,0.3) 0%, rgba(53,53,78, 0.3) 28%, rgba(94,94,108, 0.3) 70%, rgba(111,106,106, 0.3) 100%); backdrop-filter: blur(5px);">
                <div class="px-2 pt-2 pt-sm-3 m-auto" style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);">
                <div>
                    <h1 class="display-4" style="font-family: 'Staatliches';">Welcome to the<br><span class="display-1" style="color:#22092C;"><?= $hotelname?></span></h1>
                    <p class="fs-5 mt-2 mx-auto w-75" style="font-family: 'Poppins';"><?= $info?></p>
                </div>
                </div>
            </div>
        </div>


        <?php
            $sqlTotalBooked = "SELECT COUNT(*) as totalBooked FROM booking WHERE status = 'pending'";
            $resultTotalBooked = mysqli_query($conn, $sqlTotalBooked);

            if ($resultTotalBooked) {
                $rowTotalBooked = mysqli_fetch_assoc($resultTotalBooked);
                $totalBooked = $rowTotalBooked['totalBooked'];
            } 
            else {
                $totalBooked = 0; 
            }
        ?>
        <div class="container-fluid h-100 pb-5" style="height: 70vh;">

            <div class="row h-100 pt-4 row-cols-1 row-cols-md-3">

                <!-- Card 1 -->
                <?php
                    $sqlTotalBooked = "SELECT COUNT(*) as totalBooked FROM booking WHERE status = 'pending'";
                    $resultTotalBooked = mysqli_query($conn, $sqlTotalBooked);

                    if ($resultTotalBooked) {
                        $rowTotalBooked = mysqli_fetch_assoc($resultTotalBooked);
                        $totalBooked = $rowTotalBooked['totalBooked'];
                    } 
                    else {
                        $totalBooked = 0; 
                    }
                ?>
                <div class="col py-2" style="height: 400px;">
                    <div class="card h-100">
                        <div class="card-header fw-bold fs-5">
                            Total Booked
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-1">
                                <p fs-5>Total booked : <?= $totalBooked ?></p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            

                <!-- Card 2 -->
                <?php
                $sql = "SELECT COUNT(*) as totalCheckIns FROM booking WHERE status = 'checkin'";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $totalCheckIns = $row['totalCheckIns'];
                } 
                else {
                    $totalCheckIns = 0;
                }
                ?>
                <div class="col py-2" style="height: 400px;">
                    <div class="card h-100">
                        <div class="card-header fw-bold fs-5">
                            Total Check-In
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>Total check-ins : <?= $totalCheckIns ?></p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            

                <!-- Card 3 -->
                <?php
                $sqlCheckOut = "SELECT COUNT(*) as totalCheckOuts FROM booking WHERE status = 'checkout'";
                $resultCheckOut = mysqli_query($conn, $sqlCheckOut);

                if ($resultCheckOut) {
                    $rowCheckOut = mysqli_fetch_assoc($resultCheckOut);
                    $totalCheckOuts = $rowCheckOut['totalCheckOuts'];
                } else {
                    $totalCheckOuts = 0;
                }
                ?>
                <div class="col py-2" style="height: 400px;">
                    <div class="card h-100">
                        <div class="card-header">
                            Total Check-Out
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>Total check-outs : <?= $totalCheckOuts ?></p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
            

                <!-- Row 2 Card 1 -->
                <?php
                $sqlCancelled = "SELECT COUNT(*) as totalCancelled FROM booking WHERE status = 'cancelled'";
                $resultCancelled = mysqli_query($conn, $sqlCancelled);

                if ($resultCancelled) {
                    $rowCancelled = mysqli_fetch_assoc($resultCancelled);
                    $totalCancelled = $rowCancelled['totalCancelled'];
                } else {
                    $totalCancelled = 0;
                }
                ?>
            <div class="row h-100 py-3 row-cols-1 row-cols-sm-2">
                <div class="col-md-6 py-2" style="height: 400px;">
                    <div class="card h-100">
                        <div class="card-header">
                            Total Cancelled
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>Total cancelled : <?= $totalCancelled ?></p>
                            </blockquote>
                        </div>
                    </div>
                </div>

                <!-- Row 2 Card 2 -->
                <?php
                // Calculate total sales for all records
                $sqlTotalSales = "SELECT SUM(amountpay - balance) as totalSales FROM payment";
                $resultTotalSales = mysqli_query($conn, $sqlTotalSales);

                if ($resultTotalSales) {
                    $rowTotalSales = mysqli_fetch_assoc($resultTotalSales);
                    $totalSales = $rowTotalSales['totalSales'];
                } 
                else {
                    $totalSales = 0;
                }
                ?>
                <div class="col-md-6 py-2" style="height: 400px;">
                    <div class="card h-100">
                        <div class="card-header">
                            Total Sales
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>Total Sales : RM <?= number_format($totalSales, 2) ?></p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Container Main end-->


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
