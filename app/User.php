<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

}
