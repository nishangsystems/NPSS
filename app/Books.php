<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    public function subject()
    {
        return $this->belongsTo('\App\Subject','subject_id');
    }

    public function class()
    {
        return $this->belongsTo('\App\Classes','class');
    }
}
