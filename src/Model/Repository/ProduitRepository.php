<?php

namespace App\Model\Repository;

use App\Core\Database as db;
use App\Core\Debug as DD;
use App\Model\Entity\Produit as P;
use App\Model\DTO\ProduitDTO as PDTO;

class ProduitRepository
{
    public static function getAllProduits() : array {
        $sql = "SELECT p.libelle, p.prix_vente, p.stock_initial From produits p ORDER BY p.id DESC;";
        $datas = db::query($sql, false);

        $resultats = array_map(function($data){
            return P::toEntity($data);
        }, $datas);      
        return $resultats;
    } 

    public static function getNreProduits() : int {
        $sql = "SELECT COUNT(p.id) OVER() AS nbrProd FROM produits p";
        $data = db::query($sql);
        return (int) $data->nbrprod;        
    } 

    public static function valeurStockTotal() : int {
        $sql = "SELECT SUM(p.prix_vente * p.stock_initial) OVER() AS vst FROM produits p";
        $data = db::query($sql);
        return (int) $data->vst;        
    } 

    public static function saveProduit(PDTO $produit): int
    {
        $sql = "INSERT INTO produits(libelle, prix_vente, stock_initial)
        VALUES(:libelle, :prix_vente, :stock_initial)";
        $datas = [
            'libelle' => $produit->libelle,
            'prix_vente' => $produit->prix_vente,
            'stock_initial' => $produit->stock_initial
        ];
        db::executeUpdate($sql, $datas);
        return (int) 0;
    }
}