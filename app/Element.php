<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $table = 'element';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * belongsTo -> clé étrangère dans la table element (!= haseOne clé primaine dans a table étrangère)
     * Define one-to-one relation between element and category
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shop()
    {
    	return $this->hasOne(ElementShop::class, 'id_element');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userElement()
    {
    	return $this->hasMany(UserElement::class, 'id_element');
    }

    // Get all user who share this element
    public function userShare()
    {
        $users =  DB::select(DB::raw('select * from user where id = (select id_user from user_element where id_element = ' . $this->id . ' and is_exchangeable = 1)'));

        // Array to Model
        $users = Element::hydrate($users);

        return $users;
    }
}
