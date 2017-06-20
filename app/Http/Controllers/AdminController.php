<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use App\User;
use App\Room;
use App\Other;
use App\Report;
use App\Footer;
use App\Status;
use App\Element;
use App\Category;
use App\Department;
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
        $allUsers = User::all();
        $categories = Category::whereNull('id_parent')->where('is_deleted', false)->get();
        $topElements = Element::where('is_new', 1)->where('is_deleted', false)->get();
        $departments = Department::all();
        $status = Status::all();
        $footers = Footer::all();
        $rooms = Room::all();
        $bans = Report::where('is_deleted', false)->get();

    	return view('admin.index', compact('concept', 'elements', 'allCategories', 'allUsers', 'categories', 'topElements', 'departments', 'status', 'footers', 'rooms', 'bans'));
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
     * Ajout d'une oeuvre
     *
     * @return view
     */
    public function addElement(Request $request)
    {
        $element = new Element();

        if(isset($request->url_api)){
            // VIA API
            $urlApi = $request->url_api;
        } else {
            $element->name = $request->name;
            $element->creator = $request->creator;
            $element->id_category = $request->sub_category;
            $element->description = $request->description;
            if(isset($request->url_picture)){ $element->url_picture = $request->url_picture; }
            if(isset($request->date_publication)){ $element->date_publication = $request->date_publication; }
            if(isset($request->date_start)){ $element->date_start = $request->date_start; }
            if(isset($request->date_end)){ $element->date_end = $request->date_end; }
            if(isset($request->location)){ $element->location = $request->location; }
        }
        
        $element->save();

        return redirect(route('admin'));
    }

    /**
     * Modification d'une oeuvre
     *
     * @return view
     */
    public function editElement(Request $request)
    {
        $element = Element::find($request->id);
        $element->name = $request->name;
        $element->creator = $request->creator;
        $element->id_category = $request->sub_category;
        $element->description = $request->description;
        if(isset($request->url_picture)){ $element->url_picture = $request->url_picture; }
        if(isset($request->date_publication)){ $element->date_publication = $request->date_publication; }
        if(isset($request->date_start)){ $element->date_start = $request->date_start; }
        if(isset($request->date_end)){ $element->date_end = $request->date_end; }
        if(isset($request->location)){ $element->location = $request->location; }
    
        $element->save();

        return redirect(route('admin'));
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

    /**
     * Ajout d'un utilisateur
     *
     * @return view
     */
    public function addUser(Request $request)
    {
        $user = new User();
        
        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->id_department = $request->department;
        $user->email = $request->email;
        $user->id_status = $request->status;
        if(isset($request->picture)){ $user->picture = $request->picture; }
        if(isset($request->description)){ $user->description = $request->description; }
        
        $user->save();

        return redirect(route('admin'));
    }

    /**
     * Modification d'un utilisateur
     *
     * @return view
     */
    public function editUser(Request $request)
    {
        $user = User::find($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->id_department = $request->department;
        $user->email = $request->email;
        $user->id_status = $request->status;
        if(isset($request->picture)){ $user->picture = $request->picture; }
        if(isset($request->description)){ $user->description = $request->description; }
    
        $user->save();

        return redirect(route('admin'));
    }


    // SUPPRESSION USER

    /**
     * Ajout d'un lien dans le footer
     *
     * @return view
     */
    public function addFooter(Request $request)
    {
        $footer = new Footer();
        $footer->label = $request->label;
        $footer->route = $request->route;

        $footer->save();

        return redirect(route('admin'));
    }

    /**
     * Modification d'un lien dans le footer
     *
     * @return view
     */
    public function editFooter(Request $request)
    {
        $footer = Footer::find($request->id);

        $footer->label = $request->label;
        $footer->route = $request->route;

        $footer->save();

        return redirect(route('admin'));
    }

    /**
     * Suppression d'un lien dans le footer
     *
     * @return view
     */
    public function deleteFooter()
    {
        $footerId = Input::get('footerId');
        $footer = Footer::find($footerId);
        $footer->delete();

        return redirect(route('admin'));
    }

    /**
     * Ajout d'un salon
     *
     * @return view
     */
    public function addRoom(Request $request)
    {
        $room = new Room();
        $room->name = $request->name;
        $room->date_start = $request->date_start;
        $room->date_end = $request->date_end;
        $room->status = $request->status;
        $room->id_element = $request->element;

        $room->save();

        return redirect(route('admin'));
    }

    /**
     * Modification d'un salon
     *
     * @return view
     */
    public function editRoom(Request $request)
    {
        $room = Room::find($request->id);
        
        $room->name = $request->name;
        $room->date_start = $request->date_start;
        $room->date_end = $request->date_end;
        $room->status = $request->status;
        $room->id_element = $request->element;

        $room->save();

        return redirect(route('admin'));
    }
}
