<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mail\Register;
use App\Mail\BackUp;
use App\User;

class UserController extends Controller
{
     /**
     * Affiche la liste de tous les utilisateurs
     *
     * @return view
     */
     public function index()
     {
          // Collection de tous les users
          // $users = User::all();
          $array = User::latest('date_created')->get();
          $array->redirect = 'show_user';

		return view('user.index')
                    ->with(compact('array'));
	}

	/**
     * Affiche le profil d'un utilisateur
     *
     * @param  int  $id
     * @return view
     */
	public function show($id)
	{
          // Récupère l'utilisateur
          $infos = User::findOrFail($id);
          $infos->myAccount  = (Auth::check() && Auth::id() == $id);
          $departements = [
                    '(00) Hors France',
                    '(01) Ain',
                    '(02) Aisne',
                    '(03) Allier',
                    '(04) Alpes de Haute Provence',
                    '(05) Hautes Alpes',
                    '(06) Alpes Maritimes',
                    '(07) Ardèche',
                    '(08) Ardennes',
                    '(09) Ariège',
                    '(10) Aube',
                    '(11) Aude',
                    '(12) Aveyron',
                    '(13) Bouches du Rhône',
                    '(14) Calvados',
                    '(15) Cantal',
                    '(16) Charente',
                    '(17) Charente Maritime',
                    '(18) Cher',
                    '(19) Corrèze',
                    '(2A) Corse du Sud',
                    '(2B) Haute-Corse',
                    '(21) Côte d\'Or',
                    '(22) Côtes d\'Armor',
                    '(23) Creuse',
                    '(24) Dordogne',
                    '(25) Doubs',
                    '(26) Drôme',
                    '(27) Eure',
                    '(28) Eure et Loir',
                    '(29) Finistère',
                    '(30) Gard',
                    '(31) Haute Garonne',
                    '(32) Gers',
                    '(33) Gironde',
                    '(34) Hérault',
                    '(35) Ille et Vilaine',
                    '(36) Indre',
                    '(37) Indre et Loire',
                    '(38) Isère',
                    '(39) Jura',
                    '(40) Landes',
                    '(41) Loir et Cher',
                    '(42) Loire',
                    '(43) Haute Loire',
                    '(44) Loire Atlantique',
                    '(45) Loiret',
                    '(46) Lot',
                    '(47) Lot et Garonne',
                    '(48) Lozère',
                    '(49) Maine et Loire',
                    '(50) Manche',
                    '(51) Marne',
                    '(52) Haute Marne',
                    '(53) Mayenne',
                    '(54) Meurthe et Moselle',
                    '(55) Meuse',
                    '(56) Morbihan',
                    '(57) Moselle',
                    '(58) Nièvre',
                    '(59) Nord',
                    '(60) Oise',
                    '(61) Orne',
                    '(62) Pas de Calais',
                    '(63) Puy de Dôme',
                    '(64) Pyrénées Atlantiques',
                    '(65) Hautes Pyrénées',
                    '(66) Pyrénées Orientales',
                    '(67) Bas Rhin',
                    '(68) Haut Rhin',
                    '(69) Rhône',
                    '(70) Haute Saône',
                    '(71) Saône et Loire',
                    '(72) Sarthe',
                    '(73) Savoie',
                    '(74) Haute Savoie',
                    '(75) Paris',
                    '(76) Seine Maritime',
                    '(77) Seine et Marne',
                    '(78) Yvelines',
                    '(79) Deux Sèvres',
                    '(80) Somme',
                    '(81) Tarn',
                    '(82) Tarn et Garonne',
                    '(83) Var',
                    '(84) Vaucluse',
                    '(85) Vendée',
                    '(86) Vienne',
                    '(87) Haute Vienne',
                    '(88) Vosges',
                    '(89) Yonne',
                    '(90) Territoire de Belfort',
                    '(91) Essonne',
                    '(92) Hauts de Seine',
                    '(93) Seine Saint Denis',
                    '(94) Val de Marne',
                    '(95) Val d\'Oise',
                    '971' => '(971) Guadeloupe',
                    '972' => '(972) Martinique',
                    '973' => '(973) Guyane',
                    '974' => '(974) Réunion',
                    '975' => '(975) Saint Pierre et Miquelon',
                    '976' => '(976) Mayotte'];
          //Récupère les oeuvres que l'utilisateur soihaite échanger
          /*$exchange = [1, 2, 3, 4];
          $popUp = 'element.show';
          $array->items = [
                ['id' => 1, 'name' => 'Harry Potter', 'subname' => 'Livre', 'url_img' => '/images/oeuvre.jpg', 'description' => "COUCOU"],
                ['id' => 2, 'name' => 'Interstellar', 'subname' => 'Film', 'url_img' => '/images/oeuvre1.jpg', 'description' => "COUCOU"],
                ['id' => 3, 'name' => 'Paris Games Week', 'subname' => 'Exposition', 'url_img' => '/images/oeuvre2.jpg', 'description' => "COUCOU"],
          ];*/

		return view('user.show')
                    ->with(compact('infos'))
                    ->with(compact('departements'));/*
                    ->with(compact('exchange'))
                    ->with(compact('array'))
                    ->with(compact('popUp'));*/
	}


	/**
     * Modification des info personnelles d'un utilisateur
     *
     * @param int  $id
     * @param Illuminate\Http\Request $request
     * @return view
     */
	public function updateInfo(Request $request, $id)
	{
          $user = Auth::user();
          $oldPicture = $user->picture;

          $this->validate($request, [
               'first_name' => 'required',
               'last_name' => 'required',
          ]);
          $input = $request->all();
          $user->fill($input);
          $user->is_contactable = Input::get('is_contactable');

          //Enregistrement de la nouvelle image uploadée
          if (Input::file('picture')!==NULL && Input::file('picture')->isValid()){
               $destinationPath = 'uploads/';
               $extension = Input::file('picture')->getClientOriginalExtension(); // getting image extension
               $fileName = rand(11111,99999).'.'.$extension; // renameing image
               Input::file('picture')->move($destinationPath, $fileName); // uploading file to given path
               $user->picture = "/uploads/".$fileName;
          }
          else 
               $user->picture = $oldPicture;               

          $user->save();
		return $this->show($id);
	}

	/**
     * Modification du mot de passe de l'utilisateur
     *
     * @param  int  $id
     * @param Illuminate\Http\Request $request
     * @return view
     */
	public function updatePassword(Request $request, $id)
	{
		return view('user.show');
	}

	/**
     * Contacter un utilisateur
     *
     * @param  int  $id
     * @param Illuminate\Http\Request $request
     * @return view
     */
	public function contact(Request $request, $id)
	{
		//
	}

     /**
     * Inscription d'un utilisateur
     *
     */
     public function register(Request $request){
          $this->validate($request, [
               'email' => 'required',
          ]);
          $input = $request->all();

          //Création de l'utilisateur
          try{
               $user = User::create($input);
          }
          catch(\Exception $e){
               //var_dump($e->getMessage());
               return 2;
          }

          //Envoi du mail
          try{
               $token = str_random(60);
               $user->fill(['token' => $token])->save();
               Mail::to($user->email)->send(new Register($token));
          }
          catch(\Exception $e){
               var_dump($e->getMessage());
               return 3;
          }

          return 1;
     }

     /**
     * Authentification
     *
     */
     public function login(Request $request){
          
          if(!Auth::check()){
               $this->validate($request, [
                    'email' => 'required',
                    'password' => 'required',
               ]);
               $input = $request->all();
               try{
                    if(Auth::attempt([  'email' => $input['email'], 
                                        'password' => $input['password'],
                                        'status' => 1])){
                         
                         $user = Auth::user();
                         $request->session()->put('user_id', $user->id);
                         return '/user/'.$user->id; //Adresse de destination si Auth OK
                    }
                    else 
                         return 2; //Identifiants incorrects  
               }
               catch(\Exception $e){
                    var_dump($e->getMessage());
                    return 3; //Erreur technique
               }
          }
          return 1; // Déjà connecté
     }

     /**
     * Déconnexion
     *
     */
     public function logout(){
          if(Auth::check()){
               Auth::logout();
               return redirect()->route('home');
          }
     }

     /**
     * Mot de passe oublié
     *
     */
     public function forgotPwd(Request $request){
          $this->validate($request, [
               'email' => 'required',
          ]);
          $input = $request->all();

          //Récupération de l'utilisateur
          try{
               $user = User::where('email', Input::get('email'))->first();
          }
          catch(\Exception $e){
               //var_dump($e->getMessage());
               return 2;
          }

          //Envoi du mail
          try{
               $token = str_random(60);
               $user->token = $token;
               $user->save();
               Mail::to($user->email)->send(new BackUp($token));
          }
          catch(\Exception $e){
               //var_dump($e->getMessage());
               return 3;
          }

          return 1;
     }

     /**
     * Vérification du token en GET
     *
     */
     public function checkToken($token){
          //Vérification de la validité
          $user = User::where('token', $token)->first();
          return ($user) ? view('user.backUp')->with('token',$token) :  redirect('/');
     }

     /**
     * Remplacement du mot de passe
     *
     */
     public function newPwd(Request $request){
          $this->validate($request, [
               'pwd' => '',
               'new_pwd' => 'required',
               'new_pwd_confirm' => 'required',
               'token' => '',
          ]);
          $input = $request->all();

          //Récupération de l'utilisateur
          try{
               //SOIT TOKEN, SOIT SESSION DE L'UTILISATEUR POUR CHANGEMENT DE MDP
               $user = (Auth::check()) ? Auth::user() : User::where('token', Input::get('token'))->first();
               $user->password = Hash::make(Input::get('new_pwd'));
               
               //Si l'utilisateur vient juste de créer son compte, alors on l'active une fois le mdp établi
               if($user->status==0)
                    $user->status = 1;
               
               $user->token ="";
               $user->save();
          }
          catch(\Exception $e){
               var_dump($e->getMessage());
               return back()->withInput();
          }
          return (Auth::check()) ? redirect('user/'.$user->id) : redirect('/');
     }

     /**
     * Suppression du compte
     *
     */
     public function deleteAccount(Request $request){
          if(Auth::check()){
               $this->validate($request, [
                    'pwd_unsub' => 'required',
               ]);
               $input = $request->all();

               //Récupération de l'utilisateur
               try{
                    if (Hash::check($input['pwd_unsub'], Auth::user()->password)){
                         $user = User::find(Auth::user()->id);
                         Auth::logout();
                         
                         $user->first_name=NULL;
                         $user->last_name=NULL;
                         $user->description=NULL;
                         $user->picture=NULL;
                         $user->email=NULL;
                         $user->status=-2;
                         $user->password=NULL;
                         $user->token=NULL;
                         $user->remember_token=NULL; //Ne marche pas, je sais pas pourquoi
                         $user->is_reported=0;
                         $user->is_contactable=1;

                         $user->save();
                    }
                    else{ 
                         echo "Les mots de passe ne correspondent pas.";
                         die;
                    }
               }
               catch(\Exception $e){
                    var_dump($e->getMessage());
                    die;
               }

               return redirect()->route('home');
          }
     }

	////// ADMINISTRATION ///////

	/**
     * Ajout d'un nouvel utilisateur
     *
     * @return view
     */
	public function add()
	{
		# code...
	}

	/**
     * Modification d'un utilisateur
     *
     * @param  int  $id
     * @return view
     */
	public function edit($id)
	{
		$user = User::findOrFail($id);
          $this->show($id);
	}

	/**
     * Suppression d'un utilisateur
     *
     * @param  int  $id
     * @return view
     */
	public function delete($id)
	{
		# code...
	}

	/**
     * Ban d'un utilisateur
     *
     * @param  int  $id
     * @return view
     */
	public function ban($id)
	{
		# code...
	}
}