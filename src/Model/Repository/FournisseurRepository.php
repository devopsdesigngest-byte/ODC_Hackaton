<?php

namespace App\Model\Repository;

use App\Core\Database as db;
use App\Core\Debug as DD;
use App\Model\Entity\Fournisseur as F;

class FournisseurRepository
{
    public static function getAllFournisseurs() : array {
        $sql = "SELECT f.nom, f.numero_telephone, f.adresse From fournisseurs f ORDER BY f.id DESC;";
        $datas = db::query($sql, false);

        $resultats = array_map(function($data){
            return F::toEntity($data);
        }, $datas);      
        return $resultats;
    } 


    public static function saveFournisseur(array $fournisseur) : int {
        $sql = "INSERT INTO fournisseurs(nom, email, numero_telephone, adresse)
        VALUES(:nom, :email, :numero_telephone, :adresse)";
        $fournisseur = [
            ':nom' => $fournisseur['nom'], 
            ':email' => $fournisseur['email'], 
            ':numero_telephone' => $fournisseur['numero_telephone'], 
            ':adresse' => $fournisseur['adresse']
        ];
        db::executeUpdate($sql, $fournisseur);
          
        return (int) 0;
    } 
}