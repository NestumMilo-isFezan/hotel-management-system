<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Repositories\ServiceRepository;
use App\Repositories\HotelRepository;

class StaffServiceController extends Controller
{
    private ServiceRepository $serviceRepository;
    private HotelRepository $hotelRepository;

    public function __construct()
    {
        AuthMiddleware::staffOnly();
        $this->serviceRepository = new ServiceRepository();
        $this->hotelRepository = new HotelRepository();
    }

    public function index(): void
    {
        $hotel = $this->hotelRepository->getHotelInfo();
        $services = $this->serviceRepository->getAll();

        $this->render('staff/services/index', [
            'hotel' => $hotel,
            'services' => $services
        ]);
    }

    public function add(): void
    {
        $data = [
            'hotelId' => 1,
            'name' => $_POST['servicename'],
            'description' => $_POST['description'],
            'price' => (float)$_POST['price'],
            'status' => $_POST['status']
        ];

        if ($this->serviceRepository->create($data)) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function delete(): void
    {
        $id = (int)$_POST['id'];
        if ($this->serviceRepository->delete($id)) {
            echo "ok";
        } else {
            echo "error";
        }
    }
}
