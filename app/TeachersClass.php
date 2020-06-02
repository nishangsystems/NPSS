<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachersClass extends Model
{
    protected $fillable = [
        'teacher_id','class_id', 'year_id'
    ];
}
