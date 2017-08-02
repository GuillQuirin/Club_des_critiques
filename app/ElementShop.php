<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElementShop extends Model
{
    protected $table = 'element_shop';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * Define one-to-one relation between element_shop and element
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function element()
    {
        return $this->belongsTo(Element::class, 'id_element');
    }
}
