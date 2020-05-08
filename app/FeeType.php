<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    public function byLocale()
    {
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
            $this->desc = $this->desc_fr != null ? $this->desc_fr : $this->desc;
        }
        return $this;
    }
}
