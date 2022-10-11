<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', 'App\Http\Controllers\UserController@index');
Route::get('/user/pokemon', 'App\Http\Controllers\UserController@users_pokemon');
Route::post('/user', 'App\Http\Controllers\UserController@store');
Route::get('/user/buscar', 'App\Http\Controllers\UserController@show');

Route::get('/pokemon', 'App\Http\Controllers\PokemonController@index');
Route::post('/pokemon', 'App\Http\Controllers\PokemonController@store');
Route::get('/pokemon/buscar', 'App\Http\Controllers\PokemonController@show');



