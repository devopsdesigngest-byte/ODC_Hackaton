<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static ?Database $instance = null;

    private PDO $connection;

    private function __construct()     {
        try {
            $this->connection = new PDO(
                'pgsql:host=localhost;port=5432;dbname=ohdc_hackaton', 'postgres', '12345');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->connection = new PDO(
                'sqlite:' . __DIR__ . '/../../erp.db'
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec(
                'PRAGMA foreign_keys = ON'
            );
        }
    }
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
}