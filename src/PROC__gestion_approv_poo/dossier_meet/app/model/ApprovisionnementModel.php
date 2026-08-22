<?php
require_once dirname(__DIR__) . '/core/Database.php';

function saveApprovisionnement(): bool {
    try {
        $db = connexionDB();
        $db->beginTransaction();
        $sql = "INSERT INTO approvisionnement(ref_bordereau_livraison, date_approvisionnement, fournisseur_id, statut_id)
                VALUES(:ref_bordereau_livraison, NOW(), :fournisseur_id, :statut_id);";

        $sqlLigne = "INSERT INTO ligne_appro
                    (prix_achat_reel, quantite_appro, quantite_recu, article_id, approvisionnement_id)
                    VALUES
                    (:prix_achat_reel, :quantite_appro, :quantite_recu, :article_id, :approvisionnement_id),";

        
    } catch (Exception $e) {
        die($e->getMessage());
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        
        return false;
    }
}