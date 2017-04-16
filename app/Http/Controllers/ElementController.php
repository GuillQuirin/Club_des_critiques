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
        $categories = [1 => 'Film', 2 => 'Livre', 3 => 'Exposition'];
        $subCategories = [1 => 'Fiction', 2 => 'Horreur', 3 => 'Humour'];

        $popUp = 'element.show';
        $array['items'] = [
            ['id' => 1, 'name' => 'Harry Potter', 'subname' => 'Livre', 'url_img' => '/images/oeuvre.jpg', 'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
            ['id' => 2, 'name' => 'Interstellar', 'subname' => 'Film', 'url_img' => '/images/oeuvre1.jpg', 'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
            ['id' => 3, 'name' => 'Paris Games Week', 'subname' => 'Exposition', 'url_img' => '/images/oeuvre2.jpg', 'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
            ];

		return view('element.index')
                ->with(compact('categories'))
                ->with(compact('subCategories'))
                ->with(compact('popUp'))
                ->with(compact('array'));
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
