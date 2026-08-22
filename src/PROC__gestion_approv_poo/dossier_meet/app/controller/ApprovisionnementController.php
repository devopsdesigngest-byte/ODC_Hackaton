<?php
require_once dirname(__DIR__) . "/model/FournisseurModel.php";
require_once dirname(__DIR__) . "/model/ProduitModel.php";
require_once dirname(__DIR__) . "/model/ApprovisionnementModel.php";

function initPanier():void{
    $_SESSION["panier"] = [];
}

function accueilPage():void{
    if(!isset($_SESSION["panier"])){
        initPanier();
    }
    $paniers = getPanier();
   
    $fournisseurs = get_all_fournisseur();
    $produits = get_all_produits();
    require_once dirname(__DIR__) . "/views/approvisionnement.html.php";
}

function addAppro():void{
    $paniers = getPanier();
    $data["appro"]["fournisseur_id"] = $_POST["fournisseur_id"];
    $data["appro"]["ref_bordereau_livraison"] = $_POST["ref_bordereau_livraison"];
    
    foreach($paniers["item"] as $item){
        $data["ligne_appro"]["article_id"] = $item['article_id'];
        $data["ligne_appro"]["prix_achat"] = $item['prix_achat'];
        $data["ligne_appro"]["quantite"] = $item["quantite"];
    }
    echo '<pre>';
     var_dump($data);
     echo '</pre>';
    die;
    
}

function addPanier():void{
    $article = explode("_", $_POST["article"]);
    $data["article_id"] = $article[0];
    $data["libelle"] = $article[1];
    $data["prix_achat"] = $article[2];
    $data["quantite"] = $_POST["quantite_appro"];
    $data["montant"] = $_POST["quantite_appro"] * $data["prix_achat"];
        
    // $_SESSION["panier"]["article"][] = $data;
    $_SESSION["panier"][] = $data;
    // echo '<pre>';
    // var_dump($_SESSION["panier"]);
    // echo '</pre>';
    // die;
    header("Location:http://localhost:8004/");
}

function getPanier():array{
    $panier["item"] = $_SESSION["panier"];
    // echo '<pre>';
    //  var_dump($panier);
    //  echo '</pre>';
    // die;
    foreach($panier["item"] as $item){
        $panier["montant"] += $item["montant"];
    }

    return $panier;
}