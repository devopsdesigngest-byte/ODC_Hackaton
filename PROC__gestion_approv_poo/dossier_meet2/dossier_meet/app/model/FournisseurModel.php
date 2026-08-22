<?php

require_once dirname(__DIR__) . '/core/Database.php';

function get_all_fournisseur() {
    $pdo = connexionDB();
    $sql = "SELECT * FROM fournisseurs";
    return query($pdo, $sql, false);
}