<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    public function byLocale()
    {
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
        }
        return $this;

    }

    public function sequence(){
        return $this->hasMany('App\Sequence','term_id');
    }
}
