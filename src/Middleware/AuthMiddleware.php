<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Core\Session;

class AuthMiddleware
{
    public static function handle(): void
    {
        if (!Session::get('user')) {
            header('Location: /');
            exit;
        }
    }

    public static function staffOnly(): void
    {
        self::handle();
        if (!Session::get('staffID')) {
            header('Location: /');
            exit;
        }
    }

    public static function guestOnly(): void
    {
        self::handle();
        if (!Session::get('guestID')) {
            header('Location: /');
            exit;
        }
    }
}
