<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentsClass extends Model
{
    protected $fillable = [
        'student_id','class_id','year_id','section_id'
    ];
}
