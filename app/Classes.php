<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model{
    public function byLocale(){
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
        }
        return $this;
    }

    public function subjects(){
        return $this->section->subjects;
    }

    public function student(){
        return $this->belongsToMany('App\Student','students_classes','class_id','student_id');
    }

    public function students($year){
        return $this->student()->where('students_classes.year_id', $year)->get();
    }

    public function teacher(){
        return $this->belongsToMany('App\User','teachers_classes','class_id','teacher_id');
    }

    public function teachers($year){
        return $this->teacher()->where('teachers_classes.year_id', $year)->get();
    }

    public function section(){
        return $this->belongsTo('App\Section', 'section_id');
    }

    public function addTeacher($teacher_id){
        $teacher_class = \App\TeachersClass::create([
            'teacher_id'=>$teacher_id,
            'class_id'=>$this->id,
            'year_id'=>getYear()
        ]);
    }

    public function removeTeacher($teacher_id){
        $teacher_class = \App\TeachersClass::where([
            'teacher_id'=>$teacher_id,
            'class_id'=>$this->id,
            'year_id'=>getYear()
        ])->first();

        if($teacher_class != null){
            $teacher_class->delete();
        }
    }

    public function setFee($amount, $type){
        $fee = \App\ClassFee::where(['year_id'=>getYear(), 'class_id'=>$this->id, 'type_id'=>$type])->get()->last();
        if($fee == null){
            ClassFee::create([
                'year_id'=>getYear(),
                'class_id'=>$this->id,
                'type_id'=>$type,
                'amount'=>$amount
            ]);
        }else{
            $fee->amount = $amount;
            $fee->save();
        }
    }

    public function subClass(){
        return $this->hasMany('\App\ClassSection','class_id');
    }
}
