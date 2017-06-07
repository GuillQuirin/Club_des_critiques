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
                                                  'location',
                                                  'date_created as date',
                                                  'picture')
                                        ->orderBy('date_created', 'desc')
                                        ->get();
                                        
          //Renommage des statuts
          foreach ($listUsers as $user) {
               switch ($user->subName) {
                         case '2':
                              $user->subName="Administrateur";
                              break;
               
                         case '1':
                              $user->subName="Membre";
                              break;
          
                         case '-1':
                              $user->subName="Membre banni";
                              break;

                         default:
                              $user->subName="Membre";
                              break;
                    }     
          }

          $redirection = 'show_user';

          $departments = $this->getDepartments();

		return view('user.index')
               ->with('grid', $listUsers)
               ->with('departments', $departments)
               ->with('nbElements', 8)
               ->with('redirection', $redirection);
	}

     private function getDepartments(){
          //Liste des departements
          $departments = DB::table('department')
                                   ->select('code','name')
                                   ->get();

          $listDepartments = [];
          foreach ($departments as $key => $dpt)
               $listDepartments[$dpt->code] = "(".$dpt->code.") ".$dpt->name;

          return $listDepartments;
     }

	/**
     * Affiche le profil d'un utilisateur
     *
     * @param  int  $id
     * @return view
     */
	public function show($id)
	{
          //Liste des infos de l'utilisateur
          $infos = DB::table('user')
                              ->leftJoin('department', 'user.location' , '=' , 'department.code')
                              ->select( 'user.id', 
                                        'user.first_name', 
                                        'user.last_name',
                                        'user.email',
                                        'user.is_contactable',
                                        'user.status',
                                        'user.description',
                                        'user.picture',
                                        'department.name as department_name',
                                        'department.code as department_code',
                                        'date_created'
                                        )
                              ->where('user.id', '=', $id)
                              ->get();

          $myAccount  = (Auth::check() && Auth::id() == $id);


          $listDepartments = $this->getDepartments();


          //Liste des oeuvres que l'utilisateur souhaite échanger
          $popUp = 'element.show';
          $exchangedElements = DB::table('user_element')
                                   ->leftJoin('user', 'user.id' , '=' , 'user_element.id_user')
                                   ->leftJoin('element', 'element.id', '=', 'user_element.id_element')
                                   ->leftJoin('category', 'category.id', '=', 'element.id_category')
                                   ->select( 'element.id', 
                                             'element.name', 
                                             'element.creator as subName',
                                             'element.description',
                                             'element.url_picture as picture',
                                             'category.name as name_category',
                                             'category.id_parent as id_parent',
                                             'category.id as id_category')
                                   ->where('user.id', '=', $id)
                                   ->get();

          //Intégralité des oeuvres que l'utilisateur peut échanger
          $listElements = DB::table('element')
                              ->leftJoin('category', 'element.id_category', '=', 'category.id')
                              ->select( 'element.id', 
                                        'element.name', 
                                        'element.creator as subName',
                                        'category.id as category_id',
                                        'category.name as category_name')                             
                              ->get();

          foreach ($listElements as $key => $element) {
               foreach ($exchangedElements as $key => $exchanged) {
                    if($element->id == $exchanged->id)
                         $element->is_exchanged=true;
               }
          }

		return view('user.show')
                    ->with('infos',$infos[0])
                    ->with('myAccount',$myAccount)
                    ->with('department', $listDepartments)
                    ->with('listElements', $listElements)
                    ->with('grid', $exchangedElements)
                    ->with('nbElements', 8)
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
          if(Auth::check() && Auth::id()==$id){
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
     		return redirect()->route('show_user', ['id' => $id]);
          }
	}

     /**
     * Modification des oeuvres échangées par l'utilisateur
     *
     * @param int  $id
     * @param Illuminate\Http\Request $request
     * @return view
     */
     public function updateExchange(Request $request, $id)
     {
          if(Auth::check() && Auth::id()==$id){
               $input = $request->all();
               
               //Suppression de tous les élèments échangeables de l'utilisateur
               DB::table('user_element')->where('id_user', '=', $id)->delete();

               if(isset($input['element_checked'])){
                    $listeNewExchanged = [];
                    foreach ($input['element_checked'] as $key => $element) {
                         $listeNewExchanged[] = ['id_user' => $id, 'id_element' => $element];
                    }
                    
                    //Insertion en base des nouveaux élèments selectionnés
                    DB::table('user_element')->insert($listeNewExchanged);
               }
               
               return redirect()->route('show_user', ['id' => $id]);
          }
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
                         return '/'; //Adresse de destination si Auth OK
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