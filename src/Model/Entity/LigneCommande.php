<?php

namespace App\Model\Entity;

class LigneCommande {
    private int $id;
    private int $quantite;
    private float $prix_unitaire;
    private float $sous_total;

    private Commande $commande;
    private Produit $produit;

    public function __construct(int $id, int $quantite, float $prix_unitaire, float $sous_total, Commande $commande, Produit $produite) {
        $this->id = $id;
        $this->quantite = $quantite;
        $this->prix_unitaire = $prix_unitaire;
        $this->sous_total = $sous_total;
        $this->commande = $commande;
        $this->produit = $produit;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getQuantite(): int {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): void {
        $this->quantite = $quantite;
    }

    public function getPrixUnitaire(): float {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(float $prix_unitaire): void {
        $this->prix_unitaire = $prix_unitaire;
    }

    public function getSousTotal(): float {
        return $this->sous_total;
    }

    public function setSousTotal(float $sous_total): void {
        $this->sous_total = $sous_total;
    }

    public function getCommande(): Commande {
        return $this->commande;
    }

    public function setCommande(Commande $commande): void {
        $this->commande = $commande;
    }

    public function getProduit(): Produit {
        return $this->produit;
    }

    public function setProduit(Produit $produit): void {
        $this->produit = $produit;
    }
}

