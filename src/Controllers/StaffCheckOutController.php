<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Repositories\BookingRepository;
use App\Repositories\HotelRepository;
use App\Repositories\RoomRepository;

class StaffCheckOutController extends Controller
{
    private BookingRepository $bookingRepository;
    private HotelRepository $hotelRepository;
    private RoomRepository $roomRepository;

    public function __construct()
    {
        AuthMiddleware::staffOnly();
        $this->bookingRepository = new BookingRepository();
        $this->hotelRepository = new HotelRepository();
        $this->roomRepository = new RoomRepository();
    }

    public function index(): void
    {
        $hotel = $this->hotelRepository->getHotelInfo();
        $toCheckOut = $this->bookingRepository->getByStatus('checkin');
        $checkedOut = $this->bookingRepository->getByStatus('checkout');

        $this->render('staff/checkout/index', [
            'hotel' => $hotel,
            'toCheckOut' => $toCheckOut,
            'checkedOut' => $checkedOut
        ]);
    }

    public function checkout(): void
    {
        // We no longer update status here. 
        // The view will redirect to payment, and payment completion will update status.
        echo "ok";
    }
}
