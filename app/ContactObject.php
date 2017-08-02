<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactObject extends Model
{
    protected $table = 'contact_object';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';
}
