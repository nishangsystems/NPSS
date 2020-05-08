<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function result($sequence){
        return $this->hasMany('App\Result','student_id')->where('sequence', $sequence)->get();
    }
}
