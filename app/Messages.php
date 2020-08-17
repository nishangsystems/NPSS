<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public function sender ()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }


    /**
     * Returns whether a message has been read by a recipient
     *
     * @return boolean
     */
    public function read ()
    {
        return $this->read();
    }
}
