<?php

namespace App\Model\Repository;

use App\Core\Database as db;
use App\Core\Debug as DD;
use App\Model\Entity\Client as C;

class ClientRepository
{
    public static function getAllClients(): array
    {
        $sql = "SELECT c.nom || ' ' || c.prenom as nomcomplet, c.numero_telephone, c.limite_credit 
        FROM clients c ORDER BY c.id DESC;";
        $datas = db::query($sql, false);

        $resultats = array_map(function ($data) {
            return C::toEntity($data);
        }, $datas);
        return $resultats;
    }

    public static function getNreClients(): int
    {
        $sql = "SELECT COUNT(c.id) OVER() AS nbrClient FROM clients c";
        $data = db::query($sql);
        return (int) $data->nbrclient;
    }


    public static function saveClient(array $client): int
    {
        $sql = "INSERT INTO clients(nom, prenom, email, numero_telephone, limite_credit)
        VALUES(:nom, :prenom, :email, :numero_telephone, :limite_credit)";
        $client = [
            ':nom' => $client['nom'],
            ':prenom' => $client['prenom'],
            ':email' => $client['email'],
            ':numero_telephone' => $client['numero_telephone'],
            ':limite_credit' => $client['limite_credit']
        ];
        db::executeUpdate($sql, $client);
        return (int) 0;
    }
}