<?php 
require_once "Client.php";
require_once "Utilisateur.php";
require_once "ModePaiement.php";

class Commande {
    private int $id;
    private DateTime $date_commande;
    private float $montant_total;
    private float $montant_avance;

    private Client $client;
    private Utilisateur $utilisateur;
    private ModePaiement $modeDePaiement;
}

// CREATE TABLE commandes (
//     id SERIAL PRIMARY KEY,
//     date_commande DATE NOT NULL DEFAULT CURRENT_DATE,
//     montant_total NUMERIC(12,2) NOT NULL DEFAULT 0,
//     montant_avance NUMERIC(12,2) NOT NULL DEFAULT 0,

//     client_id INT NOT NULL,
//     utilisateur_id INT NOT NULL,
//     mode_paiement_id INT NOT NULL,

//     FOREIGN KEY (client_id) REFERENCES clients(id),
//     FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id),
//     FOREIGN KEY (mode_paiement_id) REFERENCES modes_paiement(id),
//     CHECK (montant_total >= 0),
//     CHECK (montant_avance >= 0),
//     CHECK (montant_avance <= montant_total)
// );