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
use App\Other;

class WelcomeController extends Controller
{
    public function index()
	{
		$concept = Other::where('name', 'home_concept')->first();
		$slogan = Other::where('name', 'home_slogan')->first();
		/**
		 * get concept
		 * get oeuvres à la une
		 * get contact info
		 */
		$page = [
			'url_background' => 'images/welcome.jpeg',
			'title' => "Le club des critiques",
		];

		$popUp = 'element.show';
     	$listElements = DB::table('element')
     							->leftJoin('category', 'element.id_category', '=', 'category.id')
     							->select(	'element.id', 
 											'element.name', 
 											'element.creator as subName',
 											'element.description',
 											'element.url_picture as picture',
 											'category.name as name_category',
	                                        'category.id_parent as id_parent',
	                                        'category.id as id_category')
     							->where('is_new', '=', '1')
     							->get();

		return view('welcome')
				->with('concept', $concept)
				->with('slogan', $slogan)
				->with(compact('page'))
				->with('grid', $listElements)
				->with('nbElements', 8)
				->with('popUp', $popUp);
	}


	public function cookie()
	{
		if(!isset($_COOKIE['alert_cookies'])){
			setcookie("alert_cookies",1,time()+60*60*24*30*12);//Expiration dans 1 an
		}

	}
}
