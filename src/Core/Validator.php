<?php

namespace App\Core;

class Validator
{
    public static function required(string $value, string $keyError, array &$errors, string $smsErrors = "Champ obligatoire"): bool
    {
        if (empty($value)) {
            $errors[$keyError] = $smsErrors;
            return false;
        }
        return true;
    }
    // $required = function (array &$errors, string $message = "Champ obligatoire", string $value ,string $key) : void{
    //     if(empty($value)){
    //         $errors[$key]["required"] = $message ;
    //     }
    // };
    // $required = function (array &$errors, string $message , string $value ,string $key) : void{
    //     if(empty($value)){
    //         $errors[$key] = $message ;
    //     }
    // };


    public static function unique(string $value, string $key, $datas, array &$errors, bool $required = true, string $smsError = "Ce champ est obligatoire"): void
    {
        if (!$required) {
            foreach ($datas as $data) {
                if ($data[$key] == $value) {
                    $errors[$key] = $smsError;
                    break;
                }
            }
        }
    }
    // function unique(array $datas, string $value, array &$errors, string $smsError = "Ce champ est obligatoire", string $key = 'libelle') : void{
    //     foreach ($datas as $data) {
    //         if ($data[$key] === $value) {
    //             $errors[$key]['unique'] = $errorUnique;
    //         }
    //     }
    // }
    // function unique(string $value, string $key, array $datas, array &$errors, bool $required = true, string $smsError = "Ce champ est obligatoire") : void {
    //     if (!$required){
    //         foreach ($datas as $data) {
    //             if ($data[$key] == $value){
    //                 $errors[$key] = $smsError;
    //                 break;
    //             }
    //         }
    //     }
    // }
    // function unique(string $value, string $keyError, array $data, array &$errors, string $smsErrors = "Ce champ doit etre unique") : void {
    //     if(in_array($value, $data)){
    //         $errors[$keyError] = $smsErrors;
    //     }
    // }
    // $unique = function (array $datas,array &$errors,string $message , string $value ,string $key) : void {
    //    if(in_array($value , $datas)){
    //      $errors[$key]["unique"] = $message;
    //    }
    // };
    // $unique = function (array &$errors,array $datas,string $value,string $key,string $message ): int {
    //     foreach($datas as $index => $data){
    //         if($data[$key] == $value){
    //             return $index;
    //         }
    //     } 
    //     $errors[$key]["isExiste"]= $message ;
    //     return -1;
    // };

    public static function isPositive(string $value, string $key, array &$errors, string $smsError = "ce champs doit etre un entier positif"): bool
    {
        if (!is_numeric($value) || $value < 0) {
            $errors[$key] = $smsError;
            return false;
        }
        return true;
    }

    public static function isEmail(string $value, string $keyError, array &$errors, bool $required = true, string $smsErrors = "Cette email doit repecter ce format : fatou@gmail.com")
    {
        if ($required && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $errors[$keyError] = $smsErrors;
        }
    }

    public static function validPassword(string $value, string $keyError, array &$errors, bool $required = true, int $min = 4, string $smsErrors = "Ce champ doit contenir au moins 4 caracteres.")
    {
        if ($required && strlen($value) < $min) {
            $errors[$keyError] = $smsErrors;
        }
    }
}