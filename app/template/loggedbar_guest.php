<?php 
    // Directory
    $homedir = "../../index.php";
    $newsdir = "../../index.php#news";
    $contactdir = "../../index.php#contact";
?>

<nav class="navbar navbar-expand-lg bg-dark shadow-lg" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
        <img src="<?= $hotelicon?>" alt="Hotel" width="35" height="35">
        Hotel
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-center pt-1">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?= $homedir?>">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?= $newsdir?>">News</a>
                </li>
                <li class="nav-item d-grid pb-2 px-1">
                <button class="btn btn-outline-success" type="button" onclick="javascript:location.href='../room/index.php'">Book Now</button>
                </li>
            </ul>

            <div class="dropdown ms-3 mb-2 justify-content-center d-flex">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?= $img_path?>" alt="" width="32" height="32" class="rounded-circle me-sm-2">
                    <span class="ms-2 ms-sm-1"><strong><?= $firstName?></strong></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="../profile/index.php"><i class='bx bxs-user-circle' ></i><span class="ms-1">Manage Profile</span></a></li>
                    <li><a class="dropdown-item" href="../guest_confirm/index.php"><i class='bx bxs-bed me-sm-2'></i><span class="ms-1">Manage Booking</span></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="../../auth/logout.php"><i class='bx bxs-log-out me-sm-2' ></i><span class="ms-1">Sign out</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>