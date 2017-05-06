<?php

namespace App\Http\Controllers;

use App\Category;
use App\Element;
use App\Room;
use App\UserElement;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        //$subcat = SubCategory::findOrFail($element->id_sub_category);
        //$cat = Category::findOrFail($subcat->id_category);
        $mark = UserElement::where('id_element', $element->id)->where('id_user', $element->id)->first();
        $global_mark = UserElement::where('id_element', $element->id)->get();
		return view('rooms.show')
            ->with(compact('header'))
            ->with(compact('element'))
            ->with(compact('mark'))
		    ->with(compact('global_mark'));
            //->with(compact('subcat'))
            //->with(compact('cat'));
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