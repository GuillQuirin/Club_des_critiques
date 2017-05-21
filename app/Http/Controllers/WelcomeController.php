<?php

//Pour créer un controlleur, executer cette commande dans le dossier racine du projet
// php artisan make:controller NomController


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mail\Register;
use App\User;

class WelcomeController extends Controller
{
    public function index()
	{

		/**
		 * get concept
		 * get oeuvres à la une
		 * get contact info
		 */
		$page = [
			'url_background' => 'images/welcome.jpeg',
			'title' => "Le club des critiques",
			'slogan' => "Lisez, rencontrez, partagez",
			'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
		];

		$popUp = 'element.show';
     	
     	$listElements = DB::table('element')
     							->select(	'id', 
 											'name', 
 											'creator as subName',
 											'description',
 											'url_picture as picture')
     							->get();

		return view('welcome')
				->with(compact('page'))
				->with('grid', $listElements)
				->with('popUp', $popUp);
	}


	public function cookie()
	{
		if(!isset($_COOKIE['alert_cookies'])){
			setcookie("alert_cookies",1,time()+60*60*24*30*12);//Expiration dans 1 an
		}

	}
}
