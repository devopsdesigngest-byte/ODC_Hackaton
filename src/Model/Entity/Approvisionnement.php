<?php 

namespace App\Model\Entity;

class Approvisionnement {
    private int $id;
    private \DateTime $date_commande;
    private float $montant_total;
    private float $montant_avance;

    private Client $client;
    private Utilisateur $utilisateur;
    private ModePaiement $modeDePaiement;
    private array $lignesCommande = [];

    public function __construct(int $id, \DateTime $date_commande, float $montant_total, float $montant_avance, Client $client, Utilisateur $utilisateur, ModePaiement $modeDePaiement) {
        $this->id = $id;
        $this->date_commande = $date_commande;
        $this->montant_total = $montant_total;
        $this->montant_avance = $montant_avance;
        $this->client = $client;
        $this->utilisateur = $utilisateur;
        $this->modeDePaiement = $modeDePaiement;
        $this->lignesCommande = [];
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getDate_commande() : \DateTime {
        return $this->date_commande;
    }

    public function setDate_commande(\DateTime $date_commande) : void {
        $this->date_commande = $date_commande;
    }

    public function getMontant_total() : float {
        return $this->montant_total;
    }

    public function setMontant_total(float $montant_total) : void {
        $this->montant_total = $montant_total;
    }

    public function getMontant_avance() : float {
        return $this->montant_avance;
    }

    public function setMontant_avance(float $montant_avance) : void {
        $this->montant_avance = $montant_avance;
    }

    public function getClient() : Client {
        return $this->client;
    }

    public function setClient(Client $client) : void {
        $this->client = $client;
    }

    public function getUtilisateur() : Utilisateur {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur) : void {
        $this->utilisateur = $utilisateur;
    }

    public function getModePaiement() : ModePaiement {
        return $this->modeDePaiement;
    }

    public function setModePaiement(ModePaiement $modeDePaiement) : void {
        $this->modeDePaiement = $modeDePaiement;
    }

    public function getLignesCommande() : array {
        return $this->lignesCommande;
    }

    public function ajouterLigneCommande(LigneCommande $ligneCommande) : void {
        $this->lignesCommande[] = $ligneCommande;
    }
}