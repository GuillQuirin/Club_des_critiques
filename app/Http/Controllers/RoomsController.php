<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoomsController extends Controller
{

	// Liste de tous les salons
    public function index()
    {
		return view('rooms.index');
	}

	// Liste des salons à vanir
	public function showFuturRooms()
	{
		return view('rooms.index');
	}

	// Mes salons
	public function showMyRooms()
	{
		return view('rooms.my_rooms');
	}

	// Affiche la page d'un salon
	public function show($id)
	{
		return view('rooms.show');
	}

	// Rejoindre un salon
	public function join($id)
	{
		return view('rooms.index');
	}
}