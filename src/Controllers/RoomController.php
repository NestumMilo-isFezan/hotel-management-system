<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\RoomRepository;
use App\Repositories\HotelRepository;

class RoomController extends Controller
{
    private RoomRepository $roomRepository;
    private HotelRepository $hotelRepository;

    public function __construct()
    {
        $this->roomRepository = new RoomRepository();
        $this->hotelRepository = new HotelRepository();
    }

    public function index(): void
    {
        $hotel = $this->hotelRepository->getHotelInfo();
        $rooms = $this->roomRepository->getAllAvailableRooms();

        $this->render('rooms/index', [
            'hotel' => $hotel,
            'rooms' => $rooms
        ]);
    }
}
