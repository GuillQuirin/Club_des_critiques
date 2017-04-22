<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoom extends Model
{
    protected $table = 'user_room';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * Define one-to-one relation between user_element and room
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
    	return $this->belongsTo(Room::class, 'id_room');
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
