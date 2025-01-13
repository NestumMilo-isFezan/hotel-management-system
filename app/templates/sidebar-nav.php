<?php
function renderSidebarNav($activePage) {
    global $hotelicon, $hotelname;
?>
    <div class="offcanvas offcanvas-start h-100" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Hotel Logo Section -->
            <div>
                <a href="./index.php" class="d-flex align-items-center mb-0 mb-md-3 me-md-auto text-white text-decoration-none">
                    <img src="<?= $hotelicon?>" alt="<?= $hotelname?>" width="33" height="33" class="me-sm-2">
                    <span class="fs-5 fw-bold"><?= $hotelname?></span>
                </a>
                <hr>
                <!-- Navigation Items -->
                <?php echo generateNavItems($activePage); ?>
            </div>
        </div>
    </div>
<?php
}

function generateNavItems($activePage) {
    $navItems = [
        'home' => ['../index.php', 'bxs-home', 'Home'],
        'hotel-info' => ['../hotel-info/index.php', 'bxs-building-house', 'Manage Hotel'],
        'checkin' => ['../checkin/index.php', 'bx-list-check', 'Manage Check In'],
        'checkout' => ['../checkout/index.php', 'bx-list-minus', 'Manage Check Out']
        // Add other nav items here
    ];

    $output = '<ul class="flex-column mb-auto list-group mx-1">';
    foreach ($navItems as $key => $item) {
        $isActive = ($key === $activePage) ? 'active' : '';
        $output .= generateNavItem($item[0], $item[1], $item[2], $isActive);
    }
    $output .= '</ul>';
    return $output;
}
?>
