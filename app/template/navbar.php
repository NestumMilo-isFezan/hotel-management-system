<?php 
    // Directory
    $homedir = "index.php";
    $newsdir = "index.php#news";
    $contactdir = "index.php#contact";
?>

<nav class="navbar navbar-expand-lg bg-dark shadow-lg" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
        <img src="<?= $hotelicon?>" alt="Bootstrap" width="35" height="35">
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
            <li class="nav-item">
            <a class="nav-link" href="<?= $contactdir?>">Contact</a>
            </li>
            <li class="nav-item d-grid pb-2 px-1">
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginmodal">Log In</button>
            </li>
            <li class="nav-item d-grid pb-2 px-1">
            <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#registermodal">Sign Up</button>
            </li>
        </ul>
        </div>
    </div>
</nav>