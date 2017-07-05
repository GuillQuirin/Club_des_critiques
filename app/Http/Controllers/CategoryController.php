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
        $infoCategory = DB::table('category')
                            ->select('*')
                            ->where('id', '=', $id)
                            ->get();

        $subCategory = DB::table('category')
                            ->leftJoin('element','element.id_category','=','category.id')
                            ->selectRaw('category.id, category.name, count(element.id) as nbElement')
                            ->where('category.id_parent', '=', $id)
                            ->groupBy('category.id')
                            ->groupBy('category.name')
                            ->get();
                            //var_dump($subCategory);die;
        $listSubCategory = [];
          foreach ($subCategory as $key => $category)
               $listSubCategory[$category->id] = $category->name."(".$category->nbElement.")";

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
                            ->where('element.id_category', '=', $id)
                            ->orWhere('category.id_parent', '=', $id)
                            ->orderBy('date_publication', 'desc')
                            ->get();
        $popUp = 'element.show';

		return view('category.show')
                ->with('infoCategory', $infoCategory[0])
                ->with('listSubCategory', $listSubCategory)
                ->with('nbElements', 8)
                ->with('grid', $listElements)
                ->with(compact('popUp', $popUp));
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
                            ->whereNull('id_parent')
                            ->where('is_deleted', 0)
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
