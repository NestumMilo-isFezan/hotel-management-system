<?php
require("../../directory.php");
require (TEMP_DIR."/adminpart.php");

echo 
'<div class="offcanvas offcanvas-start h-100" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
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
                        <a href="#" class="nav-link text-white">
                            <i class="bx bxs-home me-sm-2 fs-4"></i>
                            <span class="d-inline-block">Home</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="nav-link text-white">
                            <i class="bx bxs-building-house me-sm-2 fs-4"></i>
                            <span class="d-inline-block">Manage Hotel</span>
                        </a>
                    </li>
                    <li class="list-unstyled">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <i class="bx bxs-hotel fs-4"></i>&nbsp;<span class="ms-1 d-inline-block">Manage Room</span>
                                </button>
                                </h3>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="container-fluid w-100 h-100">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal list-group">
                                            <li class="list-group-item"><a href="../room/index.php" class="link-body-emphasis text-decoration-none rounded mb-sm-3"><i class="bx bxs-plus-square me-sm-2 fs-4"></i><span class="d-inline-block">Hotel Room</span></a></li>
                                            <li class="list-group-item"><a href="../room-type/index.php" class="link-body-emphasis text-decoration-none rounded mb-sm-1"><i class="bx bxs-layer-plus me-sm-2 fs-4"></i><span class="d-inline-block">Room Type</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a href="../service/index.php" class="nav-link text-white">
                        <i class="bx bxs-cog me-sm-2 fs-4"></i>
                        <span class="d-inline-block">Manage Service</span>
                        </a>
                    </li>
                    <li class="list-group-item active">
                        <a href="../book/index.php" class="nav-link text-white">
                        <i class="bx bxs-book-bookmark me-sm-2 fs-4"></i>
                        <span class="d-inline-block">Manage Booking</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="../checkin/index.php" class="nav-link text-white">
                        <i class="bx bx-list-check me-sm-2 fs-4"></i>
                        <span class="d-inline-block">Manage Check In</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="../checkout/index.php" class="nav-link text-white">
                        <i class="bx bx-list-minus me-sm-2 fs-4"></i>
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
                        <li><a class="dropdown-item" href="#"><i class="bx bxs-user-plus me-sm-2"></i><span class="ms-1">Add Staff</span></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../auth/logout.php"><i class="bx bxs-log-out me-sm-2"></i><span class="ms-1">Sign out</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>';

?>
