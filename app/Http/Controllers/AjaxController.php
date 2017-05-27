<?php

namespace App\Http\Controllers;

use Response;
use App\Element;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;


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

    /**
     * Filtrage de la liste des oeuvres
     *
     * @param  int  $id
     * @return view
     */
    public function getElementsBy(Request $request)
    {
        $input = $request->all();
        $filter = [];
        foreach ($input as $key => $value)
            $filter[] = [$key, 'like', '%'.$value.'%'];

        $listElements = DB::table('element')
                            ->leftJoin('category', 'element.id_category', '=', 'category.id')
                            ->select(   'element.id', 
                                        'element.name', 
                                        'element.creator as subName',
                                        'element.id_category',
                                        'category.name as name_category')
                            ->where($filter)
                            ->get();


        return json_encode($listElements);
    }

    /**
     * Filtrage de la liste des utilisateurs
     *
     */
     public function getUsersBy(Request $request)
     {
        $input = $request->all();
        $filter = [];
        foreach ($input as $key => $value)
            $filter[] = [$key, 'like', '%'.$value.'%'];

        $listUsers = DB::table('user')
                        ->select( 'user.id', 
                                  'user.first_name as name',
                                  'user.status as subName',
                                  'user.description',
                                  'user.picture',
                                  'user.location')
                        ->where($filter)
                        ->get();

        //Renommage des statuts
        foreach ($listUsers as $user) {
            switch ($user->subName) {
                    case '2':
                        $user->subName="Administrateur";
                        break;
           
                    case '1':
                        $user->subName="Membre";
                        break;

                    case '-1':
                        $user->subName="Membre banni";
                        break;

                    default:
                        $user->subName="Membre";
                        break;
            }
            $user->redirection = 'show_user';     
        }
        return json_encode($listUsers);
     }
}