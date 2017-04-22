<?php

namespace App;

use DB; 
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * Define one-to-many relation between user and its userElements
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userElements()
    {
    	return $this->hasMany(UserElement::class, 'id_user');
    }

    // Get all elements shared by the user
    public function elementShared()
    {
    	$elements =  DB::select(DB::raw('select * from element where id = (select id_element from user_element where id_user = ' . $this->id . ' and is_exchangeable = 1)'));

        // Array to Model
        $elements = Element::hydrate($elements);

        return $elements;
    }

    /**
     * Define one-to-one relation between user and warnings that he report
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function warningReported()
    {
    	return $this->hasOne(Warning::class, 'id_whistleblower');
    }

    // Get all rooms in which the user participates
    // A UTILISER COMME CA : $user->rooms() (et non $user->rooms)
    public function rooms()
    {
    	$rooms = DB::select('select * from room where id = (select id_room from user_room where id_user = ' . $this->id . ')');

        $rooms = Element::hydrate($rooms);

        return $rooms;
    }

}
