<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/helloworld/{displaystring}', "App\Http\Controllers\HelloWorldController@index");


Route::get('/posts', 'App\Http\Controllers\PostController@index');
Route::post('/posts', 'App\Http\Controllers\PostController@store');
Route::get('/posts/create', 'App\Http\Controllers\PostController@create');
Route::get('/posts/view/{displaystring}', "App\Http\Controllers\PostController@indexbyid");

Route::get('/displayusers', 'App\Http\Controllers\DisplayUsersController@index');

Route::get('/generate/{length}', 'App\Http\Controllers\KeyGeneratorController@generate');
Route::get('/key', 'App\Http\Controllers\KeyGeneratorController@keyGenerateView');

Route::get('/caesarencipher/{string}/{key}', 'App\Http\Controllers\CaesarCipherController@encipher');
Route::get('/caesarencipher/{string}', 'App\Http\Controllers\CaesarCipherController@encipher');

Route::get('/caesardecipher/{string}/{key}', 'App\Http\Controllers\CaesarCipherController@decipher');
Route::get('/caesardecipher/{string}', 'App\Http\Controllers\CaesarCipherController@decipher');

Route::get('/caesarcipher', 'App\Http\Controllers\CaesarCipherController@caesarGenerateView');


Route::get('/chatroom', function () {
    return view('globalchat.chatroom');
});

