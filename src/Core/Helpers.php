<?php
namespace App\Core;
class Helpers
{
    public static function assets(string $path): void
    {
        echo (WEB_ROUTE . "/assets/$path");
    }

    public static function pathUrl(string $uri = ""): void
    {
        echo WEB_ROUTE . "/$uri";
    }

    public static function showProfil(): void
    {
        // $userConnect = getData(KEY_USERCONNECT);
        // echo $userConnect["prenom"] . " " . $userConnect["nom"];
    }

    public static function showUrlProfilPhoto(): void
    {
        // $userConnect = getData(KEY_USERCONNECT);
        // echo $userConnect["photo"];
    }
}