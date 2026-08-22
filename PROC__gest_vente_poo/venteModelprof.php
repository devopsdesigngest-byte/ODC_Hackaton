<?php

require_once dirname(__DIR__)."/database.php";

function getAllCommande(){
    $connexion=connexionDB();
    $sql="SELECT 
   v.id, concat('#CMD-',v.id) AS ref,TO_CHAR(v.dateVente,'DD-MM-YYYY') AS dateVente,cl.nom,cl.prenom,cl.telephone,m.nomMode,v.statut,v.montantTotal
FROM ventes v
RIGHT JOIN clients cl ON  v.client_id=cl.id
INNER JOIN paiementMode m ON  v.paiementMode_id=m.id

; "  ;

$commandes= query( $connexion, $sql,false);
$sql1="SELECT p.libelle,l.quantiteVente,l.prixVente,(l.quantiteVente*l.prixVente) AS sousTotal
FROM produits p 
INNER JOIN ligneVente l ON l.produit_id=p.id 
WHERE l.vente_id=:idVente
";
 foreach ($commandes as &$commande){

   $commande['lignes']=executeQuery( $connexion, $sql1,['idVente'=>$commande['id']],false);
  
 }
 


$connexion=null;
return $commandes;


}