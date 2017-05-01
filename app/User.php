<?php

namespace App;

use DB; 
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    protected $fillable = [
        'first_name',
        'last_name',
        'description',
        'picture',
        'location',
        'email',
        'status',
        'password',
        'token',
    ];
 
    public $timestamps = true;

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
    	$elements =  DB::select(DB::raw('SELECT * FROM element 
                                                    WHERE id = (SELECT id_element 
                                                                FROM user_element 
                                                                WHERE  is_exchangeable = 1
                                                                    AND id_user = ' . $this->id . ')'));
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
    	$rooms = DB::select('SELECT * FROM room 
                                        WHERE id = (SELECT id_room 
                                                        FROM user_room 
                                                        WHERE id_user = ' . $this->id . ')');
        $rooms = Element::hydrate($rooms);

        return $rooms;
    }


    public function getEmailAttribute($value){return $value;}
    public function getTokenAttribute($value){return $value;}

    public function setEmailAttribute($value){$this->attributes['email'] = $value;}
    public function setTokenAttribute($value){$this->attributes['token'] = $value;}
}
