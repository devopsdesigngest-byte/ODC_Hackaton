<?php
require_once "Role.php";

class Utilisateur {
    private int $id; 
    private string $nom_complet; 
    private string $email; 
    private string $mot_de_passe; 
    private string $adresse; 
    private string $numero_telephone; 

    private Role $role; 




    public function getNomComplet(): string {
        return $this->nom_complet;
    }

}


// CREATE TABLE utilisateurs (
//     id SERIAL PRIMARY KEY,
//     nom_complet VARCHAR(150) NOT NULL,
//     email VARCHAR(150) NOT NULL UNIQUE,
//     mot_de_passe VARCHAR(255) NOT NULL,
//     adresse VARCHAR(255),
//     numero_telephone VARCHAR(30),
//     role_id INT NOT NULL,
//     FOREIGN KEY (role_id) REFERENCES roles(id)
// );

