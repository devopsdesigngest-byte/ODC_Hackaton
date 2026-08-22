<?php 
require_once (PATHBASE. "/app/controller/DetteController.php");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($uri){
    case '/':
        listerDette();
        break;

    case '/save-dette':
        enregistrerDette();
        break;

    case '/save-reglement':
        enregisterReglement();
        break;

    default :
        die("Erreur de routing");   
    break;
}