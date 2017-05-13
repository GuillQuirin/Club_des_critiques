<?php

namespace App\Http\Controllers;

use App\Category;
use App\Chatbox;
use App\Element;
use App\Room;
use App\User;
use App\UserElement;
use App\UserRoom;

class RoomsController extends Controller
{

	/**
     * Affiche la liste de tous les salons
     *
     * @return view
     */
    public function index()
    {
		return view('rooms.index');
	}

	/**
     * Affiche la liste des salons à vanir
     *
     * @param  int  $id
     * @return view
     */
	public function showFuturRooms()
	{
		return view('rooms.index');
	}

	/**
     * Affichage des salons auxquelles participe un utilisateur
     *
     * @param  int  $id
     * @return view
     */
	public function showMyRooms()
	{
		return view('rooms.my_rooms');
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
        $mark = UserElement::where('id_element', $element->id)->where('id_user', $element->id)->first();
        $global_mark = UserElement::where('id_element', $element->id)->get();
        $user_room = UserRoom::where('id_room', $header->id)->get();
        foreach ($user_room as $u){
            $users[] = User::where('id', $u->id_user)->get();
        }
        $chatbox = Chatbox::where('id_room', $header->id)->get();
        //$user_chatbox = User::where('id', $chatbox->id_user_sender);
		return view('rooms.show')
            ->with(compact('header'))
            ->with(compact('element'))
            ->with(compact('mark'))
		    ->with(compact('global_mark'))
            ->with(compact('user_room'))
            ->with(compact('users'))
            ->with(compact('chatbox'))
            ->with(compact('cat'));
	}

	/**
     * Rejoindre un salon
     *
     * @param  int  $id
     * @return view
     */
	public function join($id)
	{
		return view('rooms.index');
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
}