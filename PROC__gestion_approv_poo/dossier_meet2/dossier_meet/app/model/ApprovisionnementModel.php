<?php

use LDAP\Result;

require_once dirname(__DIR__) . '/core/Database.php';

function saveApprovisionnement(array $data): bool {
    $db = connexionDB();
    try {
        
        $db->beginTransaction();
        $sql = "INSERT INTO appros(refbl ,dateappro, fournisseur_id, statut_id)
                VALUES(:refbl, NOW(), :fournisseur_id,1);";

        $idAppro = executeUpdate($db,$sql,$data['appro']);

        if($idAppro == 0)
            {
                 throw new Exception('Erreur lors de l\'ajout');
            }
        foreach( $data["ligne_appro"] as $lignApp)
            {
                   $sqlLigne = "INSERT INTO ligneappro
                    (prixachatreel, qteappro, qterecue, article_id, appro_id)
                    VALUES
                    (:prix_achat_reel, :quantite_appro, :quantite_recu, :article_id, :approvisionnement_id),";
                    $lignAp['approvisionnement_id'] = $idAppro;


                     $result = executeUpdate($db,$sqlLigne,$lignApp);

                     if($result == 0){
                        throw new Exception('Erreur lors de l\'ajout');
                     }

            }
     
        $db->commit();
        return true;


    } catch (Exception $e) {
        // die($e->getMessage());
        if ($db->inTransaction()) {
            $db->rollBack();
        }
        
        return false;
    }
}