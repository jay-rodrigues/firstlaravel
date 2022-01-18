<?php

namespace App\Models;

abstract class Cipher
{
    public $key;
    public $stringToEncrypt;
    //enc will determine how to encrypt
    //i.e for Ceasar cipher: 5 would be shift right 5
    abstract function encrypt();

    abstract function decrypt();

    //Not necessary
    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setString($newString)
    {
        $this->stringToEncrypt = $newString;
    }

}

?>
