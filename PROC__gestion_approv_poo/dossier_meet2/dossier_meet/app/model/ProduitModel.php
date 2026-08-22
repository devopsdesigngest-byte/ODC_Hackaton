<?php

require_once dirname(__DIR__) . '/core/Database.php';

function get_all_produits() {
    $pdo = connexionDB();
    $sql = "SELECT * FROM articles ORDER BY libelle ASC";
    return query($pdo, $sql, false);
}