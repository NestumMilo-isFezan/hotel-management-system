<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\HotelRepository;
use App\Repositories\NewsRepository;

class HomeController extends Controller
{
    public function index(): void
    {
        $hotelRepo = new HotelRepository();
        $newsRepo = new NewsRepository();

        $hotelInfo = $hotelRepo->getHotelInfo();
        $latestNews = $newsRepo->getLatestNews();

        $this->render('home', [
            'title' => 'Welcome to ' . ($hotelInfo['hotelname'] ?? 'Hotel Management System'),
            'hotel' => $hotelInfo,
            'news' => $latestNews
        ]);
    }
}
