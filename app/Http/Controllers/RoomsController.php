<?php

namespace App\Http\Controllers;

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
		return view('rooms.show');
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