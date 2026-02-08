<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Repositories\HotelRepository;
use App\Repositories\NewsRepository;

class StaffHotelInfoController extends Controller
{
    private HotelRepository $hotelRepository;
    private NewsRepository $newsRepository;

    public function __construct()
    {
        AuthMiddleware::staffOnly();
        $this->hotelRepository = new HotelRepository();
        $this->newsRepository = new NewsRepository();
    }

    public function index(): void
    {
        $hotel = $this->hotelRepository->getHotelInfo();
        $news = $this->newsRepository->getAll();

        $this->render('staff/hotel-info/index', [
            'hotel' => $hotel,
            'news' => $news
        ]);
    }

    public function updateInfo(): void
    {
        $data = [
            'hotelname' => $_POST['hotelname'],
            'email' => $_POST['email'],
            'contact' => $_POST['contact'],
            'address' => $_POST['address'],
            'postcode' => $_POST['postcode'],
            'city' => $_POST['city'],
            'state' => $_POST['state'],
            'info' => $_POST['info'],
            'about' => $_POST['about']
        ];

        if ($this->hotelRepository->update(1, $data)) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function addNews(): void
    {
        $data = [
            'hotelId' => 1,
            'title' => $_POST['newstitle'],
            'description' => $_POST['description']
        ];

        if ($this->newsRepository->create($data)) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function deleteNews(): void
    {
        $id = (int)$_POST['id'];
        if ($this->newsRepository->delete($id)) {
            echo "ok";
        } else {
            echo "error";
        }
    }
}
