<?php

function saveDette(array $data):int{
   
    $pdo = connexionDB();

    $sql = "INSERT INTO dettes(client_id, montant_initial, montant_restant, ref,date_echeance)
    VALUES(:client_id, :montant_initial, :montant_restant, :ref, :date_echeance)";

    // $nbrLigneAffecte = executeUpdate($pdo, $sql, [
    //     'client_id'=> $data['client_id'],
    //     'montantInit'=> $data['montantInit'],
    //     'montantRestante'=> $data['montantRestante'],
    //     'ref'=> $data['ref'],
    //     'datEcheance'=> $data['datEcheance']
    //     ]);
    $nbrLigneAffecte = executeUpdate($pdo, $sql, $data); 
    return $nbrLigneAffecte;
}

function updateDette(int $idDette, float $montantVerse):int{
return 0;
}

function getAllDettes():array{
$pdo = connexionDB();
$sql = "
    SELECT d.ref,c.nom,c.prenom ,to_char(d.dateEmprunt,'DD-MM-YYYY') AS dateEmprunt,to_char(d.date_echeance,'DD-MM-YYYY') AS dateEcheance,
    COALESCE(SUM(d.montant_initial),0) AS montantEmprunt, 
    COALESCE(SUM(d.montant_restant),0) AS montantRestant ,
    CASE 
    WHEN d.montant_restant = 0 THEN 'REGLEE'
    ELSE 'PARTIEL'
    END AS statut
    FROM dettes d 
    INNER JOIN clients c  ON c.id = d.client_id
    GROUP BY  d.ref,c.nom,c.prenom,d.dateEmprunt,d.date_echeance ,d.montant_restant";
    $data = query($pdo,$sql,false);
$pdo = null;

return   $data ;
}

function getStatisques():array{
    $pdo = connexionDB();
    $sql = "SELECT COALESCE(SUM(montant_initial- montant_restant),0) AS totalRembourse,
    COALESCE(SUM( montant_restant),0) AS totalRestant,
    COUNT(id) AS nbreDettes,
    ROUND(SUM(montant_initial- montant_restant)/ NULLIF(SUM (montant_initial),0)* 100
    ) AS tauxRemboursement
    FROM dettes ";


     $stat = query($pdo,$sql);


    $sql= "SELECT SUM(montant_restant) AS totalRetard
    FROM dettes 
    WHERE date_echeance < CURRENT_DATE;";
     $stat1 = query($pdo,$sql);
    // var_dump($stat1);
    // die;

    $stat['totalretard']=$stat1['totalretard'];

    $pdo = null;


    return $stat;
}

function getDettesRestants():array{

    $pdo = connexionDB();

    $sql = "SELECT d.ref, c.nom, c.prenom, SUM(d.montant_restant) AS montantRestant
            FROM clients c INNER JOIN dettes d 
            ON c.id = d.client_id 
            WHERE d.montant_restant <> 0
            GROUP BY d.ref, c.nom, c.prenom";

    $datas = query($pdo, $sql, false);

    $pdo = null;

    return $datas;
}