<?php

require_once "Fournisseur.php";
require_once "StatutAppro.php";
require_once "Utilisateur.php";

class Approvisionnement {
    private int $id;
    private string $reference_bon;
    private DateTime $date_approvisionnement;

    private Fournisseur $fournisseur;
    private StatutAppro $statutAppro;
    private Utilisateur $utilisateur;

    public function __construct(int $id, string $reference_bon, DateTime $date_approvisionnement, Fournisseur $fournisseur, StatutAppro $statutAppro, Utilisateur $utilisateur){
        $this->id = $id;
        $this->reference_bon = $reference_bon;
        $this->date_approvisionnement = $date_approvisionnement;
        $this->fournisseur = $fournisseur;
        $this->statutAppro = $statutAppro;
        $this->utilisateur = $utilisateur;
    }

    public function getId() : int {
        return $this->id;
    }
    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getReference_bon() : string {
        return $this->reference_bon;
    }
    public function setReference_bon(string $reference_bon) : void {
        $this->reference_bon = $reference_bon;
    }

    public function getDate_approvisionnement() : DateTime {
        return $this->date_approvisionnement;
    }
    public function setDate_approvisionnement(DateTime $date_approvisionnement) : void {
        $this->date_approvisionnement = $date_approvisionnement;
    }

    public function getFournisseur() : Fournisseur {
        return $this->fournisseur;
    }
    public function setFournisseur(Fournisseur $fournisseur) : void {
        $this->fournisseur = $fournisseur;
    }

    public function getStatutAppro() : StatutAppro {
        return $this->statutAppro;
    }
    public function setStatutAppro(StatutAppro $statutAppro) : void {
        $this->statutAppro = $statutAppro;
    }

    public function getUtilisateur() : Utilisateur {
        return $this->utilisateur;
    }
    public function setUtilisateur(Utilisateur $utilisateur) : void {
        $this->utilisateur = $utilisateur;
    }
}