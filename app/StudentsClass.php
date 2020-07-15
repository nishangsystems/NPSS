<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentsClass extends Model
{
    protected $fillable = [
        'student_id','class_id','year_id','section_id'
    ];

    public function students($year){
        $student =  \App\Classes::find($this->class_id)->student($year)
            ->where('students_classes.section_id', $this->section_id)
            ->where('students_classes.year_id', $year);
    }

    public function teachers($year){
        $student =  \App\Classes::find($this->class_id)->student($year)
            ->where('teachers_classes.class_id', $this->section_id)
            ->where('teachers_classes.year_id', $year);
    }

    public function class(){
        return $this->belongsTo(\App\Classes::class,'class_id');
    }
}
