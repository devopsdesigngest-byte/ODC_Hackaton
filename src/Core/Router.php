<?php
namespace App\Core;

use App\Controller\ALL as A;

class Router
{
    private static array $routes = [
        '/tiers' => [
            'controller' => A::class,
            'action' => 'tiers'
        ],
        '/appro' => [
            'controller' => A::class,
            'action' => 'appro'
        ],
    ];
    private function __construct()
    {
    }
    public static function router(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $route = self::$routes[$uri];

        if ($route == null) {
            http_response_code(404);
            die("Page 404 LNO MBOW");
        }

        $controller = $route['controller'];
        $action = $route['action'];

        $ctr = new $controller();
        $ctr->$action();
    }
}


