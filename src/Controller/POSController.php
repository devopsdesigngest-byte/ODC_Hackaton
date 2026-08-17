<?php

require_once dirname(__DIR__) . '/Model/Repository/ClientRepository.php';
require_once dirname(__DIR__) . '/Model/Repository/ProduitRepository.php';
require_once dirname(__DIR__) . '/Model/Repository/ModePaiementRepository.php';
require_once dirname(__DIR__) . '/Service/VenteService.php';

class POSController {
    public function showVue(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['btn'] === 'panier') 
                $this->ajouterDansPanier();
           
            if ($_POST['btn'] === 'valider') 
                $this->enregistrerVente();
        }

        $insClient = new ClientRepository();
        $clients = $insClient->getAllClient();

        $insProduit = new ProduitRepository();
        $produits = $insProduit->getAllProduit();

        $insMode = new ModePaiementRepository();
        $modes = $insMode->getAllModePaiement();

        $panier = $_SESSION['panier'] ?? [];

        require_once dirname(__DIR__) . '/views/pos/index.php';
    }


    public function ajouterDansPanier(): void
    {
        $produit = explode('|', $_POST['produit_id']);
        $quantite = (int) $_POST['quantite'];

        $_SESSION['panier'] ??= [];

        $_SESSION['panier'][] = [
            'produitId' => (int) $produit[0],
            'prixUnitaire' => (float) $produit[1],
            'stock' => (int) $produit[2],
            'libelle' => $produit[3],
            'quantite' => $quantite,
            'sousTotal' => (float) $produit[1] * $quantite
        ];
    }


    public function enregistrerVente(): void
    {
        $venteService = new VenteService();

        $venteService->enregistrerVente(
            (int) $_POST['client_id'],
            (int) $_SESSION['utilisateur_id'],
            (int) $_POST['mode_reglement'],
            (float) $_POST['montant_verse'],
            $_SESSION['panier']
        );

        unset($_SESSION['panier']);
    }
}