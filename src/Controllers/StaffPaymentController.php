<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Repositories\PaymentRepository;
use App\Repositories\BookingRepository;
use App\Repositories\HotelRepository;
use App\Repositories\RoomRepository;

class StaffPaymentController extends Controller
{
    private PaymentRepository $paymentRepository;
    private BookingRepository $bookingRepository;
    private HotelRepository $hotelRepository;
    private RoomRepository $roomRepository;

    public function __construct()
    {
        AuthMiddleware::staffOnly();
        $this->paymentRepository = new PaymentRepository();
        $this->bookingRepository = new BookingRepository();
        $this->hotelRepository = new HotelRepository();
        $this->roomRepository = new RoomRepository();
    }

    public function index(): void
    {
        $bookingId = (int)($_GET['bookID'] ?? 0);
        if (!$bookingId) {
            $this->redirect('/staff/bookings');
        }

        $hotel = $this->hotelRepository->getHotelInfo();
        $booking = $this->bookingRepository->findById($bookingId);
        $lastPayment = $this->paymentRepository->getLatestPaymentByBookingId($bookingId);

        $this->render('staff/payment/index', [
            'hotel' => $hotel,
            'booking' => $booking,
            'lastPayment' => $lastPayment
        ]);
    }

    public function process(): void
    {
        $bookingId = (int)$_POST['payid'];
        $amountPaid = (float)$_POST['amountpay'];
        $method = $_POST['paymethod'];
        
        $booking = $this->bookingRepository->findById($bookingId);
        if (!$booking) {
            $this->redirect('/staff/bookings');
        }

        $lastPayment = $this->paymentRepository->getLatestPaymentByBookingId($bookingId);
        $previousBalance = $lastPayment ? (float)$lastPayment['balance'] : (float)$booking['total_price'];
        
        $newBalance = $previousBalance - $amountPaid;

        $data = [
            'bookId' => $bookingId,
            'amount' => $amountPaid,
            'balance' => $newBalance,
            'method' => $method
        ];

        if ($this->paymentRepository->create($data)) {
            // If balance reaches 0 or below, we finalize the checkout
            if ($newBalance <= 0) {
                $this->bookingRepository->updateStatus($bookingId, 'checkout');
                $this->roomRepository->updateStatus((int)$booking['roomID'], 'available');
                $this->redirect("/staff/payment?bookID=$bookingId&success=1");
            }
            $this->redirect("/staff/payment?bookID=$bookingId&success=1");
        } else {
            $this->redirect("/staff/payment?bookID=$bookingId&error=1");
        }
    }
}
