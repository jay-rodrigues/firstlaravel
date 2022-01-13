<?php

namespace App\Models;


//cipher code pulled from https://www.programmingalgorithms.com/algorithm/caesar-cipher/php/
class Caesar extends Cipher

{
    public $str;
    public $key;

    function __construct($str, $key = NULL)
    {
        $this->str = $str;
        $this->key = $key;
        // $this->str = $this->Encipher($str, $key);
        // dump("After Encode ". $this->str);
        // dump($this->Decipher($this->str, $key));

    }
    function Cipher($ch, $key)
    {
        if (!ctype_alpha($ch))
            return $ch;

        $offset = ord(ctype_upper($ch) ? 'A' : 'a');
        return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
    }

    function Encrypt()
    {
        if($this->key == NULL){
            $this->key = rand(1,26);
            //dump("Encoding with random key = " . $this->key);
        }
        //Send to the encipher function for modification
        $this->str = $this->Encipher($this->str,$this->key);
        return $this->str;
    }

    function Decrypt(){
        //Execute decryption with all possible Caesars using dictionary
        if($this->key == NULL)
        {

            $this->stringholder ="";

            //Find the longest word in the array
            //Because if we find the longest word with a given cipher
            //That is an actual word then in all likelihood it is the correct cipher maybe
            $inputArr = explode(" ", $this->str);
            $lengths = array_map('strlen', $inputArr);
            $longestString = $inputArr[array_search(max($lengths), $lengths)];

            //Now that we found the longest string. It is time to pull the dictionary into an array
            $dict = file(storage_path('dict/words.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            //Put terms in key of the array and in lower case
            $search_array = array_combine(array_map('strtolower', $dict), $dict);


            //use all possible caesar ciphers on the longest string and check each against dictionary
            for($counter = 0; $counter < 26; $counter++)
            {
                $decryptedword = $this->Encipher($longestString, 26 - $counter);
                //dump("Longest String: ".$longestString ." Decrypted Word: ". $decryptedword . " Count: " . $counter);
                try
                {
                    if($search_array[strtolower($decryptedword)])
                    {
                        //dump("Found ".$decryptedword);
                        $this->str = $this->Encipher($this->str, 26 - $counter);
                        return $this->str;
                    }
                }
                catch(\Exception $e)
                {

                    //dump("Did not find ".$decryptedword);
                }
            }

        }
        //Execute decryption with given cypher
        else
        {
            $this->str = $this->Decipher($this->str, $this->key);
            return $this->str;
        }



    }

    function Encipher($input, $key)
    {
        $output = "";

        $inputArr = str_split($input);
        foreach ($inputArr as $ch)
            $output .= $this->Cipher($ch, $key);
        //$this->str = $output;
        return $output;
    }

    function Decipher($input, $key)
    {
        $decipherinput = $this->Encipher($input, 26 - $key);
        $this->str = $decipherinput;
        return $this->str;
    }


}
