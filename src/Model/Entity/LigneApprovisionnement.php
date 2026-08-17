<?php

require_once "Approvisionnement.php";
require_once "Produit.php";

class LigneApprovisionnement {
    private int $id;
    private int $quantite_commandee;
    private int $quantite_recue;
    private float $prix_unitaire;

    private Approvisionnement $approvisionnement;
    private Produit $produit;

    public function __construct(int $id, int $quantite_commandee, int $quantite_recue, float $prix_unitaire, Approvisionnement $approvisionnement, Produit $produit) {
        $this->id = $id;
        $this->quantite_commandee = $quantite_commandee;
        $this->quantite_recue = $quantite_recue;
        $this->prix_unitaire = $prix_unitaire;
        $this->approvisionnement = $approvisionnement;
        $this->produit = $produit;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getQuantiteCommandee(): int {
        return $this->quantite_commandee;
    }

    public function setQuantiteCommandee(int $quantite_commandee): void {
        $this->quantite_commandee = $quantite_commandee;
    }

    public function getQuantiteRecue(): int {
        return $this->quantite_recue;
    }

    public function setQuantiteRecue(int $quantite_recue): void {
        $this->quantite_recue = $quantite_recue;
    }

    public function getPrixUnitaire(): float {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(float $prix_unitaire): void {
        $this->prix_unitaire = $prix_unitaire;
    }

    public function getApprovisionnement(): Approvisionnement {
        return $this->approvisionnement;
    }

    public function setApprovisionnement(Approvisionnement $approvisionnement): void {
        $this->approvisionnement = $approvisionnement;
    }

    public function getProduit(): Produit {
        return $this->produit;
    }

    public function setProduit(Produit $produit): void {
        $this->produit = $produit;
    }
}