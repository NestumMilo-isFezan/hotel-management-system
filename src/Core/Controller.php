<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Security;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        // Add CSRF token to all views by default
        $data['csrf_token'] = Security::generateCsrfToken();
        
        extract($data);
        $viewPath = __DIR__ . "/../../views/$view.php";
        
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            die("View $view not found at $viewPath");
        }
    }

    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }

    protected function json(mixed $data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
