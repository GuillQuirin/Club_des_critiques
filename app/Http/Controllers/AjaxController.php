<?php

namespace App\Http\Controllers;

use Response;
use App\User;
use App\Room;
use App\Element;
use App\Category;
use App\UserRoom;
use App\Report;

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

        $creators =  DB::select(DB::raw('SELECT creator 
                                            FROM element 
                                            WHERE id_category = ' . $subCatId . ' 
                                            GROUP BY creator'));

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
     * Ajax Request : get all elements for a given sub category
     * @return mixed
     */
    public function getElementForCategory()
    {
        $subCatId = Input::get('subCatId');

        $elements =  Element::where('id_category', $subCatId)->get();

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
        $id_cat="";
        $order="asc";

        foreach ($input as $key => $value){
            if($key=='id_category')
              $id_cat = $value;
            elseif($key=='order')
              $order = ($value=='0') ? 'asc' : 'desc';
            else
              $filter[] = ["element.".$key, 'like', '%'.$value.'%'];
        }

        $listElements = DB::table('element')
                            ->leftJoin('category', 'element.id_category', '=', 'category.id')
                            ->select(   'element.id', 
                                        'element.name', 
                                        'element.description', 
                                        'element.creator as subName',
                                        'element.id_category',
                                        'element.url_picture as picture',
                                        'category.name as name_category')
                            ->where($filter)
                            ->where(function($query) use($id_cat){
                                if($id_cat!="")
                                    $query->where('category.id', 'like', $id_cat)
                                        ->orWhere('category.id_parent', 'like',$id_cat);
                            })
                            ->orderBy('date_publication',$order)
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
            $filter[] = ["user.".$key, 'like', '%'.$value.'%'];

        $listUsers = User::where($filter)->get();

        //Renommage avec des alias
        foreach ($listUsers as $user) {
            $user->name = $user->first_name;
            $user->subName = $user->status->label;
            $user->redirection = 'show_user';     
        }
        return json_encode($listUsers);
     }

    /**
     * Ajax Request : get element by id
     * @return mixed
     */
    public function getElementById()
    {
        $elementId = Input::get('elementId');

        $element = Element::find($elementId);
        $cat = $element->category->parent->id;

        return Response::json(['element' => $element, 'category' => $cat]);
    }

    /**
     * Ajax Request : get user by id
     * @return mixed
     */
    public function getUserById()
    {
        $userId = Input::get('userId');
        $user = User::find($userId);

        return Response::json($user);
    }
    /**
     * Ajax Request : get room by id
     * @return mixed
     */
    public function getRoomById()
    {
        $roomId = Input::get('roomId');
        $room = Room::find($roomId);
        $subCat = $room->element->category->id;
        $cat = $room->element->category->parent->id;

        return Response::json(['room' => $room, 'subCat' => $subCat, 'catgory' => $cat]);

    }

    /**
     * Ajax Request : get users for a room
     * @return mixed
     */
    public function getUsersForRoom()
    {
        $roomId = Input::get('roomId');
        $room = Room::find($roomId);
        $users = $room->users();

        return Response::json($users);
    }

    /**
     * Ajax Request : ban a user from a room
     * @return mixed
     */
    public function banUserFromRoom()
    {
        $roomId = Input::get('roomId');
        $userid = Input::get('userId');

        $user_room = UserRoom::where('id_user', $userid)->where('id_room', $roomId)->first();
        $user_room->status_user = 0;
        $user_room->save();

        return Response::json($user_room);;
    }

    /**
     * Ajax Request : ban a user from a room
     * @return mixed
     */
    public function banUserRoom()
    {
        $reportId = Input::get('reportId');

        $report = Report::find($reportId);
        $report->status = 1;
        $report->save();
        
        $user_room = UserRoom::where('id_user', $report->id_user_reported)->where('id_room', $report->id_room)->first();
        $user_room->status_user = 0;
        $user_room->save();

        return Response::json($user_room);
    }

    /**
     * Ajax Request : refuse to ban a user from a room
     * @return mixed
     */
    public function refuseBanUserRoo()
    {
        $reportId = Input::get('reportId');

        $report = Report::find($reportId);
        $report->status = 2;
        $report->save();

        return Response::json($user_room);
    }
}