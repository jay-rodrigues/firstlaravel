<?php
namespace App\Models;
use App\Models\Caesar;



class Key
{

    public static function generate($length = 25)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }


        return $string;
    }

}
