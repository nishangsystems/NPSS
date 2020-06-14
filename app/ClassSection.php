<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSection extends Model
{
    protected $fillable = [
        'class_id','name'
    ];
    public function byLocale(){
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
        }
        return $this;
    }

    public function students($year){
        return $this->belongsToMany('App\Student','students_classes','section_id','student_id')->where('students_classes.year_id', $year)->get();
    }
    public function teachers($year){
        return $this->belongsToMany('App\User','teachers_classes','class_id','teacher_id')->where('teachers_classes.year_id', $year)->get();
    }
    public function class(){
        return $this->belongsTo('App\Classes', 'class_id');
    }
    public function subjects(){
        return $this->class->subjects();
    }
}
