<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * Define one-to-many relation between category and element
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elements()
    {
        return $this->hasMany(Element::class, 'id_category');
    }

    public function isSubCategory()
    {
        $bool = true;
        $response = DB::table('category')->select('id_parent')->where('id', $this->id)->first();

        if($response->id_parent == null){
            $bool = false;
        }

        return $bool;
    }

    /**
     * Define one-to-one relation between category and its parent category
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'id_parent');
    }

    /**
     * Define one-to-many relation between category and its sub category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
       return $this->hasMany(Category::class, 'id_parent');
    }
}
