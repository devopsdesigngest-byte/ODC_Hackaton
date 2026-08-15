<?php 
class Produit {
    private int $id;
    private string $libelle;
    private float $prix_vente;
    private int $stock_initial;

    public function getPrixVente(): float {
        return $this->prix_vente;
    }

}

// CREATE TABLE produits (
//     id SERIAL PRIMARY KEY,
//     libelle VARCHAR(150) NOT NULL,
//     prix_vente NUMERIC(12,2) NOT NULL,
//     stock_initial INT NOT NULL DEFAULT 0,
//     CHECK (prix_vente >= 0),
//     CHECK (stock_initial >= 0)
// );