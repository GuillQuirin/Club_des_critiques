<?php

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


/* ACCUEIL */
Route::get('/', ['as' => 'home', 'uses' => 'WelcomeController@index']);
Route::get('checkRegister/{token}', ['as' => 'checkToken', 'uses' => 'WelcomeController@checkRegister']);

/* CATEGORIES */
Route::get('categories', ['as' => 'categories', 'uses' => 'CategoryController@index']);
Route::get('category/{id}', ['as' => 'show_category', 'uses' => 'CategoryController@show']);

/* OEUVRE */
Route::get('elements', ['as' => 'elements', 'uses' => 'ElementController@index']);
Route::get('element/{id}', ['as' => 'show_element', 'uses' => 'ElementController@show']);


/* UTILISATEUR */

//Liste des utilisateurs
Route::get('users', ['as' => 'users', 'uses' => 'UserController@index']);
//Affichage d'un utilisateur
Route::get('user/{id}', ['as' => 'show_user', 'uses' => 'UserController@show']);
//Modifications de l'utilisateur
Route::patch('user/{id}', ['as' => 'update_user', 'uses' => 'UserController@updateInfo']);
Route::post('user/{id}', ['as' => 'update_password_user', 'uses' => 'UserController@updatePassword']);
//Inscription
Route::post('register', ['as' => '/', 'uses' => 'UserController@register']);

/* SALONS */
Route::get('rooms', ['as' => 'rooms', 'uses' => 'RoomsController@index']);
Route::get('rooms/futur_rooms', ['as' => 'futur_rooms', 'uses' => 'RoomsController@showFuturRooms']);
Route::get('rooms/my_rooms', ['as' => 'my_rooms', 'uses' => 'RoomsController@showMyRooms']);
Route::get('room/{id}', ['as' => 'show_room', 'uses' => 'RoomsController@show']);
Route::post('room/join/{id}', ['as' => 'join_room', 'uses' => 'RoomsController@join']);

/* CONTACT */
Route::post('contact', ['as' => 'contact', 'uses' => 'ContactController@postForm']);


/* ADMINISTRATION */
Route::get('admin', ['as' => 'admin', 'uses' => 'AdminController@index']);



//Routes classiques directement vers une Vue en particulier
/* 
Route::get('/', function () {
     return view('welcome');
});

Route::get('article/{n}', function($n) { 
    return view('article')->with('numero', $n); 
})->where('n', '[0-9]+');
*/
