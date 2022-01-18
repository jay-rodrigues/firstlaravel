<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caesar;

class CaesarCipherController extends Controller
{
    ////

    public function caesarGenerateView()
    {
        return view("tools.encryption.caesarcipher");
    }

    public function decipher($cipherText, $key)
    {
        if($key == 0)
            $key = null;

        $caesar = new Caesar($cipherText, $key);
        $plainText = $caesar->Decrypt();

        return $caesar->decryptedKey . ": " . $plainText;
    }

    public function encipher($plainText, $key)
    {
        if($key == 0)
            $key = null;

        $caesar = new Caesar($plainText, $key);

        return $caesar->Encrypt();
    }

}
