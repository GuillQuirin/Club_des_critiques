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
     							->leftJoin('user_element', 'user_element.id_element', '=', 'element.id')
     							->select(	'element.id', 
 											'element.name', 
 											'element.creator as subName',
 											'element.description',
 											'element.url_picture as picture',
 											'element.url_api as link',
 											'category.name as name_category',
	                                        'category.id_parent as id_parent',
	                                        'category.id as id_category',
											DB::raw('ROUND(AVG(user_element.mark),1) as mark')
								)
     							->where('is_new', '=', '1')
     							->groupBy('element.id',
     										'element.name',
     										'element.creator',
     										'element.description',
 											'element.url_picture',
 											'element.url_api',
 											'category.name',
	                                        'category.id_parent',
	                                        'category.id')
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

	public function error404(){
		return view('errors.404');
	}
}
