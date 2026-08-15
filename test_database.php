<?php

require_once "src/Core/Database.php";

use App\Core\Database;

$database = Database::getInstance();

$pdo = $database->getConnection();

echo "Connexion réussie !" . PHP_EOL;
echo "Base utilisée : "
    . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME)
    . PHP_EOL;