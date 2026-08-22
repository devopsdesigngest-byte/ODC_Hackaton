<?php
require_once __DIR__ . '/models/produitModel.php';
require_once __DIR__ . '/models/venteModel.php';

function affichervue()
{
    $CasCritiques=getStockCritique(5);
   $commandes=getAllCommande();
 
    require_once __DIR__ . '/view/affichage.php';
}