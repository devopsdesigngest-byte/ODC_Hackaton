<?php

require_once dirname(__DIR__)."/database.php";

function getStockCritique($max=5){
    $connexion=connexionDb();


$sql="SELECT libelle,qteStock,
CASE
 WHEN qteStock < 2 THEN 'danger'
ELSE 'warning'
END AS color
 FROM produits WHERE qteStock <=:max ORDER BY qteStock DESC";
$prepare=$connexion->prepare($sql);
$prepare->execute([
    'max'=>$max
]);
$CasCritiques=$prepare->fetchAll(PDO::FETCH_ASSOC);
$connexion=null;

return $CasCritiques;
}