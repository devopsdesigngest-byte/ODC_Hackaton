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
    $data["appro"]["refbl"] = $_POST["ref_bordereau_livraison"];
    
    foreach($paniers["item"] as $item){
        $data["ligne_appro"]["article_id"] = $item['article_id'];
        $data["ligne_appro"]["prix_achat_reel"] = $item['prix_achat'];
        $data["ligne_appro"]["quantite_appro"] = $item["quantite"];
    }
    // echo '<pre>';
    //  var_dump($data);
    //  echo '</pre>';
    // die;

    $id = saveApprovisionnement($data);


    
}

function addPanier():void{
    $article = explode("_", $_POST["article"]);
    $data["article_id"] = $article[0];
    $data["libelle"] = $article[1];
    $data["prixachat"] = $article[2];
    $data["quantite"] = (int)$_POST["qteappro"];
    $data["montant"] =(int) $_POST["qteappro"] *(int) $data["prixachat"];
        
    // $_SESSION["panier"]["article"][] = $data;
    $_SESSION["panier"][] = $data;
    // echo '<pre>';
    // var_dump($_SESSION["panier"]);
    // echo '</pre>';
    // die;
    header("Location:http://localhost:8001/");
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