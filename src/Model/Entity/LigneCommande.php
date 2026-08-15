<?php 

require_once "Commande.php";
require_once "Produit.php";

class LigneCommande {
    private int $id;
    private int $quantite;
    private float $prix_unitaire;
    private float $sous_total;

    private Commande $commande;
    private Produit $produit;
}

// CREATE TABLE lignes_commande (
//     id SERIAL PRIMARY KEY,
//     quantite INT NOT NULL,
//     prix_unitaire NUMERIC(12,2) NOT NULL,
//     sous_total NUMERIC(12,2) NOT NULL,
//     commande_id INT NOT NULL,
//     produit_id INT NOT NULL,

//     FOREIGN KEY (commande_id)
//         REFERENCES commandes(id)
//         ON DELETE CASCADE,

//     FOREIGN KEY (produit_id)
//         REFERENCES produits(id),

//     CHECK (quantite > 0),
//     CHECK (prix_unitaire >= 0),
//     CHECK (sous_total >= 0)
// ); 