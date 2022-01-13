<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Key;


class KeyGeneratorController extends Controller
{
    //
    public function generate($length)
    {

        return Key::generate($length);
    }

    public function keyGenerateView()
    {
        return view("tools.encryption.keygenerator");
    }

}
