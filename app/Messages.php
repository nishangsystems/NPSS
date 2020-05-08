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
     * A Message belongs to a User (recipient).
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient ()
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
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
