<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Repositories\FinancialRepository;
use App\Repositories\HotelRepository;

class StaffFinancialController extends Controller
{
    private FinancialRepository $financialRepository;
    private HotelRepository $hotelRepository;

    public function __construct()
    {
        AuthMiddleware::staffOnly();
        $this->financialRepository = new FinancialRepository();
        $this->hotelRepository = new HotelRepository();
    }

    public function index(): void
    {
        $hotel = $this->hotelRepository->getHotelInfo();
        $summary = $this->financialRepository->getSummary();
        $byMethod = $this->financialRepository->getRevenueByMethod();
        $daily = $this->financialRepository->getDailyRevenue();
        $transactions = $this->financialRepository->getAllTransactions();

        $this->render('staff/reports/financial', [
            'hotel' => $hotel,
            'summary' => $summary,
            'byMethod' => $byMethod,
            'daily' => $daily,
            'transactions' => $transactions
        ]);
    }
}
