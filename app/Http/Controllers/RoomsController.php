<?php

namespace App\Http\Controllers;

use App\Category;
use App\Chatbox;
use App\Element;
use App\Report;
use App\Room;
use App\User;
use App\UserElement;
use App\UserRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RoomsController extends Controller
{

	/**
     * Affiche la liste de tous les salons
     *
     * @return view
     */
    public function index()
    {
        $rooms = Room::all()->sortByDesc("date_start");;
        return view('rooms.all_rooms')
            ->with(compact('rooms'));
	}

	/**
     * Affiche la liste des salons à vanir
     *
     * @param  int  $id
     * @return view
     */
	public function showFuturRooms()
	{
        $rooms = Room::where('date_start', '>', date("Y-m-d H:i:s"))->where('status', 2)->get();
        $user_room = UserRoom::where('id_user', explode(',', Auth::id()))->get();
        $user_element = UserElement::where('id_user', Auth::id())->get();
		return view('rooms.index')
            ->with(compact('rooms'))
            ->with(compact('user_room'))
            ->with(compact('user_element'));
	}

	/**
     * Affichage des salons auxquelles participe un utilisateur
     *
     * @param  int  $id
     * @return view
     */
	public function showMyRooms()
	{
        $rooms = Room::whereIn('id', function($query){
            $query->select('id_room')
                ->from('user_room')
                ->where('id_user', Auth::id());
        })->get();
        $elements = Element::whereIn('id', function($query){
            $query->select('id_element')
                ->from('user_element')
                ->where('id_user', Auth::id());
        })->get();
        $test = DB::select('SELECT element.name as element_name, 
                            element.creator, 
                            element.date_publication,
                            element.url_picture,
                            user_element.mark, 
                            room.name as room_name, 
                            room.date_start, 
                            room.date_end,
                            room.status,
                            room.number as number, 
                            room.id as id_room 
                            FROM element, user_element, room 
                            WHERE room.id_element = user_element.id_element 
                            and user_element.id_user = '.Auth::id().' 
                            and room.id_element = element.id');
		return view('rooms.my_rooms')
            ->with(compact('rooms'))
		    ->with(compact('test'));
	}

    /**
     * Récupère le prochain salon
     *
     * @param  int  $id
     * @return view
     */
    public function getFutureRoom()
    {   $now = new \DateTime();
        $nextRoom = DB::table('room')->join('element','room.id_element', '=', 'element.id')
                                    ->select(   'room.id', 
                                                'room.name as nameRoom', 
                                                'element.name as nameElement', 
                                                'room.status',
                                                'room.date_start',
                                                'room.date_end',
                                                'room.date_created')
                                        ->where('room.date_start', '>=', $now)
                                        ->orderBy('room.date_start', 'asc')
                                        ->offset(0)
                                        ->limit(1)
                                        ->get();

        return (isset($nextRoom[0])) ? json_encode($nextRoom[0]) : NULL;
    }

	/**
     * Affichage de la page d'un salon
     *
     * @param  int  $id
     * @return view
     */
	public function show($id)
	{
        $header = Room::findOrFail($id);
        $element = Element::findOrFail($header->id_element);
        $cat = Category::findOrFail($element->id_category);
        $mark = UserElement::where('id_element', $element->id)->where('id_user', Auth::id())->first();
        $global_mark = UserElement::where('id_element', $element->id)->get();
        $user_room = UserRoom::where('id_room', $header->id)->get();
        $user_blocked = UserRoom::where('id_room', $header->id)->where('status_user', 2)->get();
        foreach ($user_room as $u){
            $users[] = User::where('id', $u->id_user)->get();
        }
        $user_reported = Report::where('id_user_asker', Auth::id())->where('id_room', $id)->get();
        $chatbox = Chatbox::where('id_room', $header->id)->get();
		return view('rooms.show')
            ->with(compact('header'))
            ->with(compact('element'))
            ->with(compact('mark'))
		    ->with(compact('global_mark'))
            ->with(compact('user_room'))
            ->with(compact('users'))
            ->with(compact('chatbox'))
            ->with(compact('cat'))
            ->with(compact('user_blocked'))
            ->with(compact('user_reported'));
	}

    public function getMessage(){
        $header = Room::findOrFail($_POST['id_room']);
        
        $chatbox = Chatbox::where('id_room', $header->id)->get();
        foreach ($chatbox as $chat) {
            $message[$chat->id]['message'] =$chat->message;
            $message[$chat->id]['date'] =date("d/m/Y H:i:s", strtotime($chat->date_post));
            $message[$chat->id]['picture'] = User::where('id', $chat->id_user_sender)->first()->picture;
            $message[$chat->id]['first_name'] = User::where('id', $chat->id_user_sender)->first()->first_name;
            $message[$chat->id]['last_name'] = User::where('id', $chat->id_user_sender)->first()->last_name;
        }   
        echo json_encode($message);
    }


	/**
     * Rejoindre un salon
     *
     * @param  int  $id
     * @return view
     */
	public function join($id_room)
	{
        DB::table('user_room')->insert(
            [
                'id_user' => Auth::id(),
                'id_room' => $id_room,
                'status_user' => 1
            ]
        );
        return Redirect::route('futur_rooms');
	}

    /**
     * Rejoindre un salon
     *
     * @param  int  $id
     * @return view
     */
    public function joinBis(Request $request)
    {
        DB::table('user_element')->insert(
            [
                'id_user' => Auth::id(),
                'id_element' => $request->element,
                'mark' => $request->note,
                'is_exchangeable' => 0,
                'is_deleted' => 0
            ]
        );
        return Redirect::route('futur_rooms');
    }

	/////// ADMINISTRATION //////

	/**
     * Création d'un salon
     *
     * @return view
     */
	public function add()
	{
		# code...
	}

	/**
     * Modification d'un salon
     *
     * @param  int  $id
     * @return view
     */
	public function edit($id)
	{
		# code...
	}

	/**
     * Suppression d'un salon
     *
     * @param  int  $id
     * @return view
     */
	public function delete($id)
	{
		# code...
	}

	public function addMessage()
    {
        DB::table('chatbox')->insert(
            [
                'id_user_sender' => Auth::id(),
                'id_room' => $_POST['id_room'],
                'date_post' => date("Y-m-d H:i:s"),
                'message' => $_POST['message'],
                'status' => 1,
                'is_deleted' => 0
            ]
        );

        $user = User::where('id', Auth::id())->first();
        echo json_encode($user);
    }

    public function autocompleteUser()
    {
        $keyword = $_POST['term'];
        $data['response'] = 'false';
        $users =  User::where('first_name', 'like', '%'.$keyword.'%')->get();
        $data['message'] = array(); //Create array
        if($users) {
            $data['response'] = 'true';
            foreach ($users as $user) {
                if($user->picture){
                    $data['message'][] = array(
                        'label' => "<img src=".$user->picture." class='img-circle' style='width:40px;height:30px'/> ". $user->first_name . ' ' . $user->last_name,
                        'value' => $user->first_name .' '. $user->last_name,
                        'class' => 'form-control',
                        'id' => $user->id);
                }else {
                    $data['message'][] = array(
                        'label' => "<img src='/images/user.png' class='img-circle' style='width:40px;height:30px'/> " . $user->first_name . ' ' . $user->last_name,
                        'value' => $user->first_name . ' ' . $user->last_name,
                        'class' => 'form-control',
                        'id' => $user->id);
                }
            }
        }
        echo json_encode($data);
    }

    public function inviteUser(Request $request){
        $sender = User::where('id', Auth::id())->first();
        $receiver = User::where('id', $request->id_user )->first();
        $room = Room::where('id', $request->id_room)->first();
        $data = [
            'sender' => $sender,
            'receiver' => $receiver,
            'room' => $room
        ];
        Mail::send('emails.invite', $data, function($message) use ($receiver){
            $message->to($receiver->email);
            $message->subject('Club des critiques : un ami vous a invité à rejoindre un salon');
        });
    }

    public function reportUser(Request $request){
        DB::table('report')->insert([
            'id_user_asker' => Auth::id(),
            'id_user_reported' => $request->id_reported,
            'id_room' => $request->id_room,
            'reason' => $request->reason,
            'is_deleted' => 0
        ]);
        return Redirect::route('show_room', ['id' => $request->id_room]);
    }

    public function blockUser(Request $request){
        DB::table('user_room')
            ->where([['id_user', '=', $request->id_blocked],
            ['id_room', '=', $request->id_room]])
            ->update([
                'block_date' => date("Y-m-d H:i:s"),
                'block_by' => Auth::id(),
                'status_user' => 2
            ]);
        return Redirect::route('show_room', ['id' => $request->id_room]);
    }

    public function dispatchUser(){
        $id = 3;
        $user_element = UserElement::where('id_element', $id)->get();
        $room = Room::where('id_element', $id)->first();
        $nb_one = $nb_two = $nb_three = $nb_four = $nb_user = 0;
        //Calcul du nombre de notes différentes attribuées à l'élément
        foreach($user_element as $u){
            $nb_user ++;
            switch ($u->mark){
                case 1 : $nb_one ++; break;
                case 2 : $nb_two ++; break;
                case 3 : $nb_three ++; break;
                case 4 : $nb_four ++; break;
            }
        }

        echo "Nombre de participants : " . $nb_user . "<br>";
        echo "Note 1/4 : " . $nb_one . "<br>";
        echo "Note 2/4 : " . $nb_two . "<br>";
        echo "Note 3/4 : " . $nb_three . "<br>";
        echo "Note 4/4 : " . $nb_four . "<br>";

        //Détermine le nombre de salons nécessaires
        if($nb_user > 20){
            $nb_room = round(($nb_user / 20),0) + 1;
        }else{
            $nb_room = 1;
        }

        echo "Nombre de salon nécessaire : " . $nb_room . "<br>";

        //Détermine le nombre de users par salon
        $nb_user_room = round($nb_user / $nb_room, 0);

        //Détermine le nombre de notes par salon
        $nb_one_room = round($nb_one / $nb_room, 0);

        $nb_two_room = round($nb_two / $nb_room, 0);
        $nb_three_room = round($nb_three / $nb_room, 0);
        $nb_four_room = round($nb_four / $nb_room, 0);

        if($nb_room > 1) {
            $user_room = UserRoom::where('id_room', $room->id)->get();
            $user_with_four = UserElement::where('id_element', $id)->where('mark', 4)->whereNotIn('id_user', $user_room)->take($nb_four_room)->get();
            foreach($user_with_four as $uwf){
                DB::table('user_room')->insert([
                    'id_user' => $uwf->id_user,
                    'id_room' => $room->id,
                    'status_user' => 1
                ]);
            }
            for ($i = 1; $i <= $nb_room-1; $i++) {
                echo $room['name'] . ' - Salon ' . ($i + 1) . "<br>";
                $id_room = DB::table('room')->insert([
                    'name' => $room->name,
                    'number' => $i+2,
                    'date_start' => $room->date_start,
                    'date_end' => $room->date_end,
                    'status' => 1,
                    'id_element' => $id
                ])->lastInsertId();
                $user_room = UserRoom::where('id_room', $id_room)->get();
                if ($nb_four_room != 0) {
                    $user_with_four = UserElement::where('id_element', $id)->where('mark', 4)->whereNotIn('id_user', $user_room)->take($nb_four_room)->get();
                    foreach ($user_with_four as $u) {
                        echo "User note 4 : " . $u->id_user . "<br>";
                    }
                }
            }

            
            //Affecte les users aux rooms
            if ($nb_one_room != 0) {
                $user_with_one = UserElement::where('id_element', $id)->where('mark', 1)->get();
                foreach ($user_with_one as $u) {
                    echo "User note 1 : " . $u->id_user. "<br>";
                }
            }

            if ($nb_two_room != 0) {
                $user_with_two = UserElement::where('id_element', $id)->where('mark', 2)->get();
                foreach ($user_with_two as $u) {
                    echo "User note 2 : " . $u->id_user. "<br>";
                }
            }

            if ($nb_three_room != 0) {
                $user_with_three = UserElement::where('id_element', $id)->where('mark', 3)->get();
                foreach ($user_with_three as $u) {
                    echo "User note 3 : " . $u->id_user. "<br>";
                }
            }

            /*DB::table('user_room')->insert([
               'id_user' => ,
               'id_room' => ,
               'status' => 1
            ]);*/

        }else{
            foreach ($user_element as $ue){
                DB::table('user_room')->insert([
                    'id_user' => $ue->id_user,
                    'id_room' => $room->id,
                    'status_user' => 1
                ]);
            }
        }
    }
}