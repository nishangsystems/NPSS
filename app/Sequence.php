<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    public function byLocale()
    {
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
        }
        return $this;

    }

    public function level()
    {
        return $this->belongsTo('\App\Terms','term_id');
    }

}
