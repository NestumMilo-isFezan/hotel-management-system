<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Dashboard - <?= \App\Core\Security::escape($hotel['hotelname'] ?? 'Hotel') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #1a1a1a; }
        .card { border-radius: 15px; border: none; transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
        .stat-icon { font-size: 2.5rem; opacity: 0.3; position: absolute; right: 15px; bottom: 10px; }
        .hero-section { border-radius: 20px; overflow: hidden; position: relative; }
        .btn-action { border-radius: 10px; padding: 10px 20px; font-weight: 500; transition: all 0.3s; }
        .progress { height: 8px; border-radius: 4px; }
    </style>
</head>
<body class="vh-100" data-bs-theme="dark">
    <button class="btn m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
        <i class='bx bx-menu fs-3'></i>
    </button>

    <?php include __DIR__ . '/../partials/staff_sidebar.php'; ?>

    <div class="container-fluid px-4 pb-5">
        <!-- Hero Section -->
        <div class="hero-section mb-4 shadow-lg" style="height: 180px; background-image: url('<?= \App\Core\Security::escape($hotel['hotelimg'] ?? '') ?>'); background-size:cover; background-position: center;">
            <div class="w-100 h-100 d-flex" style="background: linear-gradient(90deg, rgba(20,20,25,0.85) 0%, rgba(32,32,39,0.4) 100%); backdrop-filter: blur(2px);">
                <div class="my-auto ms-5 text-white">
                    <h1 class="display-6 fw-bold mb-1" style="font-family: 'Staatliches'; letter-spacing: 1px;">Hello, <?= \App\Core\Security::escape($staff['firstName'] ?? 'Staff') ?></h1>
                    <p class="fs-6 text-info mb-0 text-uppercase fw-semibold" style="letter-spacing: 2px;"><?= \App\Core\Security::escape($hotel['hotelname'] ?? '') ?> • Administrator</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column: Booking Stats -->
            <div class="col-lg-8">
                <h5 class="mb-3 fw-bold text-secondary text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Booking Overview</h5>
                <div class="row g-3">
                    <div class="col-sm-6 col-md-3">
                        <div class="card bg-primary bg-opacity-10 border border-primary border-opacity-25 h-100 p-3">
                            <small class="text-primary text-uppercase fw-bold" style="font-size: 0.7rem;">Pending</small>
                            <h2 class="mb-0 fw-bold"><?= $stats['pending'] ?></h2>
                            <i class='bx bx-time-five stat-icon text-primary'></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card bg-success bg-opacity-10 border border-success border-opacity-25 h-100 p-3">
                            <small class="text-success text-uppercase fw-bold" style="font-size: 0.7rem;">Checked-In</small>
                            <h2 class="mb-0 fw-bold"><?= $stats['checkin'] ?></h2>
                            <i class='bx bx-log-in-circle stat-icon text-success'></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card bg-info bg-opacity-10 border border-info border-opacity-25 h-100 p-3">
                            <small class="text-info text-uppercase fw-bold" style="font-size: 0.7rem;">Completed</small>
                            <h2 class="mb-0 fw-bold"><?= $stats['checkout'] ?></h2>
                            <i class='bx bx-check-double stat-icon text-info'></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card bg-danger bg-opacity-10 border border-danger border-opacity-25 h-100 p-3">
                            <small class="text-danger text-uppercase fw-bold" style="font-size: 0.7rem;">Cancelled</small>
                            <h2 class="mb-0 fw-bold"><?= $stats['cancelled'] ?></h2>
                            <i class='bx bx-x-circle stat-icon text-danger'></i>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <!-- Room Status -->
                    <div class="col-md-6">
                        <div class="card bg-dark border border-secondary border-opacity-25 h-100 p-4">
                            <h6 class="fw-bold mb-4">Room Availability</h6>
                            <?php 
                                $occupancyRate = $stats['total_rooms'] > 0 ? ($stats['occupied_rooms'] / $stats['total_rooms']) * 100 : 0;
                            ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary small">Occupancy Rate</span>
                                <span class="fw-bold"><?= round($occupancyRate) ?>%</span>
                            </div>
                            <div class="progress mb-4 bg-secondary bg-opacity-25">
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?= $occupancyRate ?>%"></div>
                            </div>
                            <div class="row text-center">
                                <div class="col-4 border-end border-secondary border-opacity-25">
                                    <div class="small text-secondary">Total</div>
                                    <div class="fw-bold fs-5"><?= $stats['total_rooms'] ?></div>
                                </div>
                                <div class="col-4 border-end border-secondary border-opacity-25">
                                    <div class="small text-success">Avail</div>
                                    <div class="fw-bold fs-5"><?= $stats['available_rooms'] ?></div>
                                </div>
                                <div class="col-4">
                                    <div class="small text-danger">Occu</div>
                                    <div class="fw-bold fs-5"><?= $stats['occupied_rooms'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Financial Stats -->
                    <div class="col-md-6">
                        <div class="card bg-warning bg-opacity-10 border border-warning border-opacity-25 h-100 p-4">
                            <h6 class="fw-bold mb-3 text-warning">Financial Summary</h6>
                            <small class="text-secondary text-uppercase" style="font-size: 0.7rem;">Total Revenue Collected</small>
                            <h1 class="display-6 fw-bold text-white mb-4">RM <?= number_format($stats['total_sales'], 2) ?></h1>
                            <a href="/staff/reports/financial" class="btn btn-warning btn-sm btn-action w-100">View Detailed Reports</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Quick Actions & Alerts -->
            <div class="col-lg-4">
                <h5 class="mb-3 fw-bold text-secondary text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Quick Management</h5>
                <div class="card bg-dark border border-secondary border-opacity-25 p-3 mb-3">
                    <div class="row g-2">
                        <div class="col-6">
                            <a href="/staff/checkin" class="btn btn-success btn-action w-100 h-100 d-flex flex-column align-items-center justify-content-center text-center py-3">
                                <i class='bx bx-list-check fs-3 mb-1'></i>
                                <span style="font-size: 0.8rem;">Check-In</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="/staff/checkout" class="btn btn-warning btn-action w-100 h-100 d-flex flex-column align-items-center justify-content-center text-center py-3 text-dark">
                                <i class='bx bx-log-out-circle fs-3 mb-1'></i>
                                <span style="font-size: 0.8rem;">Check-Out</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="/staff/bookings" class="btn btn-primary btn-action w-100 h-100 d-flex flex-column align-items-center justify-content-center text-center py-3">
                                <i class='bx bx-calendar-event fs-3 mb-1'></i>
                                <span style="font-size: 0.8rem;">Bookings</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="/staff/rooms" class="btn btn-outline-light btn-action w-100 h-100 d-flex flex-column align-items-center justify-content-center text-center py-3">
                                <i class='bx bx-door-open fs-3 mb-1'></i>
                                <span style="font-size: 0.8rem;">Rooms</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card bg-info bg-opacity-10 border border-info border-opacity-25 p-4">
                    <h6 class="fw-bold mb-3"><i class='bx bx-info-circle me-2'></i>Status Reminder</h6>
                    <ul class="list-unstyled mb-0 small text-secondary">
                        <li class="mb-2"><i class='bx bx-check text-info me-2'></i> Ensure all guest IDs are verified at check-in.</li>
                        <li class="mb-2"><i class='bx bx-check text-info me-2'></i> Daily room audits should be completed by 11 AM.</li>
                        <li><i class='bx bx-check text-info me-2'></i> High occupancy expected this weekend.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>