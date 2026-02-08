<style>
    #offcanvasExample {
        background-color: rgba(26, 26, 26, 0.95);
        backdrop-filter: blur(10px);
        border-right: 1px solid rgba(255, 255, 255, 0.05);
        width: 280px;
    }
    .nav-link-custom {
        color: rgba(255, 255, 255, 0.7);
        padding: 10px 15px;
        border-radius: 10px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        text-decoration: none;
        margin-bottom: 4px;
        font-weight: 500;
        font-size: 0.9rem;
    }
    .nav-link-custom:hover {
        background-color: rgba(255, 255, 255, 0.05);
        color: #fff;
    }
    .nav-link-custom.active {
        background-color: #0d6efd;
        color: #fff;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }
    .nav-link-custom i {
        font-size: 1.25rem;
        margin-right: 12px;
        width: 24px;
        text-align: center;
    }
    .sidebar-section-title {
        font-size: 0.7rem;
        text-uppercase;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.3);
        margin-top: 20px;
        margin-bottom: 10px;
        padding-left: 15px;
        letter-spacing: 1px;
    }
    .user-profile-btn {
        background-color: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 12px;
        transition: all 0.2s;
    }
    .user-profile-btn:hover {
        background-color: rgba(255, 255, 255, 0.07);
    }
</style>

<div class="offcanvas offcanvas-start h-100" tabindex="-1" id="offcanvasExample">
    <div class="offcanvas-header border-bottom border-white border-opacity-10 py-4">
        <div class="d-flex align-items-center">
            <div class="bg-primary bg-gradient p-2 rounded-3 me-3 shadow-sm">
                <img src="/upload/home/home_icon.png" alt="Hotel Icon" width="24" height="24">
            </div>
            <h5 class="offcanvas-title fw-bold text-white mb-0" style="font-family: 'Poppins'; letter-spacing: 0.5px;">
                HMS <span class="text-primary text-opacity-75">Pro</span>
            </h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body d-flex flex-column px-3">
        <div class="mb-auto">
            <div class="sidebar-section-title">Core Management</div>
            <a href="/staff/dashboard" class="nav-link-custom <?= str_contains($_SERVER['REQUEST_URI'], 'dashboard') ? 'active' : '' ?>">
                <i class='bx bxs-dashboard'></i> Dashboard
            </a>
            <a href="/staff/hotel-info" class="nav-link-custom <?= str_contains($_SERVER['REQUEST_URI'], 'hotel-info') ? 'active' : '' ?>">
                <i class='bx bxs-building'></i> Hotel Info
            </a>

            <div class="sidebar-section-title">Operations</div>
            <a href="/staff/bookings" class="nav-link-custom <?= str_contains($_SERVER['REQUEST_URI'], 'bookings') ? 'active' : '' ?>">
                <i class='bx bxs-calendar-check'></i> Bookings
            </a>
            <a href="/staff/checkin" class="nav-link-custom <?= str_contains($_SERVER['REQUEST_URI'], 'checkin') ? 'active' : '' ?>">
                <i class='bx bx-log-in-circle'></i> Check-In
            </a>
            <a href="/staff/checkout" class="nav-link-custom <?= str_contains($_SERVER['REQUEST_URI'], 'checkout') ? 'active' : '' ?>">
                <i class='bx bx-log-out-circle'></i> Check-Out
            </a>

            <div class="sidebar-section-title">Inventory</div>
            <a href="/staff/rooms" class="nav-link-custom <?= str_contains($_SERVER['REQUEST_URI'], 'rooms') && !str_contains($_SERVER['REQUEST_URI'], 'room-types') ? 'active' : '' ?>">
                <i class='bx bxs-door-open'></i> Manage Rooms
            </a>
            <a href="/staff/room-types" class="nav-link-custom <?= str_contains($_SERVER['REQUEST_URI'], 'room-types') ? 'active' : '' ?>">
                <i class='bx bxs-category'></i> Room Types
            </a>
            <a href="/staff/services" class="nav-link-custom <?= str_contains($_SERVER['REQUEST_URI'], 'services') ? 'active' : '' ?>">
                <i class='bx bxs-concierge'></i> Services
            </a>

            <div class="sidebar-section-title">Analytics</div>
            <a href="/staff/reports/financial" class="nav-link-custom <?= str_contains($_SERVER['REQUEST_URI'], 'financial') ? 'active' : '' ?>">
                <i class='bx bxs-bar-chart-alt-2'></i> Financial Reports
            </a>
        </div>

        <div class="mt-4 pb-4">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle user-profile-btn" data-bs-toggle="dropdown">
                    <img src="/img/user_icon.png" alt="User" width="32" height="32" class="rounded-circle me-3 border border-white border-opacity-10">
                    <div class="me-auto">
                        <div class="fw-bold small"><?= \App\Core\Security::escape($staff['firstName'] ?? 'Staff') ?></div>
                        <div class="text-secondary" style="font-size: 0.7rem;">Staff Member</div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow-lg border-white border-opacity-10 rounded-3">
                    <li><a class="dropdown-item py-2" href="/logout"><i class='bx bx-log-out-circle me-2'></i> Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>