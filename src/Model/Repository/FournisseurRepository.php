<?php

use App\Core\Database;

require_once dirname(__DIR__) . "/../Core/Database.php";
require_once dirname(__DIR__) . "/Entity/Fournisseur.php";

class FournisseurRepository {
    
    private Database $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    public function saveFournisseur(string $nom, string $email, string $numero_telephone, string $adresse): int {
        $sql = "INSERT INTO fournisseurs(nom, email, numero_telephone, adresse)
                VALUES (:nom, :email, :numero_telephone, :adresse)";
        return $this->database->executeUpdate($sql, [':nom' => $nom, ':email' => $email, ':numero_telephone' => $numero_telephone, ':adresse' => $adresse]);
    }

    public function getAllFournisseur(): array {
        $sql = "SELECT * FROM fournisseurs";
        $lignes = $this->database->query($sql, false);
        $fournisseurs = [];
        foreach ($lignes as $ligne) {
            $fournisseurs[] = new Fournisseur(
                $ligne['id'],
                $ligne['nom'],
                $ligne['email'],
                $ligne['numero_telephone'],
                $ligne['adresse']
            );
        }
        return $fournisseurs;
    }
}