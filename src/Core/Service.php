<?php
namespace App\Core;
class Service
{
    public static function saisie(string $message): string
    {
        return readline($message);
    }

    public static function genereReferenceProduit(array $products): string
    {
        $taille = count($products) + 1;
        if ($taille <= 9)
            return "REF00" . $taille;
        elseif ($taille <= 99)
            return "REF0" . $taille;
        else
            return "REF" . $taille;
    }
}