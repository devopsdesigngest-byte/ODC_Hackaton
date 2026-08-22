<?php

// require_once dirname(__DIR__) . "/models/ApprovModel.php";
// require_once dirname(__DIR__) . "/models/ArticleModel.php";
// require_once dirname(__DIR__) . "/models/FournisseurModel.php";

// // require_once dirname(__DIR__) . "/model/FournisseurModel.php";
// // require_once dirname(__DIR__) . "/model/ProduitModel.php";
// // require_once dirname(__DIR__) . "/model/ApprovisionnementModel.php";


// function initApprov() : void {
    
// }


// function listerApprov() : void {

//     $getAllConcordance = getAllConcordance();
    

//     // $articlesRupture = getArticleRupture();
//     // $getFournisseurAppro = getFournisseurAppro();

//     // $getAllFournisseur = getAllFournisseur();
//     // $getAllArticles = getAllArticles();

//     // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     //     $approvisionnementId = $_POST['approvisionnementId'];
//     //     $lignes = $_POST['lignes'];
//     //     encoursVersReceptionne($approvisionnementId, $lignes);
//     // }

//     require_once dirname(__DIR__) . "/view/approv.html.php";
// }



// function enregistrerApprov() : void {

// }



// function supprimerLignePanier() : void {

// }



















function initAppro() : void {
    set_session("appro", [
        'lignes' => [],
        'montant' => 0
    ]);
}
function formAppro() : void {
    if (!isset($_SESSION['appro'])) 
        initAppro();
    $fournisseurs = get_all_fournisseur();
    $articles = get_all_produits();
    require_once dirname(__DIR__) . "/views/approvisionnement.html.php";
}

function supprimerProduitDansSession() : void {

}

function ajouterProduitDansSession(array $ligneAppro) : void {
    $_SESSION['appro']['lignes'][] = $ligneAppro;
    $_SESSION['appro']['montant'] += $ligneAppro['montant'];
}

function enregistrerApprovisionnement() : void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: http://localhost:8000/');
        exit;
    }
    if ($_POST['btnActionAppro'] == 'saveSession') {

        if ($_POST['article'] != 0 && $_POST['quantite'] != 0) {
            $article = explode("_", $_POST['article']);
            $montant = $_POST['quantite'] * $article[2];
            ajouterProduitDansSession([

                'id_produit' => $article[0],
                'libelle' => $article[1],
                'prix' => $article[2],
                'quantite' => $_POST['quantite'],
                'montant' => $montant

            ]);
        }
        header('Location: http://localhost:8000/');
        exit;
    } else if ($_POST['btnActionAppro'] == 'saveAppro') {
        if ($_POST['fournisseur'] == 0 || empty($_POST['bl'])) {
            header('Location: http://localhost:8000/');
            exit;
        }
        $result = saveApprovisionnement( $_POST['fournisseur'], $_POST['bl'],  $_SESSION['appro']['lignes']);
        if ($result) {
            initAppro();
            header('Location: http://localhost:8000/');
            exit;
        }
    }
}




















// function supprimerLignePanier() : void {
//     $id = $_GET['id'] ?? null;
//     if ($id === null) {
//         header('Location: /');
//         exit;
//     }
//     unset($_SESSION['appro']['lignes'][$id]);
//     $_SESSION['appro']['lignes'] = array_values($_SESSION['appro']['lignes']);
//     header('Location: /');
//     exit;
// }