<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentsGuardient extends Model
{
    protected $fillable = [
        'student_id','parent_id'
    ];
}
