<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvitationRoom extends Model
{
    protected $table = 'invitation_room';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';
}
