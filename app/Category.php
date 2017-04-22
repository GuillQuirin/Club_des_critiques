<?php

namespace App;

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
        return $this->whereNotNull('id_parent');
    }

    /**
     * Define one-to-one relation between category and its parent category
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function parent()
    {
        return $this->belongTo(Category::class, 'id_parent');
    }

    /**
     * Define one-to-many relation between category and its sub category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
       return $this->hasMany(Category::class, 'id_parent')
    }
}
