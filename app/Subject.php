<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model{
    public function byLocale()
    {
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
        }
        return $this;
    }

    public function classR(){
        return $this->belongsTo('\App\Classes','class_id');
    }
}
