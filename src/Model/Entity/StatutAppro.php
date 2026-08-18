<?php

require_once "Approvisionnement.php";

class StatutAppro {
    private int $id;
    private string $libelle;

    private array $approvisionnements = [];

    public function __construct(int $id, string $libelle) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->approvisionnements = [];
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

    public function getApprovisionnements() : array {
        return $this->approvisionnements;
    }

    public function ajouterApprovisionnement(Approvisionnement $approvisionnement) : void {
        $this->approvisionnements[] = $approvisionnement;
    }
}