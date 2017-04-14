<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	/**
     * Affiche la liste de tous les utilisateurs
     *
     * @return view
     */
     public function index()
     {
          $array['redirect'] = 'show_user';
          $array['items'] = [
                    ['id' => 1, 'name' => 'Guillaume', 'subname' => 'Quirin', 'url_img' => '/images/oeuvre.jpg'],
                    ['id' => 2, 'name' => 'Elise', 'subname' => 'Poirier', 'url_img' => '/images/oeuvre1.jpg'],
                    ['id' => 3, 'name' => 'Laurie', 'subname' => 'Guibert', 'url_img' => '/images/oeuvre2.jpg'],
               ];
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
		return view('user.show');
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
		return view('user.show');
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
		# code...
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
     * Modification d'un utilisation
     *
     * @param  int  $id
     * @return view
     */
	public function edit($id)
	{
		# code...
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