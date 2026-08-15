<?php

require_once "Fournisseur.php";
require_once "StatutAppro.php";
require_once "Utilisateur.php";

class Approvisionnement {
    private int $id;
    private string $reference_bon;
    private DateTime $date_approvisionnement;

    private Fournisseur $fournisseur;
    private StatutAppro $statutAppro;
    private Utilisateur $utilisateur;
}

// CREATE TABLE approvisionnements (
//     id SERIAL PRIMARY KEY,
//     reference_bon VARCHAR(100) NOT NULL UNIQUE,
//     date_approvisionnement DATE NOT NULL DEFAULT CURRENT_DATE,
//     fournisseur_id INT NOT NULL,
//     statut_appro_id INT NOT NULL,
//     utilisateur_id INT NOT NULL,

//     FOREIGN KEY (fournisseur_id)
//         REFERENCES fournisseurs(id),

//     FOREIGN KEY (statut_appro_id)
//         REFERENCES statuts_appro(id),

//     FOREIGN KEY (utilisateur_id)
//         REFERENCES utilisateurs(id)
// );


