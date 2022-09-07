<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnualClass extends Model
{
    protected $fillable = [
        'class_id','year_id','section_id'
    ];
    public function class(){
        return $this->belongsTo(\App\Classes::class,'class_id');
    }

    public function student(){
        return $this->belongsToMany('App\Student','students_classes','class_id','student_id');

    }

    public function teacher(){
        return $this->belongsToMany('App\User','teachers_classes','class_id','teacher_id');

    }
}
