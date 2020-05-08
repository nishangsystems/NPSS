<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model{
    public function byLocale(){
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
        }
        return $this;
    }
}
