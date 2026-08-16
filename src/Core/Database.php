<?php

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
//         $statement = $this->connection->prepare($sql);
//         $statement->execute($datas);
//         if ($class !== null)
//             return $single ? ($statement->fetchObject($class) ?: []) : $statement->fetchAll(PDO::FETCH_CLASS, $class);
//         return $single ? ($statement->fetch() ?: []) : $statement->fetchAll();
//     }

//     public function executeUpdate(string $sql, array $datas): int {
//         $statement = $this->connection->prepare($sql);
//         $statement->execute($datas);
//         return $statement->rowCount();
//     }

// }


namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static ?Database $instance = null;

    private PDO $connection;

    private function __construct() {
        try {
            $this->connection = new PDO('pgsql:host=localhost;port=5432;dbname=ohdc_hackaton', 'postgres', '12345');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->connection = new PDO('sqlite:' . __DIR__ . '/../../erp.db');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec('PRAGMA foreign_keys = ON');
        }
    }

    public static function getInstance(): Database {
        if (self::$instance === null)
            self::$instance = new Database();
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }

    public function query(string $sql, bool $single = true) {
        $query = $this->connection->query($sql);
        return $single ? ($query->fetch() ?: []) : $query->fetchAll();
    }

    public function executeQuery(string $sql, array $datas, bool $single = true) {
        $statement = $this->connection->prepare($sql);
        $statement->execute($datas);
        return $single ? ($statement->fetch() ?: []) : $statement->fetchAll();
    }

    public function executeUpdate(string $sql, array $datas): int {
        $statement = $this->connection->prepare($sql);
        $statement->execute($datas);
        return $statement->rowCount();
    }
}