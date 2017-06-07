<?php

namespace App\Http\Controllers;

use DB;
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
        $listElements = DB::table('element')
                            ->leftJoin('category', 'element.id_category', '=', 'category.id')
                            ->select(   'element.id',
                                        'element.name',
                                        'element.creator as subName',
                                        'element.description',
                                        'element.url_picture as picture',
                                        'element.id_category',
                                        'category.name as name_category',
                                        'category.id_parent as id_parent',
                                        'category.id as id_category',
                                        'element.date_publication as date')
                            
                            ->orderBy('date_publication', 'desc')
                            ->get();
        $popUp = 'element.show';

        return view('element.index')
                ->with('grid', $listElements)
                ->with('nbElements', 8)
                ->with(compact('popUp', $popUp));
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
