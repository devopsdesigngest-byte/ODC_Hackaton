<?php
class Client {
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $numero_telephone;
    private float $limite_credit;


    public function getNom(): string {
        return $this->nom;
    }
    public function getPrenom(): string {
        return $this->prenom;
    }


}

// CREATE TABLE clients (
//     id SERIAL PRIMARY KEY,
//     nom VARCHAR(100) NOT NULL,
//     prenom VARCHAR(100) NOT NULL,
//     email VARCHAR(150) UNIQUE,
//     numero_telephone VARCHAR(30),
//     limite_credit NUMERIC(12,2) NOT NULL DEFAULT 0,
//     CHECK (limite_credit >= 0)
// ); 