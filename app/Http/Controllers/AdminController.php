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
        $elements = Element::where('is_deleted', false)->get();        
        $allCategories = Category::where('is_deleted', false)->get();
        $categories = Category::whereNull('id_parent')->where('is_deleted', false)->get();
        $topElements = Element::where('is_new', 1)->where('is_deleted', false)->get();

    	return view('admin.index', compact('concept', 'elements', 'allCategories', 'categories', 'topElements'));
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
        $element->is_new = 0;
        $element->save();
    }
    
    /**
     * Ajout d'une catégorie
     *
     * @return view
     */
    public function addCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->url_picture = $request->url_picture;
        if ($request->parent_category == 0) {
            $category->id_parent = NULL;
        } else {
            $category->id_parent = $request->parent_category;
        }
        
        $category->save();

        return redirect(route('admin'));
    }

    /**
     * Modification d'une catégorie
     *
     * @return view
     */
    public function editCategory(Request $request)
    {
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->url_picture = $request->url_picture;
        if ($request->parent_category == 0) {
            $category->id_parent = NULL;
        } else {
            $category->id_parent = $request->parent_category;
        }
        
        $category->save();

        return redirect(route('admin'));
    }

    /**
     * Supprimer une catégorie
     *
     * @return view
     */
    public function deleteCategory()
    {
        $categoryId = Input::get('categoryId');
        $category = Category::find($categoryId);
        $category->is_deleted = 1;
        $category->save();
    }

    /**
     * Supprimer une oeuvre
     *
     * @return view
     */
    public function deleteElement()
    {
        $elementId = Input::get('elementId');
        $element = Element::find($elementId);
        $element->is_deleted = 1;
        $element->save();
    }
}
