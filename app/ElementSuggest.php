<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElementSuggest extends Model
{
    protected $table = 'element_suggest';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * Define one-to-one relation between element_suggest and user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
