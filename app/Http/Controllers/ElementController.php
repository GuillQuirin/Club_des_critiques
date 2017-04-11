<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ElementController extends Controller
{
	/**
     * Affiche la liste de toutes les oeuvres
     *
     * @return view
     */
	public function index()
	{
		return view('element.index');
	} 


	/** 
	 * @todo à supprimse (-> pop up)
     * Affiche la page d'un élément
     *
     * @param  int  $id
     * @return view
     */
	public function show($id)
	{
		return view('element.show');
	}


	/////// ADMINISTRATION ///////

	/**
     * Ajout d'un nouvel élément
     *
     * @return view
     */
    public function add()
    {
    	# code...
    }

    /**
     * Modification d'un élément
     *
     * @param  int  $id
     * @return view
     */
    public function edit($id)
    {
    	# code...
    }

    /**
     * Suppression d'un élément
     *
     * @param  int  $id
     * @return view
     */
    public function delete($id)
    {
    	# code...
    }
}
