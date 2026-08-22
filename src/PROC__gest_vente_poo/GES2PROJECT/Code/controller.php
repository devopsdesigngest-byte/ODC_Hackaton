<?php
require_once((__DIR__)."/models/produitModel.php");

function dashboard(){
    $ProduitStockCritique=getProduitStockCritique();
    renderView('nouvelle_commande.html.php',['ProduitStockCritique'=>$ProduitStockCritique]);
}

function renderView(string $file,array $datas){
extract($datas);
require_once((__DIR__)."/view/$file");

}