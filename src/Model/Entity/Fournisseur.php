<?php

require_once "Approvisionnement.php";

class Fournisseur {
    
    private int $id;
    private string $nom;
    private string $email;
    private string $numero_telephone;
    private string $adresse;

    private array $approvisionnements = [];

    public function __construct(int $id, string $nom, string $email, string $numero_telephone, string $adresse) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->numero_telephone = $numero_telephone;
        $this->adresse = $adresse;
        $this->approvisionnements = [];
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getNumeroTelephone(): string {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone(string $numero_telephone): void {
        $this->numero_telephone = $numero_telephone;
    }

    public function getAdresse(): string {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): void {
        $this->adresse = $adresse;
    }

    public function getApprovisionnements(): array {
        return $this->approvisionnements;
    }

    public function ajouterApprovisionnement(Approvisionnement $approvisionnement): void {
        $this->approvisionnements[] = $approvisionnement;
    }
}