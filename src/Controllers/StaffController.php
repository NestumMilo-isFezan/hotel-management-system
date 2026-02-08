<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Middleware\AuthMiddleware;
use App\Repositories\DashboardRepository;
use App\Repositories\HotelRepository;
use App\Repositories\StaffRepository;

class StaffController extends Controller
{
    private DashboardRepository $dashboardRepository;
    private HotelRepository $hotelRepository;
    private StaffRepository $staffRepository;

    public function __construct()
    {
        AuthMiddleware::staffOnly();
        $this->dashboardRepository = new DashboardRepository();
        $this->hotelRepository = new HotelRepository();
        $this->staffRepository = new StaffRepository();
    }

    public function dashboard(): void
    {
        $staffId = (int)Session::get('staffID');
        $staff = $this->staffRepository->findById($staffId);
        $hotel = $this->hotelRepository->getHotelInfo();
        $stats = $this->dashboardRepository->getStats();

        $this->render('staff/dashboard', [
            'staff' => $staff,
            'hotel' => $hotel,
            'stats' => $stats
        ]);
    }
}
