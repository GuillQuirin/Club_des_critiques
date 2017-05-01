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
		$array = [
			'url_background' => 'images/welcome.jpeg',
			'title' => "Le club des critiques",
			'slogan' => "Lisez, rencontrez, partagez",
			'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
		];

		$popUp = 'element.show';
		$array['items'] = [
            ['id' => 1, 'name' => 'Harry Potter', 'subname' => 'Livre', 'url_img' => '/images/oeuvre.jpg', 'description' => "COUCOU"],
            ['id' => 2, 'name' => 'Interstellar', 'subname' => 'Film', 'url_img' => '/images/oeuvre1.jpg', 'description' => "COUCOU"],
            ['id' => 3, 'name' => 'Paris Games Week', 'subname' => 'Exposition', 'url_img' => '/images/oeuvre2.jpg', 'description' => "COUCOU"],
     	];

		return view('welcome')
				->with(compact('array'))
				->with(compact('popUp'));
	}

	public function checkRegister($id)
	{
		$userAccount = DB::table('user')
                     	->select(DB::raw('id'))
	                    ->where('token', '=', $id)
	                    ->get();
	    try{
	    	$user = User::findOrFail($userAccount[0]->id);
		 	$user->token="";
		 	$user->status=1;
		 	$user->save();
		}
		catch(\Exception $e){
			var_dump($e->getMessage());
			die;
		}
		return redirect('/');
	}
}
