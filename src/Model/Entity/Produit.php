<?php 

require_once "LigneCommande.php";
require_once "LigneApprovisionnement.php";

class Produit {
    
    private int $id;
    private string $libelle;
    private float $prix_vente;
    private int $stock_initial;

    private array $lignesCommande = [];
    private array $lignesApprovisionnement = [];

    public function __construct(int $id, string $libelle, float $prix_vente, int $stock_initial) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->prix_vente = $prix_vente;
        $this->stock_initial = $stock_initial;
        $this->lignesCommande = [];
        $this->lignesApprovisionnement = [];
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getLibelle() : string {
        return $this->libelle;
    }

    public function setLibelle(string $libelle) : void {
        $this->libelle = $libelle;
    }

    public function getPrixVente() : float {
        return $this->prix_vente;
    }

    public function setPrixVente(float $prix_vente) : void {
        $this->prix_vente = $prix_vente;
    }

    public function getStockInitial() : int {
        return $this->stock_initial;
    }

    public function setStockInitial(int $stock_initial) : void {
        $this->stock_initial = $stock_initial;
    }

    public function getLignesCommande() : array {
        return $this->lignesCommande;
    }

    public function ajouterLigneCommande(LigneCommande $ligneCommande) : void {
        $this->lignesCommande[] = $ligneCommande;
    }

    public function getLignesApprovisionnement() : array {
        return $this->lignesApprovisionnement;
    }

    public function ajouterLigneApprovisionnement(LigneApprovisionnement $ligneApprovisionnement) : void {
        $this->lignesApprovisionnement[] = $ligneApprovisionnement;
    }
}