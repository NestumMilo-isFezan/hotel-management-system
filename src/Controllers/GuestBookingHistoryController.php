<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Middleware\AuthMiddleware;
use App\Repositories\BookingRepository;
use App\Repositories\HotelRepository;

class GuestBookingHistoryController extends Controller
{
    private BookingRepository $bookingRepository;
    private HotelRepository $hotelRepository;

    public function __construct()
    {
        AuthMiddleware::guestOnly();
        $this->bookingRepository = new BookingRepository();
        $this->hotelRepository = new HotelRepository();
    }

    public function index(): void
    {
        $guestId = (int)Session::get('guestID');
        $bookings = $this->bookingRepository->getByGuestId($guestId);
        $hotel = $this->hotelRepository->getHotelInfo();

        $this->render('guest/bookings/index', [
            'bookings' => $bookings,
            'hotel' => $hotel
        ]);
    }

    public function cancel(): void
    {
        $id = (int)$_POST['id'];
        $guestId = (int)Session::get('guestID');
        $booking = $this->bookingRepository->findById($id);

        if ($booking && (int)$booking['guestID'] === $guestId && $booking['status'] === 'pending') {
            if ($this->bookingRepository->updateStatus($id, 'cancelled')) {
                echo "ok";
                return;
            }
        }
        echo "error";
    }
}
