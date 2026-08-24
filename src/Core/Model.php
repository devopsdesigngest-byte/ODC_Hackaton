<?php
namespace App\Core;
use App\Core\Database as db;
class Model
{
    public static function getAllTable(string $table): array
    {
        $pdo = db::connexionDB();
        $sql = "SELECT * FROM $table";
        $datas = db::query($pdo, $sql, false);
        return $datas;

    }

    public static function getModelById(array $datas, int $id, string $key = 'id'): array|null
    {
        foreach ($datas as $data) {
            if ($data[$key] === $id) {
                return $data;
            }
        }
        return null;
    }
}
