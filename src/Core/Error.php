<?php
namespace App\Core;

class Error
{
    public static function showError(array $errors)
    {
        foreach ($errors as $error) {
            echo "$error \n";
        }
    }
    public static function showError2(array $errors)
    {
        foreach ($errors as $errorField) {
            foreach ($errorField as $error) {
                echo "$error \n";
            }
        }
    }
    public static function errorExist(array $errors): bool
    {
        return count($errors) !== 0;
    }
}
