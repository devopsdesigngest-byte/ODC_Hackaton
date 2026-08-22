<?php

function getAllConcordance() : array {
    $pdo = connexionDB();
    $sql ="SELECT
            a.refBL,
            f.nom,
            COALESCE(SUM(l.prixAchatReel * l.qteAppro), 0) AS valeurFacturee,
            COALESCE(SUM(l.prixAchatReel * l.qteRecue), 0) AS valeurReceptionnee,
            CASE
                WHEN SUM(l.prixAchatReel * l.qteAppro) =
                    SUM(l.prixAchatReel * l.qteRecue)
                    AND s.nom = 'RECEPTIONNÉE'
                THEN 'concorde'

                WHEN SUM(l.prixAchatReel * l.qteAppro) =
                    SUM(l.prixAchatReel * l.qteRecue)
                    AND s.nom = 'EN_ATTENTE'
                THEN 'en attente'

                ELSE 'ECART: ' ||
                    (SUM(l.prixAchatReel * l.qteRecue) -
                    SUM(l.prixAchatReel * l.qteAppro))
            END AS diagnostic
        FROM fournisseur f
        INNER JOIN approvisionnement a
            ON a.fournisseur_id = f.id
        INNER JOIN ligne_appro l
            ON l.approvisionnement_id = a.id
        INNER JOIN statut s
            ON a.statut_id = s.id
        GROUP BY a.refBL, f.nom, s.nom;";

    $datas = query($pdo, $sql, false);

    $pdo = null;

    return $datas;
}

// function getFournisseurAppro() : array {

//     $pdo = connexionDB();

//     $sql1 = "SELECT a.id, a.refBL, f.nom as fnom, TO_CHAR(a.dat, 'DD-MMmonth-YYYY') as dat,
//             coalesce(SUM(l.qteRecue * l.prixAchatReel), 0) AS somme, s.nom AS statut,
//             COUNT(a.id) AS cpt
//             FROM statuts s INNER JOIN  approvisionnements a ON s.id = a.statut_id 
//             INNER JOIN ligneAppros l ON l.approvisionnement_id = a.id   
//             INNER JOIN  fournisseurs f ON f.id = a.fournisseur_id
//             GROUP BY a.id, a.refBL, f.nom, s.nom,a.dat;";

//     $sql2 = "SELECT a.id, la.qteRecue, la.qteAppro, ar.libelle, la.prixAchatReel, 
//             la.qteRecue * la.prixAchatReel AS montant, 
//             TO_CHAR(a.dat, 'DD-MM-YYYY') AS dat
//             FROM ligneAppros la INNER JOIN articles ar ON la.article_id = ar.id   
//             INNER JOIN approvisionnements a ON la.approvisionnement_id = a.id 
//             WHERE a.id = :id
//             GROUP BY a.id, la.qteRecue, la.qteAppro, ar.libelle, la.prixAchatReel, a.dat";

//     $approvs = query($pdo, $sql1, false);



//     foreach($approvs as &$approv){
//         $approv['la'] = executeQuery($pdo, $sql2, ['id' => $approv['id']], false);        
//     }
        
//     $pdo = null;

//     return $approvs;
    
// }


// function encoursVersReceptionne(array $lignes, int $approvisionnementId) : int {
//     $pdo = connexionDB();

//     $pdo->beginTransaction();

//         $total = 0;

//         $sql = "
//             UPDATE ligneAppros
//             SET qteRecue = :qteRecue,
//                 prixAchatReel = :prixAchatReel
//             WHERE id = :id
//         ";

//         foreach ($lignes as $ligne) {

//             if ($ligne['qteRecue'] == $ligne['qteAppro']) 
//                 continue;
            
//             $total += executeUpdate($pdo, $sql, [
//                 'id' => $ligne['id'],
//                 'qteRecue' => $ligne['qteRecue'],
//                 'prixAchatReel' => $ligne['prixAchatReel']
//             ]);
//         }

//         $sql = "
//             UPDATE approvisionnements
//             SET statut_id = (
//                 SELECT id
//                 FROM statuts
//                 WHERE nom = 'Receptionnes'
//             )
//             WHERE id = :id
//         ";

//         $total += executeUpdate($pdo, $sql, ['id' => $approvisionnementId]);

//         $pdo->commit();

//         return $total;

// }














require_once dirname(__DIR__) . '/core/Database.php';
function saveApprovisionnement(int $fournisseurId, string $refBL, array $lignes): bool {
    try {
        $pdo = connexionDB();
        $pdo->beginTransaction();

        $sqlAppro = "INSERT INTO approvisionnement (refBL, date, fournisseur_id, statut_id) 
                     VALUES (:refbl, NOW(), :fournisseur_id, 1) ";
        $stmtAppro = prepare($pdo, $sqlAppro, [
            ':refbl' => $refBL,
            ':fournisseur_id' => $fournisseurId
        ]);

        $lastInsertIdAppro = $pdo->lastInsertId();

        $sqlLigne = "INSERT INTO ligne_appro (prixAchatReel, qteAppro, qteRecue, approvisionnement_id, article_id)
                     VALUES (:prix, :qte, 0, :appro_id, :article_id)";

        foreach ($lignes as $ligne) {
            $articleId = (int)($ligne['id_produit']);
            $qty = (int)($ligne['quantite']);
            $prix = (float)($ligne['prix']);


            prepare($pdo, $sqlLigne, [
                ':prix' => $prix,
                ':qte' => $qty,
                ':appro_id' => $lastInsertIdAppro,
                ':article_id' => $articleId
            ]);
        }

        $pdo->commit();
        return true;
    } catch (Exception $e) {
        die($e->getMessage());
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        
        return false;
    }
}
