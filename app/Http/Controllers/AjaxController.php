<?php

namespace App\Http\Controllers;

use Response;
use App\Element;
use App\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AjaxController extends Controller
{
	/**
     * Ajax Request : get all sub categories for a given category
     * @return mixed
     */
    public function getSubCategories()
    {
        $categoryId = Input::get('categoryId');
        $subCategories = Category::where('id_parent', $categoryId)->get();

        return Response::json(array_pluck($subCategories, 'attributes'));
    }

    /**
     * Ajax Request : get all creator for a given sub category
     * @return mixed
     */
    public function getCreatorForSubCat()
    {
        $subCatId = Input::get('subCatId');

        $creators =  DB::select(DB::raw('SELECT creator FROM element WHERE id_category = ' . $subCatId . ' GROUP BY creator'));

        return Response::json($creators);
    }
    
    /**
     * Ajax Request : get all elements for a given creator and sub category
     * @return mixed
     */
    public function getElementForCreatorAndCategory()
    {
        $subCatId = Input::get('subCatId');
        $creator = Input::get('creator');

        $elements =  Element::where('creator', $creator)->where('id_category', $subCatId)->get();

        return Response::json(array_pluck($elements, 'attributes'));
    }

    public function autocompleteUser()
    {
        $term = $_GET['term'];
        $users =  DB::select(DB::raw('select * from user where first_name like '.$term));
        $array = array();

        while($name = $users->fetch())
        {
            array_push($array, $name['first_name']);
        }
        echo json_encode($array);
    }
}