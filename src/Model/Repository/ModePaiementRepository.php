<?php 

use App\Core\Database;

require_once dirname(__DIR__) . "/../Core/Database.php";
require_once dirname(__DIR__) . "/Entity/ModePaiement.php";

class ModePaiementRepository {

    public static function getAllModePaiement(): array {
        $sql = "SELECT * FROM modes_paiement";
        $lignes = Database::query($sql, false);

        $modePaiement = [];
        
        foreach($lignes as $ligne){
            $modePaiement[] = new ModePaiement($ligne['id'], $ligne['libelle']);
        }

        return $modePaiement;
    }
    
}


// use App\Core\Database;

// require_once dirname(__DIR__) . "/../Core/Database.php";
// require_once dirname(__DIR__) . "/Entity/ModePaiement.php";

// class ModePaiementRepository {

//     private Database $database;

//     public function __construct() {
//         $this->database = Database::getInstance();
//     }

//     public function getAllModePaiement(): array {
//         $sql = "SELECT * FROM modes_paiement";
//         $lignes = $this->database->query($sql, false);

//         $modePaiement = [];
        
//         foreach($lignes as $ligne){
//             $modePaiement[] = new ModePaiement($ligne['id'], $ligne['libelle']);
//         }

//         return $modePaiement;
//     }
    
// }