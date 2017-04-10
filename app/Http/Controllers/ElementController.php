<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElementController extends Controller
{
	// Affiche la page d'une oeure
	public function show($id)
	{
		return view('element.show');
	}

	// Affiche la page de recherche d'oeuvre
	public function search()
	{
		return view('element.search');
	}
}
