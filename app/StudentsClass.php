<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentsClass extends Model
{
    protected $fillable = [
        'student_id','class_id'
    ];


    public function aClass(){
        return $this->belongsTo(\App\AnnualClass::class,'class_id');
    }

    public function student(){
        return $this->belongsTo(\App\Student::class,'student_id');
    }

    public function class(){
        return $this->aClass->class??null;
    }

}
