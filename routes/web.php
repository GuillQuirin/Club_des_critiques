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


/****** ACCUEIL ******/

Route::get('/', ['as' => 'home', 'uses' => 'WelcomeController@index']);
Route::post('cookie', ['as' => '/', 'uses' => 'WelcomeController@cookie']);
Route::post('contact', ['as' => 'contact', 'uses' => 'UserController@contact']);


/****** CATEGORIES ******/

Route::get('categories', ['as' => 'categories', 'uses' => 'CategoryController@index']);
Route::get('category/{id}', ['as' => 'show_category', 'uses' => 'CategoryController@show']);


/****** OEUVRE *******/

Route::get('elements', ['as' => 'elements', 'uses' => 'ElementController@index']);
Route::get('element/{id}', ['as' => 'show_element', 'uses' => 'ElementController@show']);



/****** UTILISATEUR ******/

	//Liste des utilisateurs
	Route::get('users', ['as' => 'users', 'uses' => 'UserController@index']);

	//Affichage d'un utilisateur
	Route::get('user/{id}', ['as' => 'show_user', 'uses' => 'UserController@show']);

	//Contact d'un utilisateur
	/* Voir Section ACCUEIL */

	//Inscription
	Route::post('register', ['as' => '/', 'uses' => 'UserController@register']);

	//Authentification
	Route::post('login', ['as' => '/', 'uses' => 'UserController@login']);
	Route::post('forgot', ['as' => '/', 'uses' => 'UserController@forgotPwd']);
	Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@logout']);

	//Création-Renouvellement du mot de passe
	Route::get('checkToken/{token}', ['as' => '/checkToken', 'uses' => 'UserController@checkToken']);
	Route::post('checkToken', ['as' => '/checkToken', 'uses' => 'UserController@newPwd']);

	//Modifications de l'utilisateur
	Route::patch('user/{id}', ['as' => 'update_user', 'uses' => 'UserController@updateInfo']);
	Route::post('user/{id}', ['as' => 'update_password_user', 'uses' => 'UserController@updatePassword']);

	//Suppression
	Route::post('deleteAccount', ['as' => 'deleteAccount', 'uses' => 'UserController@deleteAccount']);


/****** SALONS ******/

	Route::get('rooms', ['as' => 'rooms', 'uses' => 'RoomsController@index']);
	Route::get('rooms/futur_rooms', ['as' => 'futur_rooms', 'uses' => 'RoomsController@showFuturRooms']);
	Route::get('rooms/my_rooms', ['as' => 'my_rooms', 'uses' => 'RoomsController@showMyRooms']);
	Route::get('room/{id}', ['as' => 'show_room', 'uses' => 'RoomsController@show']);
	Route::post('room/join/{id}', ['as' => 'join_room', 'uses' => 'RoomsController@join']);


/****** ADMINISTRATION ******/

	Route::get('admin', ['as' => 'admin', 'uses' => 'AdminController@index']);
	Route::put('admin/edit-concept', ['as' => 'edit_concept', 'uses' => 'AdminController@editConcept']);
	Route::put('admin/add-top-element', ['as' => 'add_top_element', 'uses' => 'AdminController@addTopElement']);
	Route::put('admin/delete-top-element', ['as' => 'delete_top_element', 'uses' => 'AdminController@deleteTopElement']);

	// Ajax
	Route::get('admin/sub-categories', ['as' => 'get_sub_categories', 'uses' => 'AjaxController@getSubCategories']);
	Route::get('admin/creators', ['as' => 'get_creators', 'uses' => 'AjaxController@getCreatorForSubCat']);
	Route::get('admin/elements', ['as' => 'get_elements', 'uses' => 'AjaxController@getElementForCreatorAndCategory']);

Route::post('room/autocompleteUser', ['as' => '/', 'uses' => 'RoomsController@autocompleteUser'] );
Route::post('room/addMessage', ['as' => '/', 'uses' => 'RoomsController@addMessage'] );

//Routes classiques directement vers une Vue en particulier
/* 
Route::get('/', function () {
     return view('welcome');
});

Route::get('article/{n}', function($n) { 
    return view('article')->with('numero', $n); 
})->where('n', '[0-9]+');
*/
