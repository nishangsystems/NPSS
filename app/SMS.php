<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    public function sender ()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

}
