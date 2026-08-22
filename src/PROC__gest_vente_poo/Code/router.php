<?php

$routes = [
    '/' => [
        'controller'=>'controller', 
        'action'=>'dashboard'
    ]
];

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $route=$routes[$uri] ?? $routes['/'];

    $controller = $route['controller'];

    $action = $route['action'];
    if(file_exists((__DIR__)."/".$controller.".php")){
        require_once((__DIR__)."/".$controller.".php");

        if(function_exists($action)){
            $action();
        }
    }
    else{
        http_response_code(404);
        echo "Page not found";
    }
    
