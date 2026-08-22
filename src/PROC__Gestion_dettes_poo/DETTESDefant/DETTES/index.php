<?php
require_once __DIR__."/model/database.php";

require_once __DIR__."/model/client.model.php";
require_once __DIR__."/model/dette.model.php";
$dettes = getAllDettes() ?? [];


//les statistiques
$statistiques = getStatisques();

$dettesRestantes = getDettesRestants();

$allClients = getAllClients();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
switch($uri){
    case '/save-dette':
        $_POST['ref'] = "ddfgg";
        $_POST['client_id'] = (int)$_POST['client_id'];
        $_POST['montant_restant'] = 0;
        
        saveDette($_POST);

        header("Location: http://localhost:8000/");
        break;
    case '/save-reglement':
        updateDette($data);
        break;
    case '/':
        require_once "accueil.php";
        break;
    default :
    break;
}









