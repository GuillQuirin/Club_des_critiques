<?php

namespace App\Http\Controllers;


use DB;
use App\Other;
use App\Element;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
	/**
     * Affiche la page d'administration
     *
     * @return view
     */
    public function index()
    {
        $concept = DB::table('other')->where('name', 'home_concept')->first();
        $categories = Category::whereNull('id_parent')->get();
        $topElements = Element::where('is_new', 1)->get();

    	return view('admin.index', compact('concept', 'categories', 'topElements'));
    }

    /**
     * Modification du concept du site
     *
     * @return view
     */
    public function editConcept(Request $request)
    {
        $line = Other::where('name', 'home_concept')->first();
        $line->value = $request->home_concept;
        $line->save();

        $response = array(
            'status' => 'success',
            'msg' => 'Setting created successfully',
        );

        return redirect(route('admin'));
    }

    /**
     * Ajout d'un élémente à la une (en page d'accueil)
     *
     * @return view
     */
    public function addTopElement(Request $request)
    {
        $element = Element::find($request->top_element);
        $element->is_new = 1;
        $element->save();

        return redirect(route('admin'));
    }

    /**
     * Supprimer un élémente à la une (en page d'accueil)
     *
     * @return view
     */
    public function deleteTopElement()
    {
        $elementId = Input::get('elementId');
        $element = Element::find($elementId);
        // $element->is_new = 0;
        $element->save();

        // return Response::json(array_pluck($elements, 'attributes'));
    }
}
