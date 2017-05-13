<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatbox extends Model
{
    protected $table = 'chatbox';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * Define one-to-one relation between chatbox and its user sender
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'id_user_sender');
    }

    /**
     * Define one-to-one relation between chatbox and room
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'id_room');
    }

    public function autocompleteUser()
    {
        $term = $_GET['term'];
        $users =  DB::select(DB::raw('select * from user where first_name like '.$term));
        $array = array();

        while($name = $users->fetch()) // on effectue une boucle pour obtenir les données
        {
            array_push($array, $name['first_name']); // et on ajoute celles-ci à notre tableau
        }
        echo json_encode($array);
    }
}
