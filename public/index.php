<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();

// Routes
$router->add('GET', '/', 'HomeController', 'index');
$router->add('POST', '/login', 'AuthController', 'login');
$router->add('POST', '/register', 'AuthController', 'register');
$router->add('GET', '/logout', 'AuthController', 'logout');

// Rooms & Booking
$router->add('GET', '/rooms', 'RoomController', 'index');
$router->add('GET', '/book', 'BookingController', 'index');
$router->add('POST', '/book', 'BookingController', 'book');
$router->add('GET', '/get-service-price', 'BookingController', 'getServicePrice');

// Guest Profile & History
$router->add('GET', '/profile', 'GuestProfileController', 'index');
$router->add('POST', '/profile/update', 'GuestProfileController', 'update');
$router->add('GET', '/my-bookings', 'GuestBookingHistoryController', 'index');
$router->add('POST', '/my-bookings/cancel', 'GuestBookingHistoryController', 'cancel');

// Staff
$router->add('GET', '/staff/dashboard', 'StaffController', 'dashboard');
$router->add('GET', '/staff/rooms', 'StaffRoomController', 'index');
$router->add('POST', '/staff/rooms/add', 'StaffRoomController', 'add');
$router->add('POST', '/staff/rooms/delete', 'StaffRoomController', 'delete');

// Staff Bookings
$router->add('GET', '/staff/bookings', 'StaffBookingController', 'index');
$router->add('POST', '/staff/bookings/confirm', 'StaffBookingController', 'confirm');
$router->add('POST', '/staff/bookings/delete', 'StaffBookingController', 'delete');

// Staff Check-In
$router->add('GET', '/staff/checkin', 'StaffCheckInController', 'index');
$router->add('POST', '/staff/checkin/process', 'StaffCheckInController', 'checkin');
$router->add('POST', '/staff/checkin/cancel', 'StaffCheckInController', 'cancel');

// Staff Check-Out
$router->add('GET', '/staff/checkout', 'StaffCheckOutController', 'index');
$router->add('POST', '/staff/checkout/process', 'StaffCheckOutController', 'checkout');

// Staff Hotel Info & News
$router->add('GET', '/staff/hotel-info', 'StaffHotelInfoController', 'index');
$router->add('POST', '/staff/hotel-info/update', 'StaffHotelInfoController', 'updateInfo');
$router->add('POST', '/staff/news/add', 'StaffHotelInfoController', 'addNews');
$router->add('POST', '/staff/news/delete', 'StaffHotelInfoController', 'deleteNews');

// Staff Services
$router->add('GET', '/staff/services', 'StaffServiceController', 'index');
$router->add('POST', '/staff/services/add', 'StaffServiceController', 'add');
$router->add('POST', '/staff/services/delete', 'StaffServiceController', 'delete');

// Staff Room Types
$router->add('GET', '/staff/room-types', 'StaffRoomTypeController', 'index');
$router->add('POST', '/staff/room-types/add', 'StaffRoomTypeController', 'add');
$router->add('POST', '/staff/room-types/delete', 'StaffRoomTypeController', 'delete');

// Staff Payments
$router->add('GET', '/staff/payment', 'StaffPaymentController', 'index');
$router->add('POST', '/staff/payment/process', 'StaffPaymentController', 'process');

// Staff Reports
$router->add('GET', '/staff/reports/financial', 'StaffFinancialController', 'index');

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
