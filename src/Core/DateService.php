<?php

namespace App\Core;
use DateTime;

class DateService
{
    public static function formatDate(string $format, string $date): DateTime|false
    {
        return date_create_from_format($format, $date);
    }

    function getDateNow(string $format): array
    {
        $date = date_create();
        return [
            $date,
            $date->format($format)
        ];
    }

    public static function dateDiff(DateTime $dateDebut, DateTime $dateFin, string $value = "days"): int
    {
        $date = date_diff($dateDebut, $dateFin);
        $invert = $date->invert;
        $tab = [
            0 => -$date->$value,
            1 => $date->$value
        ];
        return $tab[$invert];
    }
}