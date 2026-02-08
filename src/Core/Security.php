<?php
declare(strict_types=1);

namespace App\Core;

class Security
{
    public static function escape(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }

    public static function generateCsrfToken(): string
    {
        Session::start();

        if (!Session::get('csrf_token')) {
            Session::set('csrf_token', bin2hex(random_bytes(32)));
        }

        return Session::get('csrf_token');
    }

    public static function verifyCsrfToken(?string $token): bool
    {
        Session::start();
        $storedToken = Session::get('csrf_token');
        
        return $storedToken && $token && hash_equals($storedToken, $token);
    }
}
