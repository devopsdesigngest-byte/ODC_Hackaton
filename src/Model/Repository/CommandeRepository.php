<?php

use App\Core\Database;

require_once dirname(__DIR__) . "/../Core/Database.php";
require_once dirname(__DIR__) . "/Entity/Commande.php";
require_once dirname(__DIR__) . "/Entity/LigneCommande.php";
require_once dirname(__DIR__) . "/Entity/Dette.php";

class CommandeRepository {

    public static function saveCommande(float $montantTotal, float $montantAvance, int $clientId, int $utilisateurId, int $modePaiementId) : int {
        $sql = "INSERT INTO commandes (montant_total, montant_avance, client_id, utilisateur_id, mode_paiement_id)
        VALUES (:montant_total, :montant_avance, :client_id, :utilisateur_id, :mode_paiement_id)";
        Database::executeUpdate($sql, [':montant_total' => $montantTotal, ':montant_avance' => $montantAvance, ':client_id' => $clientId, ':utilisateur_id' => $utilisateurId, ':mode_paiement_id' => $modePaiementId]);
        return (int) Database::getConnection()->lastInsertId();
    }

    public static function saveLigneCommande(int $quantite, float $prixUnitaire, float $sousTotal, int $commandeId, int $produitId) : int {
        $sql = "INSERT INTO lignes_commande (quantite, prix_unitaire, sous_total, commande_id, produit_id)
        VALUES (:quantite, :prix_unitaire, :sous_total, :commande_id, :produit_id)";
        return Database::executeUpdate($sql, [':quantite' => $quantite, ':prix_unitaire' => $prixUnitaire, ':sous_total' => $sousTotal, ':commande_id' => $commandeId, ':produit_id' => $produitId]);
    }

    public static function saveDette(float $montantInitial, float $montantRestant, ?string $dateEcheance, string $statut, int $commandeId) : int {
        $sql = "INSERT INTO dettes(montant_initial, montant_restant, date_echeance, statut, commande_id)
        VALUES(:montant_initial, :montant_restant, :date_echeance, :statut, :commande_id)";
        return Database::executeUpdate($sql, [':montant_initial' => $montantInitial, ':montant_restant' => $montantRestant, ':date_echeance' => $dateEcheance, ':statut' => $statut, ':commande_id' => $commandeId]);
    }
}

// use App\Core\Database;

// require_once dirname(__DIR__) . "/../Core/Database.php";
// require_once dirname(__DIR__) . "/Entity/Commande.php";
// require_once dirname(__DIR__) . "/Entity/LigneCommande.php";
// require_once dirname(__DIR__) . "/Entity/Dette.php";

// class CommandeRepository {

//     private Database $database;

//     public function __construct() {
//         $this->database = Database::getInstance();
//     }

//     public function saveCommande(float $montantTotal, float $montantAvance, int $clientId, int $utilisateurId, int $modePaiementId) : int {
//         $sql = "INSERT INTO commandes (montant_total, montant_avance, client_id, utilisateur_id, mode_paiement_id)
//         VALUES (:montant_total, :montant_avance, :client_id, :utilisateur_id, :mode_paiement_id)";
//         $this->database->executeUpdate($sql, [':montant_total' => $montantTotal, ':montant_avance' => $montantAvance, ':client_id' => $clientId, ':utilisateur_id' => $utilisateurId, ':mode_paiement_id' => $modePaiementId]);
//         return (int) $this->database->getConnection()->lastInsertId();
//     }

//     public function saveLigneCommande(int $quantite, float $prixUnitaire, float $sousTotal, int $commandeId, int $produitId) : int {
//         $sql = "INSERT INTO lignes_commande (quantite, prix_unitaire, sous_total, commande_id, produit_id)
//         VALUES (:quantite, :prix_unitaire, :sous_total, :commande_id, :produit_id)";
//         return $this->database->executeUpdate($sql, [':quantite' => $quantite, ':prix_unitaire' => $prixUnitaire, ':sous_total' => $sousTotal, ':commande_id' => $commandeId, ':produit_id' => $produitId]);
//     }

//     public function saveDette(float $montantInitial, float $montantRestant, ?string $dateEcheance, string $statut, int $commandeId) : int {
//         $sql = "INSERT INTO dettes(montant_initial, montant_restant, date_echeance, statut, commande_id)
//         VALUES(:montant_initial, :montant_restant, :date_echeance, :statut, :commande_id)";
//         return $this->database->executeUpdate($sql, [':montant_initial' => $montantInitial, ':montant_restant' => $montantRestant, ':date_echeance' => $dateEcheance, ':statut' => $statut, ':commande_id' => $commandeId]);
//     }
// }