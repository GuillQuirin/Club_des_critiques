<?php

namespace App;

use App\User;
use App\ChatBox;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    protected $table = 'warning';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * Define one-to-one relation between warning and user whistleblower
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whistleblower()
    {
    	return $this->belongsTo(User::class, 'id_whistleblower');
    }

    /**
     * Define one-to-one relation between warning and chatbox
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatbox()
    {
    	return $this->belongsTo(ChatBox::class, 'id_message');
    }
}
