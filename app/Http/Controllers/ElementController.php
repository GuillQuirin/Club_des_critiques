<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ElementController extends Controller
{
	// Liste de toutes les oeuvres
	public function index()
	{
		return view('element.index');
	} 

	// Affiche le profil d'un utilisateur
	public function show($id)
	{
		return view('element.show');
	}
}
