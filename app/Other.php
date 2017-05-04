<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    protected $table = 'other';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    public function homeContent()
    {
    	$home_content = DB::table('other')->where('name', 'home_content')->get();

        return $home_content;
    	//return $this->where('name', 'home_content')->get();
    }
}
