<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static ?Database $monInstance = null;
    private PDO $connection;

    private function __construct() {
        try {
            $this->connection = new PDO('pgsql:host=localhost; port=5432; dbname=odc_hackaton', 'postgres', '12345');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e) {
            $this->connection = new PDO('sqlite:' . __DIR__ . '/../../erp.db');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec('PRAGMA foreign_keys = ON');
        }
    }

    public static function getInstance() : Database {
        if(self::$monInstance == null)
            self::$monInstance = new Database();
        return self::$monInstance;
    }

    public function getConnection() : PDO {
        return $this->connection;
    }

    public function query(string $sql, bool $single = true) {
        $query = $this->connection->query($sql);
        return $single ? ($query->fetch(PDO::FETCH_ASSOC) ?: []) : $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function executeQuery(string $sql, array $datas, $single = true){
        $prepare = $this->connection->prepare($sql);
        $prepare->execute($datas);
        return $single ? ($prepare->fetch() ?: []) : $prepare->fetchAll();
    }

    public function executeUpdate(string $sql, array $datas) : int {
        $prepare = $this->connection->prepare($sql);
        $prepare->execute($datas);
        return $prepare->rowCount();
    }
    
}
// use App\Core\Database;

// require_once dirname(__DIR__) . "/../Core/Database.php";
// require_once dirname(__DIR__) . "/Entity/Client.php";

// class ClientRepository {
//     private Database $database;
    
//     public function __construct() {
//         $this->database = Database::getInstance();
//     }

//     public function saveClient(string $nom, string $prenom, string $email, string $numero_telephone, int $limite_credit): int {
//         $sql = "INSERT INTO clients(nom, prenom, email, numero_telephone, limite_credit)
//                 VALUES (:nom, :prenom, :email, :numero_telephone, :limite_credit)";
//         return $this->database->executeUpdate($sql, [':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':numero_telephone' => $numero_telephone, ':limite_credit' => $limite_credit]);
//     }

//     public function getAllClient(): array {
//         $sql = "SELECT * FROM clients";
//         $lignes = $this->database->query($sql, false);
//         $clients = [];
//         foreach ($lignes as $ligne) {
//             $clients[] = new Client(
//                 $ligne['id'],
//                 $ligne['nom'],
//                 $ligne['prenom'],
//                 $ligne['email'],
//                 $ligne['numero_telephone'],
//                 $ligne['limite_credit']
//             );
//         }
//         return $clients;
//     }

//     public function getNombreClient(): int {
//         $sql = "SELECT COUNT(*) AS nombre FROM clients";
//         $ligne = $this->database->query($sql);
//         return (int) $ligne['nombre'];
//     }
// }










// namespace App\Core;

// use PDO;
// use PDOException;

// class Database {
//     private static ?Database $instance = null;

//     private PDO $connection;

//     private function __construct() {
//         try {
//             $this->connection = new PDO('pgsql:host=localhost;port=5432;dbname=ohdc_hackaton', 'postgres', '12345');
//             $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         } catch (PDOException $e) {
//             $this->connection = new PDO('sqlite:' . __DIR__ . '/../../erp.db');
//             $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             $this->connection->exec('PRAGMA foreign_keys = ON');
//         }
//     }

//     public static function getInstance(): Database {
//         if (self::$instance === null) 
//             self::$instance = new Database();
//         return self::$instance;
//     }

//     public function getConnection(): PDO {
//         return $this->connection;
//     }

//     public function query(string $sql, bool $single = true, ?string $class = null) {
//         $query = $this->connection->query($sql);
//         if ($class !== null)
//             return $single ? ($query->fetchObject($class) ?: []) : $query->fetchAll(PDO::FETCH_CLASS, $class);
//         return $single ? ($query->fetch() ?: []) : $query->fetchAll();
//     }

//     public function executeQuery(string $sql, array $datas, bool $single = true, ?string $class = null) {
//         $prepare = $this->connection->prepare($sql);
//         $prepare->execute($datas);
//         if ($class !== null)
//             return $single ? ($prepare->fetchObject($class) ?: []) : $prepare->fetchAll(PDO::FETCH_CLASS, $class);
//         return $single ? ($prepare->fetch() ?: []) : $prepare->fetchAll();
//     }

//     public function executeUpdate(string $sql, array $datas): int {
//         $prepare = $this->connection->prepare($sql);
//         $prepare->execute($datas);
//         return $prepare->rowCount();
//     }

// }



// use App\Core\Database;
// require_once dirname(__DIR__). "/../Core/Database.php";
// require_once dirname(__DIR__). "/Entity/Produit.php";

// class ProduitRepository {
//     private Database $database;

//     public function __construct() {
//         $this->database = Database::getInstance();
//     }

//     public function saveProduit(string $libelle, float $prixVente, int $stockInitial): int {
//         $sql = "INSERT INTO produits(libelle, prix_vente, stock_initial)
//                 VALUES (:libelle, :prix_vente, :stock_initial)";

//         return $this->database->executeUpdate($sql, [
//             ':libelle' => $libelle,
//             ':prix_vente' => $prixVente,
//             ':stock_initial' => $stockInitial
//         ]);
//     }

//     public function getAllProduit(): array {
//         $sql = "SELECT * FROM produits";
//         return $this->database->query($sql, false, Produit::class);
//     }

//     public function getValeurStock(): float {
//         $sql = "SELECT SUM(prix_vente * stock_initial) AS valeur FROM produits";
//         $result = $this->database->query($sql);
//         return (float) $result['valeur'];
//     }

//     public function seuilProduit(): int {
//         $sql = "SELECT COUNT(*) AS nombre FROM produits WHERE stock_initial <= 5";
//         $result = $this->database->query($sql);
//         return (int) $result['nombre'];
//     }

// }
