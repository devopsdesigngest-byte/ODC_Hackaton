<?php 

class ModePaiement {
    private int $id; 
    private string $libelle;  

    public function getLibelle(): string {
        return $this->libelle;
    }
}


// CREATE TABLE modes_paiement (
//     id SERIAL PRIMARY KEY,
//     libelle VARCHAR(50) NOT NULL UNIQUE
// );