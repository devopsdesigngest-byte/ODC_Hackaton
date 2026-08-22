<?php

require_once dirname(__DIR__) . '/core/Database.php';

function get_all_fournisseur() {
    $pdo = connexionDB();
    $sql = "SELECT * FROM fournisseur";
    return query($pdo, $sql, false);
}