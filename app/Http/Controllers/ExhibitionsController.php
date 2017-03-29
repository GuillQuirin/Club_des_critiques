<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExhibitionsController extends Controller
{
    public function index()
	{
		return view('exhibitions');
	}
}
