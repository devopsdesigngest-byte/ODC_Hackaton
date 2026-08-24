<?php

namespace App\Model\Entity;

use App\Model\Entity\Commande;
use stdClass;

class Client
{
    private ?int $id;
    private string $nom;
    private string $prenom;
    private string $numero_telephone;
    private float $limite_credit;
    private ?string $email;
    private array $commandes = [];

    public function __construct(
        string $nom = '',
        string $prenom = '',
        string $numero_telephone = '',
        float $limite_credit = 0,
        ?int $id = null,
        ?string $email = null
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numero_telephone = $numero_telephone;
        $this->limite_credit = $limite_credit;
        $this->id = $id;
        $this->email = $email;
    }

    public function __call($method, $arguments)
    {
        if (str_starts_with($method, 'get')) {
            $propriete = lcfirst(substr($method, 3));
            return $this->$propriete;
        }

        if (str_starts_with($method, 'set')) {
            $propriete = lcfirst(substr($method, 3));
            $this->$propriete = $arguments[0];
        }
    }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    // public function setId(?int $id): void
    // {
    //     $this->id = $id;
    // }

    // public function getNom(): string
    // {
    //     return $this->nom;
    // }

    // public function setNom(string $nom): void
    // {
    //     $this->nom = $nom;
    // }

    // public function getPrenom(): string
    // {
    //     return $this->prenom;
    // }

    // public function setPrenom(string $prenom): void
    // {
    //     $this->prenom = $prenom;
    // }

    // public function getEmail(): ?string
    // {
    //     return $this->email;
    // }

    // public function setEmail(?string $email): void
    // {
    //     $this->email = $email;
    // }

    // public function getNumeroTelephone(): string
    // {
    //     return $this->numero_telephone;
    // }

    // public function setNumeroTelephone(string $numero_telephone): void
    // {
    //     $this->numero_telephone = $numero_telephone;
    // }

    // public function getLimiteCredit(): float
    // {
    //     return $this->limite_credit;
    // }

    // public function setLimiteCredit(float $limite_credit): void
    // {
    //     if ($limite_credit > 1000) {
    //         $this->limite_credit = $limite_credit;
    //     }
    // }

    // public function getCommandes(): array
    // {
    //     return $this->commandes;
    // }

    // public function ajouterCommande(Commande $commande): void
    // {
    //     $this->commandes[] = $commande;
    // }


    public static function toEntity(stdClass $obj): self
    {
        return new self(
            prenom: $obj->nomcomplet,
            numero_telephone: $obj->numero_telephone,
            limite_credit: $obj->limite_credit
        );
    }
}