<?php

$Routes = [
    ['/', 'ApprovisionnementController.php', 'accueilPage'],
    ['/addAppro', 'ApprovisionnementController.php', 'addAppro'],
    ['/addPanier', 'ApprovisionnementController.php', 'addPanier']
];
// addPanier
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

$routeFound = false;

foreach ($Routes as $route) {
    if ($route[0] === $uri) {
        $controllerFile = dirname(__DIR__) . '/controller/' . $route[1];
        $action = $route[2];

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (function_exists($action)) {
                $action();
                $routeFound = true;
                break;
            }
        }
    }
}

if (!$routeFound) {
    http_response_code(404);
    echo "<h1>404 - Page non trouvée</h1>";
}
