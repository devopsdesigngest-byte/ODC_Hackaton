<?php

require_once dirname(__DIR__) . "/controller/controller.php";

function Router() : void {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch ($uri) {

        case '/':
            listerApprov();
            break;
        case'/save':
            enregistrerApprov();
            break;

        default:
            http_response_code(404);
            die("Erreur de routing");
    }
}