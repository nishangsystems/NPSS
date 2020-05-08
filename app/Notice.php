<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model{
     public  function  byLocale(){
         if (\App::getLocale() == "fr") {
             $this->title = $this->title_fr != null ? $this->title_fr : $this->title;
             $this->content = $this-content_fr != null ? $this->content_fr : $this->content;
         }
         return $this;
     }
}
