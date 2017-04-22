<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserElement extends Model
{
    protected $table = 'user_element';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * Define one-to-one relation between user_element and element
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function element()
    {
    	return $this->belongsTo(Element::class, 'id_element');
    }

    /**
     * Define one-to-one relation between user_element and user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo(Element::class, 'id_user');
    }
}
