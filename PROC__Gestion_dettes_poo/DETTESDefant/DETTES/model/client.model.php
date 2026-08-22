<?php

function getAllClients():array{
    $pdo = connexionDB();

    $sql = "SELECT c.id, c.nom || ' ' || c.prenom AS nomComplet FROM clients c";

    $datas = query($pdo, $sql, false);

    $pdo = null;

    return $datas;
}