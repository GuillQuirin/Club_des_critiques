<?php

namespace App;

use App\User;
use App\Room;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user_asker()
    {
    	return $this->belongsTo(User::class, 'id_user_asker');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user_reported()
    {
    	return $this->belongsTo(User::class, 'id_user_reported');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function room()
    {
    	return $this->belongsTo(Room::class, 'id_room');
    }
}
