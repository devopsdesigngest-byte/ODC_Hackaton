<?php

// function getArticleRupture() : array {
//     $pdo = connexionDB();
//     $sql ="SELECT a.libelle, a.qteStock,
//             case when a.qteStock = 0 THEN 'Rupture total: '||' '|| a.qteStock || ' '  ||' en stock'
//             ELSE 'Alerte: '||' ' || a.qteStock ||' '||'en stock' 
//             END AS statut
//             FROM articles a WHERE a.qteStock <= a.qteSeuil";
//     $datas = query($pdo, $sql, false);
//     $pdo = null;
//     return $datas;
// }


// function getAllArticles() : array {
//     $pdo = connexionDB();
//     $sql ="SELECT ar.libelle, ar.id, la.prixAchatReel 
//         FROM articles ar 
//         INNER JOIN ligneAppros la 
//         ON ar.id = la.article_id";
//     $datas = query($pdo, $sql, false);
//     $pdo = null;
//     return $datas;
// }