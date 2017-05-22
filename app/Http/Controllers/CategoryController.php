<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

	public function index()
	{
		return view('category.index');
	}

	/**
     * Affiche la liste des éléments d'une catégorie
     *
     * @param  int  $id
     * @return view
     */
	public function show($id)
	{
		return view('category.show');
	}

    /** 
     * Affiche la liste des catégories des éléments
     *
     * @param  int  $id
     * @return view
     */
    public function listCategory()
    {
        $listCategory = DB::table('category')
                            ->select(   'id',
                                        'name')
                            //->whereNull('id_parent')
                            ->get();
        return json_encode($listCategory);
    }


	/////// ADMINISTRATION //////

	/**
     * Ajout d'une nouvelle catégorie
     *
     * @return view
     */
    public function add()
    {
    	# code...
    }

    /**
     *  Modification d'une catégorie
     *
     * @param  int  $id
     * @return view
     */
    public function edit($id)
    {
    	# code...
    }

    /**
     * Suppression d'une catégorie
     *
     * @param  int  $id
     * @return view
     */
    public function delete($id)
    {
    	# code...
    }
}
