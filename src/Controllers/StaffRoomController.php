<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Repositories\RoomRepository;
use App\Repositories\HotelRepository;

class StaffRoomController extends Controller
{
    private RoomRepository $roomRepository;
    private HotelRepository $hotelRepository;

    public function __construct()
    {
        AuthMiddleware::staffOnly();
        $this->roomRepository = new RoomRepository();
        $this->hotelRepository = new HotelRepository();
    }

    public function index(): void
    {
        $rooms = $this->roomRepository->getAll();
        $hotel = $this->hotelRepository->getHotelInfo();
        $roomTypes = $this->roomRepository->getRoomTypes();

        $this->render('staff/rooms/index', [
            'rooms' => $rooms,
            'hotel' => $hotel,
            'roomTypes' => $roomTypes
        ]);
    }

    public function add(): void
    {
        $data = [
            'hotelId' => 1, // Default for now
            'typeId' => (int)$_POST['roomtype'],
            'roomNo' => $_POST['roomNo'],
            'status' => $_POST['roomstatus']
        ];

        if ($this->roomRepository->create($data)) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function delete(): void
    {
        $id = (int)$_POST['id'];
        if ($this->roomRepository->delete($id)) {
            echo "ok";
        } else {
            echo "error";
        }
    }
}
