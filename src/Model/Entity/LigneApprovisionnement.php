<?php

require_once "Approvisionnement.php";
require_once "Produit.php";

class LigneApprovisionnement {
    private int $id;
    private int $quantite_commandee;
    private int $quantite_recue;
    private float $prix_unitaire;

    private Approvisionnement $approvisionnement;
    private Produit $produit;
}

// CREATE TABLE lignes_approvisionnement (
//     id SERIAL PRIMARY KEY,
//     quantite_commandee INT NOT NULL,
//     quantite_recue INT NOT NULL DEFAULT 0,
//     prix_unitaire NUMERIC(12,2) NOT NULL,
//     approvisionnement_id INT NOT NULL,
//     produit_id INT NOT NULL,

//     FOREIGN KEY (approvisionnement_id)
//         REFERENCES approvisionnements(id)
//         ON DELETE CASCADE,

//     FOREIGN KEY (produit_id)
//         REFERENCES produits(id),

//     CHECK (quantite_commandee > 0),
//     CHECK (quantite_recue >= 0),
//     CHECK (quantite_recue <= quantite_commandee),
//     CHECK (prix_unitaire >= 0)
// );