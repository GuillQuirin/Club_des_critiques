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
use App\Department;
use App\Element;
use App\UserElement;

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
          $listUsers = User::whereNotIn('id_status', [5,6])->get();
                                        
          //Renommage des statuts
          foreach ($listUsers as $user) {
               $user->name = (isset($user->first_name) && isset($user->last_name)) ? $user->first_name." ".$user->last_name[0]."."
                                                                                     : "Utilisateur-".$user->id;
               $user->picture = (isset($user->picture)) ? $user->picture : '/images/user.png';
               $user->subName = $user->status->label;
               $user->date = $user->date_created;
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
                                   ->select('id','code','name')
                                   ->get();

          $listDepartments = [];
          foreach ($departments as $key => $dpt)
               $listDepartments[$dpt->id] = "(".$dpt->code.") ".$dpt->name;

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
          $infos = User::find($id);
          if(isset($infos)){
               $infos->picture = ($infos->picture) ? $infos->picture : "/images/user.png";

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
                                                  'element.url_api as link',
                                                  'category.name as name_category',
                                                  'category.id_parent as id_parent',
                                                  'category.id as id_category',
                                                  DB::raw(" (SELECT AVG(user_element.mark) 
                                                                 FROM user_element 
                                                                 WHERE user_element.id_element = element.id) as mark"))
                                        ->where([
                                             ['user.id', '=', $id],
                                             ['user_element.is_exchangeable', '=', 1],
                                             ['user.is_deleted', '=', 0]
                                        ])
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
                                        //var_dump($exchangedElements);die;

     		return view('user.show')
                         ->with('infos',$infos)
                         ->with('myAccount',$myAccount)
                         ->with('department', $listDepartments)
                         ->with('grid', $exchangedElements)
                         ->with('nbElements', 8)
                         ->with(compact('popUp', $popUp));
          }
          else
               return redirect()->route('home');
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
               var_dump($e->getMessage());
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
               //var_dump($e->getMessage());
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
                                        'password' => $input['password']])){

                         $user = Auth::user();
                         $blackList = [1,5,6]; 
                         /*
                         *En attente
                         *Banni
                         *Supprimé
                         */

                         if(in_array($user->id_status, $blackList)){
                              Auth::logout();
                              return 4;
                         }
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
               $ok = false;           

               if(isset($input['new_pwd']) && trim($input['new_pwd'])!="" && trim($input['new_pwd_confirm'])!="" 
                    && trim($input['new_pwd'])==trim($input['new_pwd_confirm'])
               ){
                    //Activation - Récupération de compte
                    if(isset($input['token']) && trim($input['token'])!="") 
                         $ok = true;

                    //MaJ du mot de passe en temps réel
                    else if(isset($input['pwd']) && trim($input['pwd'])!=""){
                         if(Hash::check($input['pwd'], $user->password))
                              $ok = true;
                         else
                              return 2;
                    }
               }
               else
                    return 3;             

               if($ok)
                    $user->password = Hash::make(Input::get('new_pwd'));

               //Si l'utilisateur vient juste de créer son compte, alors on l'active une fois le mdp établi
               if($user->id_status<=1)
                    $user->id_status = 2;
               
               $user->token ="";
               $user->save();
          }
          catch(\Exception $e){
               //var_dump($e->getMessage());
               //return back()->withInput();
               return 3;
          }

          return (Auth::check()) ? '' : '/';
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
                         $user->id_status=6;
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
                    //var_dump($e->getMessage());
               }

               return redirect()->route('home');
          }
     }

     //Autocomplétion de la recherche d'une oeuvre
     public function autocompleteExchange(){
          $keyword = $_POST['term'];
          $data['response'] = 'false';
          $elements =  DB::select(DB::raw('SELECT e.name as elementName, e.id as idElement, 
                                                  c.name as categoryName, cp.name as categoryPName
                                             FROM element e
                                             LEFT OUTER JOIN category c ON c.id = e.id_category
                                             LEFT OUTER JOIN category cp ON c.id_parent = cp.id
                                             WHERE e.is_deleted = 0
                                                  AND e.id NOT IN (SELECT id_element 
                                                                 FROM user_element 
                                                                 WHERE id_user='.Auth::id().' 
                                                                      AND is_deleted=0
                                                                      AND is_exchangeable=1)
                                                  AND e.name like "%'.$keyword.'%"
                                             GROUP BY cp.name, c.name, e.name, e.id
                                             ORDER BY cp.name, c.name, e.name, e.id'));
          
          $data['message'] = array(); //Create array
          if($elements) {
               $data['response'] = 'true';
               foreach ($elements as $element) {                    
                    $data['message'][] = array(
                         'label' => $element->elementName,
                         'value' => $element->elementName,
                         'class' => 'form-control',
                         'id' => $element->idElement
                    );
               }
          }
          echo json_encode($data);
     }

     //Ajout d'une oeuvre échangeable
     public function addExchange(Request $request)
     {
          try{
               if(Auth::check()){
                    $input = $request->all();
                    
                    $element = DB::table('element')
                                   ->select('id')
                                   ->where('name', '=', $input['autocomplete_element'])
                                   ->first();

                    if($element){                         
                         $user_exchange = DB::table('user_element')
                                             ->select('id')
                                             ->where([
                                                  ['id_element','=', $element->id],
                                                  ['id_user', '=', Auth::id()],
                                             ])
                                             ->first();
                         var_dump($user_exchange);
                         if(!$user_exchange){
                              var_dump('creation');
                              DB::table('user_element')->insert([
                                                  'id_element' => $element->id, 
                                                  'id_user' => Auth::id(),
                                                  'is_exchangeable' => 1
                                             ]);
                         }
                         else{
                              var_dump('MAJ');
                              DB::table('user_element')
                                        ->where('id', $user_exchange->id)
                                        ->update(['is_exchangeable' => 1, 'is_deleted' => 0]);
                         }
                    }
               }
          }
          catch(\Exception $e){
               return $e->getMessage();
               return 3;
          }
     }

     //Affichage des oeuvres déjà échangeables
     public function loadExchange(){
          if(Auth::check()){
               try{
                    $elements =  DB::select(DB::raw('SELECT e.name as elementName, 
                                                            e.id as idElement, 
                                                            c.name as categoryName, 
                                                            cp.name as categoryPName
                                                       FROM element e
                                                       LEFT OUTER JOIN category c ON c.id = e.id_category
                                                       LEFT OUTER JOIN category cp ON c.id_parent = cp.id
                                                       WHERE e.is_deleted = 0
                                                            AND e.id IN (SELECT id_element 
                                                                           FROM user_element 
                                                                           WHERE id_user='.Auth::id().' 
                                                                                AND is_exchangeable=1
                                                                                AND is_deleted=0)
                                                       GROUP BY cp.name, c.name, e.name, e.id
                                                       ORDER BY cp.name, c.name, e.name, e.id'));
                    echo json_encode($elements);
               }
               catch(\Exception $e){
                    //var_dump($e->getMessage());
                    return 3;
               }
          }
     }

     //Retrait d'une oeuvre échangeable
     public function deleteExchange(){
          if(Auth::check()){
               $element = htmlspecialchars(addslashes($_POST['idElement']));
               try{
                    $elements =  DB::select(DB::raw('UPDATE user_element 
                                                                 SET is_deleted=1, is_exchangeable=0 
                                                                 WHERE id_element = '.$element.'
                                                                      AND id_user = '.Auth::id().' '));
               }
               catch(\Exception $e){
                    //var_dump($e->getMessage());
                    return 3;
               }
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