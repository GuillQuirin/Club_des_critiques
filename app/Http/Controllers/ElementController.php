<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Department;

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
                                        'element.url_api as link',
                                        'element.id_category',
                                        'category.name as name_category',
                                        'category.id_parent as id_parent',
                                        'category.id as id_category',
                                        'element.date_publication as date')
                            ->where('element.is_deleted', '<>', 1)
                            ->orderBy('date_publication', 'desc')
                            ->get();
        $popUp = 'element.show';

        return view('element.index')
                ->with('grid', $listElements)
                ->with('nbElements', 8)
                ->with(compact('popUp', $popUp));
	} 

    /**
     * Enregistrement de la proposition d'ajout d'une oeuvre
     *
     * @return view
     */
    public function submitProposition(Request $request)
    {
        if(Auth::check()){
            try{
                $this->validate($request, [
                   'category' => 'required',
                   'creator' => 'required',
                   'name' => 'required',
                ]);
                $input = $request->all();
                unset($input['_token']);
                $input['id_user'] = Auth::id();

                DB::table('element_suggest')->insert($input);
            }
            catch(\Exception $e){
                //var_dump($input);
                //var_dump($e->getMessage());
                return 2;
            }
            
            return 1;
        }
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
