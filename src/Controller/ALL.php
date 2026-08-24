<?php

namespace App\Controller;
use App\Core\Debug;
use App\Model\DTO\ProduitDTO;
use App\Model\Entity\Produit;
use App\Model\Repository\ClientRepository as C;
use App\Model\Repository\FournisseurRepository as F;
use App\Model\Repository\ProduitRepository as P;
use App\Core\Debug as DD;
use App\Core\Controller as ctr;

class ALL
{
    public function __construct()
    {
    }

    public static function tiers(): void
    {
        // DD::dd($clients);
        // ctr::redirectToRoute('/');
        // exit;
        $clients = C::getAllClients();
        $produits = P::getAllProduits();
        $fournisseurs = F::getAllFournisseurs();
        $nbrClient = C::getNreClients();
        $nbrProd = P::getNreProduits();
        $VST = P::valeurStockTotal();

        $action = $_POST['action'];

        if ($action == 'fournisseur')
            // DD::dd($_POST);
            F::saveFournisseur($_POST);

        if ($action == 'client')
            C::saveClient($_POST);

        if ($action == 'produit') {
            $newProduit = new ProduitDTO(
                libelle: $_POST['libelle'],
                prix_vente: (float) $_POST['prix_vente'],
                stock_initial: (int) $_POST['stock_initial']
            );
            P::saveProduit($newProduit);
        }
        require_once(PATHBASE . "/src/View/Commerce.html.php");


        // L’objectif est de séparer clairement les responsabilités entre les différentes parties de l’application. Le Controller ne doit plus récupérer directement les données provenant des formulaires avec POST ou GET. Les données sont d’abord récupérées par une couche dédiée à la requête, puis transformées en DTO. Le DTO sert uniquement à transporter les informations nécessaires, par exemple les informations d’un produit, d’un client ou d’un fournisseur.
        // Le parcours devient donc : le formulaire envoie les données, la couche de requête les récupère, le DTO les transporte, puis le Controller reçoit ce DTO et appelle le Model. Le Model communique ensuite avec le SessionManager lorsqu’il s’agit de données liées à la session et avec PostgreSQL lorsqu’il s’agit des données de la base. Ainsi, le Controller ne connaît pas directement la manière dont les données ont été envoyées.
        // Le DTO permet également d'éviter de transmettre des tableaux provenant directement de la requête dans toute l’application. Chaque DTO représente un ensemble précis de données et peut être rendu immuable afin que les informations transportées ne soient pas modifiées accidentellement pendant leur parcours.
        // Pour l’affichage, on utilise ensuite renderView. Cette méthode permet au Controller de transmettre les données nécessaires à une vue sans faire directement un require de la vue dans chaque méthode. Le Controller indique simplement quelle vue doit être affichée et quelles données doivent lui être transmises.
        // RenderViewLayout sert au même principe, mais avec une organisation basée sur un layout. La vue est d’abord exécutée et son contenu est récupéré grâce au système de bufferisation. Ce contenu est ensuite transmis au layout, qui peut contenir les éléments communs de l’application comme l’en-tête, le menu, le pied de page ou la structure générale de la page.
        // Ainsi, le Controller reste principalement un coordinateur : il reçoit les données déjà préparées sous forme de DTO, demande au Model d’effectuer l’opération nécessaire, puis utilise renderView ou renderViewLayout pour envoyer les résultats à la vue.
        // Le parcours général devient donc : requête → DTO → Controller → Model → SessionManager ou PostgreSQL → Controller → renderView/renderViewLayout → Vue.
        // Cette organisation permet d’avoir un code plus propre, plus facile à maintenir et surtout de respecter la séparation entre la réception des données, leur transport, le traitement métier, l’accès à la base de données et l’affichage.
    }

    public static function appro(): void
    {



        require_once(PATHBASE . "/src/View/Commerce.html.php");

    }

}