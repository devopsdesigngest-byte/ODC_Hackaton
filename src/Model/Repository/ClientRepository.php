<?php

use App\Core\Database;

require_once dirname(__DIR__) . "/../Core/Database.php";
require_once dirname(__DIR__) . "/Entity/Client.php";

class ClientRepository {

    public function getAllClient(): array {
        $sql = "SELECT * FROM clients";
        $lignes = Database::query($sql, false);

        $clients = [];

        foreach ($lignes as $ligne) {
            $clients[] = new Client($ligne['id'], $ligne['nom'], $ligne['prenom'], $ligne['email'], $ligne['numero_telephone'], $ligne['limite_credit']);
        }

        return $clients; 
    }

    public function saveClient(string $nom, string $prenom, string $email, string $numero_telephone, float $limite_credit): int {
        $sql = "INSERT INTO clients(nom, prenom, email, numero_telephone, limite_credit)
            VALUES (:nom, :prenom, :email, :numero_telephone, :limite_credit)";

        return Database::executeUpdate($sql, [
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':numero_telephone' => $numero_telephone,
            ':limite_credit' => $limite_credit
        ]);
    }

    public function getNombreClient(): int {
        $sql = "SELECT COUNT(*) AS nombre FROM clients";
        $ligne = Database::query($sql);

        return (int) $ligne['nombre'];
    }
}







// use App\Core\Database;

// require_once dirname(__DIR__) . "/../Core/Database.php";
// require_once dirname(__DIR__) . "/Entity/Client.php";

// class ClientRepository {
//     private Database $database;

//     public function __construct(){
//         $this->database = Database::getInstance();
//     }

//     function getAllClient() : array {
//         $sql = "SELECT * FROM clients";
//         $lignes = $this->database->query($sql, false);
//         $clients = [];
//         foreach ($lignes as $ligne) {
//             $clients[] = new Client($ligne['id'], $ligne['nom'], $ligne['prenom'], $ligne['email'], $ligne['numero_telephone'], $ligne['limite_credit']);
//         }
//         return $clients; 
//     }  
           
//     public function saveClient(string $nom, string $prenom, string $email, string $numero_telephone, float $limite_credit): int {
//         $sql = "INSERT INTO clients(nom, prenom, email, numero_telephone, limite_credit)
//             VALUES (:nom, :prenom, :email, :numero_telephone, :limite_credit)";
//         return $this->database->executeUpdate($sql, [':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':numero_telephone' => $numero_telephone, ':limite_credit' => $limite_credit]);
//     }  
    
//     public function getNombreClient(): int {
//         $sql = "SELECT COUNT(*) AS nombre FROM clients";
//         $ligne = $this->database->query($sql);
//         return (int) $ligne['nombre'];
//     }
    

// }