<?php

namespace App;

Class StatusHelper {

    public static function getStatusString($status,$statusArr)
    {
        return $statusArr[(int)$status];
    }

    public static function getStatusKey($string,$statusArr)
    {
        if (is_numeric($string)) {
            return $string;
        }
        return array_search($string, $statusArr);
    }
}