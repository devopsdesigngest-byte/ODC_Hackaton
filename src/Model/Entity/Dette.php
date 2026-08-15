<?php 
require_once "Commande.php";

class Dette {
    private int $id;
    private float $montant_initial;
    private float $montant_restant;
    private DateTime $date_creation;
    private DateTime $date_echeance;
    private string $statut;

    private Commande $commande;
}

// CREATE TABLE dettes (
//     id SERIAL PRIMARY KEY,
//     montant_initial NUMERIC(12,2) NOT NULL,
//     montant_restant NUMERIC(12,2) NOT NULL,
//     date_creation DATE NOT NULL DEFAULT CURRENT_DATE,
//     date_echeance DATE,
//     statut VARCHAR(30) NOT NULL,
//     commande_id INT NOT NULL UNIQUE,

//     FOREIGN KEY (commande_id)
//         REFERENCES commandes(id)
//         ON DELETE CASCADE,

//     CHECK (montant_initial >= 0),
//     CHECK (montant_restant >= 0),
//     CHECK (montant_restant <= montant_initial)
// );