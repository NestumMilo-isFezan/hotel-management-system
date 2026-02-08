<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Middleware\AuthMiddleware;
use App\Repositories\UserRepository;
use App\Repositories\HotelRepository;

class GuestProfileController extends Controller
{
    private UserRepository $userRepository;
    private HotelRepository $hotelRepository;

    public function __construct()
    {
        AuthMiddleware::guestOnly();
        $this->userRepository = new UserRepository();
        $this->hotelRepository = new HotelRepository();
    }

    public function index(): void
    {
        $guestId = (int)Session::get('guestID');
        $guest = $this->userRepository->getGuestDetails($guestId);
        $hotel = $this->hotelRepository->getHotelInfo();

        $this->render('guest/profile/index', [
            'guest' => $guest,
            'hotel' => $hotel
        ]);
    }

    public function update(): void
    {
        $guestId = (int)Session::get('guestID');
        $data = [
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'address' => $_POST['address'],
            'postcode' => $_POST['postcode'],
            'city' => $_POST['city'],
            'state' => $_POST['state'],
            'country' => $_POST['country']
        ];

        if ($this->userRepository->updateGuest($guestId, $data)) {
            echo "ok";
        } else {
            echo "error";
        }
    }
}
