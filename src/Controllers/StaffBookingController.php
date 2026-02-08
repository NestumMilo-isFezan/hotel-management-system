<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Repositories\BookingRepository;
use App\Repositories\HotelRepository;
use App\Repositories\RoomRepository;

class StaffBookingController extends Controller
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
        $pending = $this->bookingRepository->getByStatus('pending');
        $confirmed = $this->bookingRepository->getByStatus('confirmed');
        $cancelled = $this->bookingRepository->getByStatus('cancelled');

        $this->render('staff/bookings/index', [
            'hotel' => $hotel,
            'pending' => $pending,
            'confirmed' => $confirmed,
            'cancelled' => $cancelled
        ]);
    }

    public function confirm(): void
    {
        $id = (int)$_POST['id'];
        $booking = $this->bookingRepository->findById($id);
        
        if ($booking && $this->bookingRepository->updateStatus($id, 'confirmed')) {
            $this->roomRepository->updateStatus((int)$booking['roomID'], 'unavailable');
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function delete(): void
    {
        $id = (int)$_POST['id'];
        if ($this->bookingRepository->delete($id)) {
            echo "ok";
        } else {
            echo "error";
        }
    }
}
