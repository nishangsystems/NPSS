<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassFee extends Model
{
    protected $fillable = [
        'class_id','type_id','amount','year_id'
    ];
}
