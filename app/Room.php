<?php

namespace App;

use DB;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'room';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * Define one-to-one relation between room and element
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function element()
    {
        return $this->belongsTo(Element::class, 'id_element');
    }

    /**
     * Define one-to-many relation between room and its chatboxes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatboxes()
    {
        return $this->hasMany(Chatbox::class, 'id_room');
    }

    // Get all users which participate at the room
    public function users()
    {
        $users = DB::select('select * from user where id in (select id_user from user_room where id_room = ' . $this->id . ');');

        $users = User::hydrate($users);

        return $users;
    }
}
