<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    protected $table = 'other';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    public function getHomeContent()
    {
    	return $this->where('name', 'home_content')->get();
    }
}
