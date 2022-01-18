<?php
//Post Cleanup 1/17/2022
//
namespace App\Models;


//cipher code pulled from https://www.programmingalgorithms.com/algorithm/caesar-cipher/php/
class Caesar extends cipher

{

    public $decryptedKey;

    function __construct($str, $key = null)
    {
        $this->stringToEncrypt = $str;
        $this->key = $key;
        $this->decryptedKey = $key;
    }


    /**
     * cipher
     *
     * @param  mixed $ch The character to modify
     * @param  mixed $key The shift
     * @return void Returns character that is $key distance from $ch
     */
    function cipher($ch, $key)
    {

        if (!ctype_alpha($ch))
            return $ch;

        $offset = ord(ctype_upper($ch) ? 'A' : 'a');

        return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);

    }

    /**
     * encrypt
     * Access point to encrypt a string stored in $this->stringToEncrypt
     * @return void
     */
    function encrypt()
    {

        if($this->key == null) {
            $this->key = rand(1,26);
        }

        //Send to the encipher function for modification
        $this->stringToEncrypt = $this->encipher($this->stringToEncrypt,$this->key);

        return $this->stringToEncrypt;
    }



    /**
     * decrypt
     * This is the public access function
     * Takes $this->stringToEncrypt and $this->key
     * If the key defined at construction is null; import dictionary file and perform all possible Caesar ciphers on it
     * If the key defined is not null; perform decryption with given key
     * @return void
     */
    function decrypt(){

        //Execute decryption with all possible Caesars using dictionary
        if($this->key == null)  {

            $this->stringholder ="";

            /** Find the longest word in the array
             *  Because if we find the longest word with a given cipher
             * That is an actual word then in all likelihood it is the correct cipher maybe
             */
            $inputArr = explode(" ", $this->stringToEncrypt);
            $lengths = array_map('strlen', $inputArr);
            $longestString = $inputArr[array_search(max($lengths), $lengths)];

            //Now that we found the longest string. It is time to pull the dictionary into an array
            $dict = file(storage_path('dict/words.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            $search_array = array_combine(array_map('strtolower', $dict), $dict);   //Put terms in key of the array and in lower case


            /**
             * This for loop attempts all Caesar ciphers on ONLY the longest word in the string
             * The thought is that if we can find the correct shift on one word then it should theoretically be the shift for
             * the entire string. Once the word is decrypted, then it performs the decryption on the whole string
             * with the correct shift amount $counter
             */

             //use all possible caesar ciphers on the longest string and check each against dictionary
            for($counter = 0; $counter < 26; $counter++) {

                $decryptedword = $this->encipher($longestString, 26 - $counter);

                //Search the dictionary array for the decrypted word
                try {

                    if($search_array[strtolower($decryptedword)]) {

                        $this->decryptedKey = $counter;
                        $this->stringToEncrypt = $this->encipher($this->stringToEncrypt, 26 - $counter); //Found the shift, decrypt whole string
                        return $this->stringToEncrypt; //Decrpytion complete

                    }
                }
                catch(\Exception $e)    //This catch statement will execute if the word was not found in the dictionary
                {
                    //Nothing needs to be done here because if this one word in the string was not found
                    //it does not necessarily mean failure
                }
            }
        }
        //Execute decryption with given cypher
        else {
            $this->stringToEncrypt = $this->decipher($this->stringToEncrypt, $this->key);
            return $this->stringToEncrypt;
        }

        return "Failed to decrypt " . $this->stringToEncrypt;   //If this line is reached, then no decryption was performed

    }

    /**
     * encipher
     *
     * @param  mixed $input String to perform cipher on
     * @param  mixed $key Number of letters to shift right
     * @return string $output Returns the $input string shifted $key letters
     */
    function encipher($input, $key)
    {
        $output = "";
        $inputArr = str_split($input);

        foreach ($inputArr as $ch)
            $output .= $this->cipher($ch, $key);

        return $output;
    }

    /**
     * decipher
     * Uses encipher function to shift opposite direction
     * @param  mixed $input String to perform cipher on
     * @param  mixed $key Number of letters to shift
     * @return string Returns the $input string shifted $key letters
     */
    function decipher($input, $key)
    {
        $decipherinput = $this->encipher($input, 26 - $key);
        $this->stringToEncrypt = $decipherinput;
        return $this->stringToEncrypt;
    }


}
