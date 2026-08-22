<?php

function connexionDB():PDO{

try {
    $pdo = new PDO(
        "pgsql:host=localhost;dbname=gestiondette;port=5432",
        "postgres",
        "1234"
    );

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch ( Exception $ex) {
    die('Erreur:'.$ex->getMessage());
}
    



}

function query(PDO $pdo,string $sql, bool $single = true):array{
     $query = $pdo->query($sql);
    return $single ? $query->fetch():$query->fetchAll();
    

}