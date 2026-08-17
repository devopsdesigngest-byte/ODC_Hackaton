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
            $this->connection = new PDO('sqlite:' . __DIR__ . '/../../erp.db'); // (dir, 3) je pourrai lutiliser
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


//     public function getAllProduit(): array {
//         $sql = "SELECT * FROM produits";
//         return $this->database->query($sql, false, Produit::class);
//     }

