<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
   public function subjects(){
        return $this->hasMany('\App\Subject','section_id');
   }

    public function byLocale()
    {
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
        }
        return $this;
    }

    public function class(){
        return $this->hasMany('\App\Classes','section_id');
    }
}
