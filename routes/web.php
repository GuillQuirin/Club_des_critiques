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


//Accueil
Route::get('/', ['as' => 'home', 'uses' => 'WelcomeController@index']);

//Catégorie
Route::get('categories', ['as' => 'categories', 'uses' => 'CategoryController@index']);
Route::get('category/{id}', ['as' => 'show_category', 'uses' => 'CategoryController@show']);

//Oeuvres
Route::get('elements', ['as' => 'elements', 'uses' => 'ElementController@index']);
Route::get('element/{id}', ['as' => 'show_element', 'uses' => 'ElementController@show']);

//Utilisateur
Route::get('users', ['as' => 'users', 'uses' => 'UserController@index']);
Route::get('user/{id}', ['as' => 'show_user', 'uses' => 'UserController@show']);
Route::post('user/{id}', ['as' => 'update_user', 'uses' => 'UserController@updateInfo']);
Route::post('user/{id}', ['as' => 'update_password_user', 'uses' => 'UserController@updatePassword']);

//Salons
Route::get('rooms', ['as' => 'rooms', 'uses' => 'RoomsController@index']);
Route::get('rooms/futur_rooms', ['as' => 'futur_rooms', 'uses' => 'RoomsController@showFuturRooms']);
Route::get('rooms/my_rooms', ['as' => 'my_rooms', 'uses' => 'RoomsController@showMyRooms']);
Route::get('room/{id}', ['as' => 'show_room', 'uses' => 'RoomsController@show']);
Route::post('room/join/{id}', ['as' => 'join_room', 'uses' => 'RoomsController@join']);

//Contact
Route::post('contact', ['as' => 'contact', 'uses' => 'ContactController@postForm']);


//Routes classiques directement vers une Vue en particulier
/* 
Route::get('/', function () {
     return view('welcome');
});

Route::get('article/{n}', function($n) { 
    return view('article')->with('numero', $n); 
})->where('n', '[0-9]+');
*/

/* Routes vers un Controlleur qui décide quelle vue afficher */

/*//Accueil
Route::get('/', 'WelcomeController@index');

//Oeuvres
Route::get('/livres', 'BooksController@index');
Route::get('/films', 'MoviesController@index');
Route::get('/expositions', 'ExhibitionsController@index');

//Utilisateur
Route::get('/utilisateurs', 'UsersController@index');
Route::get('/utilisateur', 'UserController@index');

//Liste salons
Route::get('/salons', 'RoomsController@index');*/


/*Route::get('article/{n}', 'ArticleController@show')->where('n', '[0-9]+');


//Routes d'un formulaire
Route::get('users', 'UsersController@getInfos');
Route::post('users', 'UsersController@postInfos');

//Formulaire de contact
Route::get('contact', 'ContactController@getForm');
Route::post('contact', 'ContactController@postForm');

//Redirection pour les uploads
Route::get('photo', 'PhotoController@getForm');
Route::post('photo', 'PhotoController@postForm');

//Enregistrement des emails en Base de données
Route::get('email', 'EmailController@getForm');
Route::post('email', ['uses' => 'EmailController@postForm', 'as' => 'storeEmail']);

Route::resource('user', 'UserController');*/