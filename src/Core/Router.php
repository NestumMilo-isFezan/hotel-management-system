<?php
declare(strict_types=1);

namespace App\Core;

class Router
{
    protected array $routes = [];

    public function add(string $method, string $uri, string $controller, string $action): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                $controllerClass = "App\\Controllers\\" . $route['controller'];
                $action = $route['action'];

                if (!class_exists($controllerClass)) {
                    die("Controller class $controllerClass not found");
                }

                $controller = new $controllerClass();
                
                if (!method_exists($controller, $action)) {
                    die("Action $action not found in controller $controllerClass");
                }

                $controller->$action();
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
