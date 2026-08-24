<?php
namespace App\Model\Entity;

class Utilisateur {
    private ?int $id;
    private string $nom_complet;
    private string $email;
    private string $mot_de_passe;
    public ?string $adresse;
    private string $numero_telephone;

    private Role $role;

    public function __construct(?int $id, string $nom_complet, string $email, string $mot_de_passe, string $numero_telephone, Role $role) {
        $this->id = $id;
        $this->nom_complet = $nom_complet;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
        $this->numero_telephone = $numero_telephone;
        $this->role = $role;
    }

    public function getId() : ?int {
        return $this->id;
    }
    public function setId(int $id) : void {
        if($id > 0)
            $this->id = $id;
    }

    public function getNomComplet() : string {
        return $this->nom_complet;
    }

    public function setNomComplet(string $nom_complet) : void {
        $this->nom_complet = $nom_complet;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function setEmail(string $email) : void {
        $this->email = $email;
    }

    public function getMotDePasse() : string {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe) : void {
        $this->mot_de_passe = $mot_de_passe;
    }

    public function getNumeroTelephone() : string {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone(string $numero_telephone) : void {
        $this->numero_telephone = $numero_telephone;
    }

    public function getRole() : Role {
        return $this->role;
    }

    public function setRole(Role $role) : void {
        $this->role = $role;
    }
}
