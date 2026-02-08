<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Repositories\RoomRepository;
use App\Repositories\HotelRepository;

class StaffRoomTypeController extends Controller
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
        $hotel = $this->hotelRepository->getHotelInfo();
        $roomTypes = $this->roomRepository->getRoomTypes();

        $this->render('staff/room-types/index', [
            'hotel' => $hotel,
            'roomTypes' => $roomTypes
        ]);
    }

    public function add(): void
    {
        // Simple image upload simulation or just default for now
        $imgName = 'default.jpg';
        
        $data = [
            'hotelId' => 1,
            'name' => $_POST['roomtype'],
            'description' => $_POST['description'],
            'price' => (float)$_POST['price'],
            'capacity' => (int)$_POST['capacity'],
            'img' => $imgName
        ];

        if ($this->roomRepository->createRoomType($data)) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function delete(): void
    {
        $id = (int)$_POST['id'];
        if ($this->roomRepository->deleteRoomType($id)) {
            echo "ok";
        } else {
            echo "error";
        }
    }
}
