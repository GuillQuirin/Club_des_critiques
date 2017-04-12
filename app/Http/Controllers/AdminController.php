<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	/**
     * Affiche la page d'administration
     *
     * @return view
     */
    public function index()
    {
    	return view('admin.index');
    }

    /**
     * Modification du concept du site
     *
     * @return view
     */
    public function editConcept()
    {
    	# code...
    }

    /**
     * Modification des éléments qui sont à la une (en page d'accueil)
     *
     * @return view
     */
    public function editTopElement()
    {
    	# code...
    }
}
