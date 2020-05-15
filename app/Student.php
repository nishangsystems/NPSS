<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name','last_name','email','gender','phone','dob','address','class','section','admission_year','phone','slug','photo'
    ];

    public function result($sequence){
        return $this->hasMany('App\Result','student_id')->where('sequence', $sequence)->get();
    }

    public function classes(){
        return $this->belongsTo('App\Classes','class');
    }
}
