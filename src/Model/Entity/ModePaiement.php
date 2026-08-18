<?php

require_once "Commande.php";
require_once "Reglement.php";

class ModePaiement {
    private int $id;
    private string $libelle;

    private array $commandes = [];
    private array $reglements = [];

    public function __construct(int $id, string $libelle) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->commandes = [];
        $this->reglements = [];
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

    public function getCommandes() : array {
        return $this->commandes;
    }

    public function ajouterCommande(Commande $commande) : void {
        $this->commandes[] = $commande;
    }

    public function getReglements() : array {
        return $this->reglements;
    }

    public function ajouterReglement(Reglement $reglement) : void {
        $this->reglements[] = $reglement;
    }
}