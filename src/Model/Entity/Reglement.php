<?php
require_once "Dette.php";
require_once "ModePaiement.php";

class Reglement {
    private int $id;
    private DateTime $date_reglement;
    private float $montant_verse;

    private Dette $dette;
    private ModePaiement $modePaiement;
}

// CREATE TABLE reglements (
//     id SERIAL PRIMARY KEY,
//     date_reglement DATE NOT NULL DEFAULT CURRENT_DATE,
//     montant_verse NUMERIC(12,2) NOT NULL,
//     dette_id INT NOT NULL,
//     mode_paiement_id INT NOT NULL,

//     FOREIGN KEY (dette_id)
//         REFERENCES dettes(id)
//         ON DELETE CASCADE,

//     FOREIGN KEY (mode_paiement_id)
//         REFERENCES modes_paiement(id),

//     CHECK (montant_verse > 0)
// );