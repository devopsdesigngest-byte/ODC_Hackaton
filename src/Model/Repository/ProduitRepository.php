<?php
use App\Core\Database;

require_once dirname(__DIR__). "/../Core/Database.php";
require_once dirname(__DIR__). "/Entity/Produit.php";

class ProduitRepository {
    private Database $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    public function saveProduit(string $libelle, float $prixVente, int $stockInitial) : int {
        $sql = "INSERT INTO produits(libelle, prix_vente, stock_initial)
                VALUES (:libelle, :prix_vente, :stock_initial)";
        return $this->database->executeUpdate($sql, [':libelle' => $libelle, ':prix_vente' => $prixVente, ':stock_initial' => $stockInitial]);
    }

    public function getAllProduit(): array {
        $sql = "SELECT * FROM produits";
        $lignes = $this->database->query($sql, false);
        $produits = [];
        foreach ($lignes as $ligne) {
            $produits[] = new Produit(
                $ligne['id'],
                $ligne['libelle'],
                $ligne['prix_vente'],
                $ligne['stock_initial']
            );
        }
        return $produits;
    }

    public function getValeurStock() : float {
        $sql = "SELECT SUM(prix_vente * stock_initial) AS valeur FROM produits";
        $result = $this->database->query($sql);
        return (float) $result['valeur'];
    }

    public function seuilProduit() : int {
        $sql = "SELECT COUNT(*) AS nombre FROM produits WHERE stock_initial <= 5";
        $result = $this->database->query($sql);
        return (int) $result['nombre'];
    }
}