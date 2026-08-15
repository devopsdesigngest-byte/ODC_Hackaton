<?php
class Fournisseur {
    private int $id;
    private string $nom;
    private string $email;
    private string $numero_telephone;
    private string $adresse;


}
// CREATE TABLE fournisseurs (
//     id SERIAL PRIMARY KEY,
//     nom VARCHAR(150) NOT NULL,
//     email VARCHAR(150) UNIQUE,
//     numero_telephone VARCHAR(30),
//     adresse VARCHAR(255)
// );