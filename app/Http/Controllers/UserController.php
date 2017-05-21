<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mail\Register;
use App\Mail\Contact;
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
          $listUsers = DB::table('user')->select( 'id', 
                                                  'first_name as name', 
                                                  'status as subName',
                                                  'description',
                                                  'picture')->get();
          $redirection = 'show_user';

		return view('user.index')
               ->with('grid', $listUsers)
               ->with('redirection', $redirection);
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
          $departements = 0;
          //Récupère les oeuvres que l'utilisateur soihaite échanger
          $popUp = 'element.show';

          $listElements = DB::table('user_element')
                                   ->join('user', 'user.id' , '=' , 'user_element.id_user')
                                   ->join('element', 'element.id', '=', 'user_element.id_element')
                                   ->select( 'element.id', 
                                             'element.name', 
                                             'element.creator as subName',
                                             'element.description',
                                             'element.url_picture as picture')
                                   ->where('user.id', '=', $id)
                                   ->get();

		return view('user.show')
                    ->with(compact('infos'))
                    ->with(compact('departements'))
                    ->with('grid', $listElements)
                    ->with(compact('popUp', $popUp));
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
          /*
          $this->validate($request, [
               'first_name' => 'required',
          ]);*/
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
	public function contact(Request $request)
	{
          if(Auth::check()){
     		$this->validate($request, [
                    'id' => 'required',
                    'message' => 'required',
               ]);
               $input = $request->all();
               $user = User::findOrFail($input['id']);
               if($user->is_contactable){
                    $data = [
                         'sender' => Auth::user()->first_name,
                         'text' => $input['message'],
                         'receiver' => $user,
                    ];

                    Mail::send('emails.contact', $data, function($message) use ($user){
                         $message->to($user->email);
                         $message->subject('Un utilisateur vous a contacté');
                    });
                    return 1;
               }
               return 2;
	     }
          return 3;
     }

     /**
     * Contacter un administrateur
     *
     * @param  int  $id
     * @param Illuminate\Http\Request $request
     * @return view
     */
     public function contactAdmin(Request $request)
     {
          try{
               $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required',
                    'object' => 'required',
                    'message' => 'required',
               ]);
          }
          catch(\Exception $e){
               return 2;
          }
          
          $input = $request->all();
          
          try{
               $data = [
                    'senderName' => $input['name'],
                    'senderEmail' => $input['email'],
                    'text' => $input['message'],
                    'receiver' => "Administrateur",
               ];

               Mail::send('emails.contactAdmin', $data, function($message) use($input){
                    $message->to(env('MAIL_USERNAME'));
                    $message->subject($input['object']);
               });
               return 1;
          }
          catch(\Exception $e){
               //var_dump($e->getMessage());
               return 3;
          }
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
               
               $data = [
                    'token' => $token,
               ];

               Mail::send('emails.register', $data, function($message) use ($user){
                    $message->to($user->email);
                    $message->subject('Bienvenue sur le Club des Critiques');
               });

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
                    //var_dump($e->getMessage());
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
          $user = User::where('email', Input::get('email'))->first();

          if(!$user)
               return 2;

          //Envoi du mail
          try{
               $token = str_random(60);
               $user->token = $token;
               $user->save();
               
               $data = [
                    'token' => $token,
               ];

               Mail::send('emails.backUp', $data, function($message) use ($user){
                    $message->to($user->email);
                    $message->subject('Récupération de mot de passe.');
               });

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