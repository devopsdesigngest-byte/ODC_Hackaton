<?php

// require_once "src/Core/Database.php";

// use App\Core\Database;

// $database = Database::getInstance();

// $pdo = $database->getConnection();

// echo "Connexion réussie " . PHP_EOL;
// echo "Base utilisée : " . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . PHP_EOL;


// require_once "src/Core/Database.php";
// use App\Core\Database;

// $e0 = new Database();
// $e1 = new Database();
// var_dump($e0);   
// var_dump($e1);   
// var_dump(Database::$monInstance2);   



use App\Core\Database;

require_once "src/Model/Repository/ClientRepository.php";


$repo = new ClientRepository();
$clients = $repo->getAllClient();
// var_dump($clients);
foreach ($clients as $client) {
    echo $client->getNom() . " ";
    echo $client->getPrenom() . PHP_EOL;
}
