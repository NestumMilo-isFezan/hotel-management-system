<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Repositories\BookingRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\HotelRepository;

class BookingController extends Controller
{
    private BookingRepository $bookingRepository;
    private RoomRepository $roomRepository;
    private ServiceRepository $serviceRepository;
    private HotelRepository $hotelRepository;

    public function __construct()
    {
        $this->bookingRepository = new BookingRepository();
        $this->roomRepository = new RoomRepository();
        $this->serviceRepository = new ServiceRepository();
        $this->hotelRepository = new HotelRepository();
    }

    public function index(): void
    {
        $guestID = Session::get('guestID');
        if (!$guestID) {
            $this->redirect('/');
        }

        $roomId = (int)($_GET['room'] ?? 0);
        if (!$roomId) {
            $this->redirect('/');
        }

        $room = $this->roomRepository->getRoomWithDetails($roomId);
        if (!$room) {
            $this->redirect('/');
        }

        $services = $this->serviceRepository->getAvailableServices();
        $hotel = $this->hotelRepository->getHotelInfo();

        $this->render('booking/index', [
            'room' => $room,
            'services' => $services,
            'hotel' => $hotel,
            'guestID' => $guestID
        ]);
    }

    public function book(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['status' => 'error', 'message' => 'Invalid request method']);
            return;
        }

        $guestID = Session::get('guestID');
        if (!$guestID) {
            echo "error";
            return;
        }

        $data = [
            'roomId' => (int)$_POST['roomID'],
            'guestId' => $guestID,
            'serviceId' => (int)$_POST['services'],
            'checkIn' => date('Y-m-d H:i:s', strtotime($_POST['checkin'])),
            'checkOut' => date('Y-m-d H:i:s', strtotime($_POST['checkout'])),
            'total' => (float)$_POST['totalprice']
        ];

        if ($this->bookingRepository->create($data)) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function getServicePrice(): void
    {
        $serviceId = (int)($_GET['service'] ?? 0);
        $service = $this->serviceRepository->findById($serviceId);
        $this->json($service ?: ['price' => 0]);
    }
}
