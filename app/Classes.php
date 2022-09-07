<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ID;

class Classes extends Model{

    protected $fillable = [
        'name','section_id','limit','abbreviations'
    ];

    public function byLocale(){
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
        }
        return $this;
    }

    public function subjects(){
        return $this->section->subjects;
    }


    public function students($year){
       
        $students = Student::
        join('students_classes', ['students.id'=>'students_classes.student_id'])
        ->join('annual_classes', ['students_classes.class_id'=>'annual_classes.id'])
        ->whereIn('annual_classes.id',$this->getId($this->subClass($year)))
        ->get();
        return $students;
    }

    public function getId($items){
        $classes = [];
        foreach($items as $item){
            array_push($classes , $item->id );
        }
        return $classes;
    }

    public function teacher(){
        return $this->belongsToMany('App\User','teachers_classes','class_id','teacher_id');
    }

    public function parent(){
        return $this->belongsTo('App\Classes','next_class');
    }


    public function teachers($year){
        return $this->teacher->where('teachers_classes.year_id', $year)->get();
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

    public function subClass($year){
        return $this->hasMany('\App\AnnualClass','class_id')->where('year_id', $year)->get();
    }
}
