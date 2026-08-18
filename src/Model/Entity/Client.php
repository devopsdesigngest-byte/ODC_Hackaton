<?php
require_once "Commande.php";

class Client {
    
    private int $id;
    private string $nom;
    private string $prenom;
    public string $email;
    private string $numero_telephone;
    private float $limite_credit;

    private array $commandes = [];

    public function __construct(int $id, string $nom, string $prenom, string $numero_telephone, float $limite_credit) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numero_telephone = $numero_telephone;
        $this->limite_credit = $limite_credit;
        $this->commandes = [];
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

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }

    public function getNumeroTelephone(): string {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone(string $numero_telephone): void {
        $this->numero_telephone = $numero_telephone;
    }

    public function getLimiteCredit(): float {
        return $this->limite_credit;
    }

    public function setLimiteCredit(float $limite_credit): void {
        if($limite_credit > 1000)
            $this->limite_credit = $limite_credit;
    }

    public function getCommandes(): array {
        return $this->commandes;
    }

    public function ajouterCommande(Commande $commande): void {
        $this->commandes[] = $commande;
    }
}