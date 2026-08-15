<?php

class Role {
    private int $id; 
    private string $nom_role;  



    public function getNomRole(): string {
        return $this->nom_role;
    }
}

// CREATE TABLE roles (
//     id SERIAL PRIMARY KEY,
//     nom_role VARCHAR(50) NOT NULL UNIQUE
// );