<?php

require_once dirname(__DIR__) . '/database.php';
function getProduitStockCritique(int $nombrelimit=5):array{
   $pdo = connexionDB();

    $sql = "SELECT libelle,qteStock,
    CASE
    WHEN qteStock>2 THEN 'warning'
    ELSE 'danger'
    END AS color
     FROM produits WHERE qteStock<=:nombrelimit ORDER BY qteStock DESC";
    $produitStockCritique = executeQuery($pdo,$sql,['nombrelimit'=>$nombrelimit],false);

// var_dump($produitStockCritique);
// die;
    $pdo = null;
return $produitStockCritique;
}