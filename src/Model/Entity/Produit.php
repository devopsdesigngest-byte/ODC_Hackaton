<?php 

class Produit {
    
    private int $id;
    private string $libelle;
    private float $prix_vente;
    private int $stock_initial;

    public function __construct(int $id, string $libelle, float $prix_vente, int $stock_initial) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->prix_vente = $prix_vente;
        $this->stock_initial = $stock_initial;
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getLibelle() : string {
        return $this->libelle;
    }

    public function setLibelle(string $libelle) : void {
        $this->libelle = $libelle;
    }

    public function getPrixVente() : float {
        return $this->prix_vente;
    }

    public function setPrixVente(float $prix_vente) : void {
        $this->prix_vente = $prix_vente;
    }

    public function getStockInitial() : int {
        return $this->stock_initial;
    }

    public function setStockInitial(int $stock_initial) : void {
        $this->stock_initial = $stock_initial;
    }
}

// class Produit {
//     private int $id;
//     private string $libelle;
//     private float $prix_vente;
//     private int $stock_initial;

//     public function getPrixVente(): float {
//         return $this->prix_vente;
//     }

// }

// // CREATE TABLE produits (
// //     id SERIAL PRIMARY KEY,
// //     libelle VARCHAR(150) NOT NULL,
// //     prix_vente NUMERIC(12,2) NOT NULL,
// //     stock_initial INT NOT NULL DEFAULT 0,
// //     CHECK (prix_vente >= 0),
// //     CHECK (stock_initial >= 0)
// // );