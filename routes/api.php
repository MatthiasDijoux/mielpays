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

//Routes user uniquement
Route::middleware('auth:api')->prefix('users')->group(function () {
    Route::get('/', 'UsersController@index');
    Route::get('/{id}', 'UsersController@user')->where('id', "[0-9]+");
    Route::get('/{id}/user', 'UsersController@deleteUser')->where('id', "[0-9]+");
    Route::post('/', 'UsersController@addUpdate');
});


//Routes des producteurs
Route::middleware(['auth:api', 'roles:Producteur'])->group(function () {
    Route::get('producteur/{id}', 'ProducteurController@index');
    Route::post('produit/{id}', 'ProduitController@modify');
    Route::post('{id}/produit', 'ProduitController@add');
    Route::post('produit/{id}', 'ProduitController@modify');
    Route::delete('produit/{id}', 'ProduitController@delete');
});




//Routes générales
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::get('producteurs', 'ProducteurController@getAll');
Route::get('popular', 'ProduitController@getPopular');
Route::get('produits', 'ProduitController@getAll');

//Routes des tous les users connectés
Route::middleware(['auth:api', 'roles:Producteur|Client|Admin'])->group(function () {
    Route::post('orders', 'OrderController@create');
    Route::post('orders/{id}/paiement', 'OrderController@paiement')->where('id', '[0-9]+');
});
Route::post('getPdf', 'OrderController@getPdf');
