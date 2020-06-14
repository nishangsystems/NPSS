<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDiscount extends Model
{
    public function byLocale()
    {
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
            $this->desc = $this->desc_fr != null ? $this->desc_fr : $this->desc;
        }
        return $this;
    }

    protected $fillable = [
        'student_id','amount','year_id'
    ];

    public function student(){
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function session(){
        return $this->belongsTo('App\Session', 'year_id');
    }
}
