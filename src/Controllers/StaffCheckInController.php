<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Repositories\BookingRepository;
use App\Repositories\HotelRepository;

class StaffCheckInController extends Controller
{
    private BookingRepository $bookingRepository;
    private HotelRepository $hotelRepository;

    public function __construct()
    {
        AuthMiddleware::staffOnly();
        $this->bookingRepository = new BookingRepository();
        $this->hotelRepository = new HotelRepository();
    }

    public function index(): void
    {
        $hotel = $this->hotelRepository->getHotelInfo();
        $bookings = $this->bookingRepository->getByStatus('confirmed');

        $this->render('staff/checkin/index', [
            'hotel' => $hotel,
            'bookings' => $bookings
        ]);
    }

    public function checkin(): void
    {
        $id = (int)$_POST['id'];
        if ($this->bookingRepository->updateStatus($id, 'checkin')) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function cancel(): void
    {
        $id = (int)$_POST['id'];
        if ($this->bookingRepository->updateStatus($id, 'cancelled')) {
            // Room is already 'unavailable' from confirmation, but let's make sure it stays that way or logic changes
            echo "ok";
        } else {
            echo "error";
        }
    }
}
