<?php

namespace App\Models;

abstract class Cipher
{
    public $key;
    public $str;
    //enc will determine how to encrypt
    //i.e for Ceasar cipher: 5 would be shift right 5
    abstract function Encrypt();

    abstract function Decrypt();

    //Not necessary
    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setString($str)
    {
        $this->str = $str;
    }

}

?>
