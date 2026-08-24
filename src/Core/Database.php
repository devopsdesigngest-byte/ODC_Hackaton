<?php
// // ============================================================
// // BASE DE DONNEE OBJET fetchOjt
// // ============================================================

// namespace App\Core;

// use PDO;
// use PDOStatement;
// use PDOException;

// class Database
// {

//     private function __construct()
//     {
//     }

//     private static function getInstance(): PDO|null
//     {
//         try {
//             $instance = null;
//             $dsn = "pgsql:host=localhost;dbname=hackaton";
//             $instance = new PDO($dsn, "postgres", "12345");
//             $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             return $instance;
//         } catch (PDOException $e) {
//             die("Erreur PostgreSQL : " . $e->getMessage());
//             return null;
//         }
//     }

//     public static function query(string $sql, bool $single = true): mixed
//     {
//         $query = self::getInstance()->query($sql);
//         return $single ? $query->fetch(PDO::FETCH_OBJ) : $query->fetchAll(PDO::FETCH_OBJ);
//     }

//     private static function prepare(string $sql, array $datas): PDOStatement
//     {
//         $prepare = Database::getInstance()->prepare($sql);
//         $prepare->execute($datas);
//         return $prepare;
//     }

//     public static function executeQuery(string $sql, array $datas, bool $single = true): mixed
//     {
//         $statement = self::prepare($sql, $datas);
//         return $single ? $statement->fetch(PDO::FETCH_OBJ) : $statement->fetchAll(PDO::FETCH_OBJ);
//     }

//     public static function executeUpdate(string $sql, array $datas): int|string
//     {
//         $statement = self::prepare($sql, $datas);
//         return (str_starts_with(strtoupper(trim($sql)), 'INSERT')) ? self::getInstance()->lastInsertId() : $statement->rowCount();
//     }

//     public static function getAllData(string $tableName): array
//     {
//         $sql = "SELECT * FROM $tableName";
//         return self::query($sql, false);
//     }
// }



namespace App\Core;

use PDO;
use PDOStatement;
use PDOException;

class Database
{
    private function __construct()
    {
    }

    private static function getInstance(): PDO|null
    {
        try {
            $instance = null;

            $dsn = "pgsql:host=localhost;dbname=hackaton";

            $instance = new PDO($dsn, "postgres", "12345");

            $instance->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $instance;

        } catch (PDOException $e) {
            die("Erreur PostgreSQL : " . $e->getMessage());
        }
    }

    public static function query(
        string $sql,
        bool $single = true
    ): mixed {

        $query = self::getInstance()->query($sql);

        return $single
            ? $query->fetch(PDO::FETCH_OBJ)
            : $query->fetchAll(PDO::FETCH_OBJ);
    }

    private static function prepare(
        string $sql,
        array $datas
    ): PDOStatement {

        $prepare = self::getInstance()->prepare($sql);

        $prepare->execute($datas);

        return $prepare;
    }

    public static function executeQuery(
        string $sql,
        array $datas,
        bool $single = true
    ): mixed {

        $statement = self::prepare($sql, $datas);

        return $single
            ? $statement->fetch(PDO::FETCH_OBJ)
            : $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function executeUpdate(
        string $sql,
        array $datas,
        ?string $sequence = null
    ): int|string {

        $statement = self::prepare($sql, $datas);

        if (str_starts_with(strtoupper(trim($sql)), 'INSERT')) {

            if ($sequence !== null) {
                return self::getInstance()->lastInsertId($sequence);
            }

            return $statement->rowCount();
        }

        return $statement->rowCount();
    }

    public static function getAllData(string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";

        return self::query($sql, false);
    }
}