<?php

class Client {
    
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $numero_telephone;
    private float $limite_credit;

    public function __construct(int $id, string $nom, string $prenom, string $email, string $numero_telephone, float $limite_credit) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->numero_telephone = $numero_telephone;
        $this->limite_credit = $limite_credit;
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

    public function getLimiteCredit(): float {
        return $this->limite_credit;
    }

    public function setLimiteCredit(float $limite_credit): void {
        $this->limite_credit = $limite_credit;
    }
}



