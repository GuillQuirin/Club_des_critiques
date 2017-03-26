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

//Routes classiques directement vers une Vue en particulier
/* 
Route::get('/', function () {
     return view('welcome');
});

Route::get('article/{n}', function($n) { 
    return view('article')->with('numero', $n); 
})->where('n', '[0-9]+');
*/

//Routes vers un Controlleur qui décide de quelle vue afficher 
Route::get('/', 'WelcomeController@index');
Route::get('article/{n}', 'ArticleController@show')->where('n', '[0-9]+');


//Routes d'un formulaire
Route::get('users', 'UsersController@getInfos');
Route::post('users', 'UsersController@postInfos');

//Formulaire de contact
Route::get('contact', 'ContactController@getForm');
Route::post('contact', 'ContactController@postForm');

//Redirection pour les uploads
Route::get('photo', 'PhotoController@getForm');
Route::post('photo', 'PhotoController@postForm');