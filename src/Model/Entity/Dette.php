<?php

require_once "Commande.php";
require_once "Reglement.php";

class Dette {
    private int $id;
    private float $montant_initial;
    private float $montant_restant;
    private DateTime $date_creation;
    private ?DateTime $date_echeance;
    private string $statut;

    private Commande $commande;
    private array $reglements = [];

    public function __construct(int $id, float $montant_initial, float $montant_restant, DateTime $date_creation, ?DateTime $date_echeance, string $statut, Commande $commande) {
        $this->id = $id;
        $this->montant_initial = $montant_initial;
        $this->montant_restant = $montant_restant;
        $this->date_creation = $date_creation;
        $this->date_echeance = $date_echeance;
        $this->statut = $statut;
        $this->commande = $commande;
        $this->reglements = [];
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getMontant_initial(): float {
        return $this->montant_initial;
    }

    public function setMontant_initial(float $montant_initial): void {
        $this->montant_initial = $montant_initial;
    }

    public function getMontant_restant(): float {
        return $this->montant_restant;
    }

    public function setMontant_restant(float $montant_restant): void {
        $this->montant_restant = $montant_restant;
    }

    public function getDate_creation(): DateTime {
        return $this->date_creation;
    }

    public function setDate_creation(DateTime $date_creation): void {
        $this->date_creation = $date_creation;
    }

    public function getDate_echeance(): ?DateTime {
        return $this->date_echeance;
    }

    public function setDate_echeance(?DateTime $date_echeance): void {
        $this->date_echeance = $date_echeance;
    }

    public function getStatut(): string {
        return $this->statut;
    }

    public function setStatut(string $statut): void {
        $this->statut = $statut;
    }

    public function getCommande(): Commande {
        return $this->commande;
    }

    public function setCommande(Commande $commande): void {
        $this->commande = $commande;
    }

    public function getReglements(): array {
        return $this->reglements;
    }

    public function ajouterReglement(Reglement $reglement): void {
        $this->reglements[] = $reglement;
    }
}