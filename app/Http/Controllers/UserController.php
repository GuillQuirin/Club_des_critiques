<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

	// Liste de tous les utilisateurs
    public function index()
    {
		return view('user.index');
	}

	// Affiche le profil d'un utilisateur
	public function show($id)
	{
		return view('user.show');
	}

	// Modifie ses info personnelles
	public function updateInfo(Request $request, $id)
	{
		return view('user.show');
	}

	// Modifie son mot de passe
	public function updatePassword(Request $request, $id)
	{
		return view('user.show');
	}

	// Contacter un utilisateur
}