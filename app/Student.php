<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name','last_name','email','gender','phone','dob','address','class','section','admission_year','phone','slug','photo'
    ];

    public function result($sequence){
        return $this->hasMany('App\Result','student_id')->where('sequence', $sequence)->get();
    }

    public function class($year){
        return $this->belongsToMany('App\Classes','students_classes','student_id','class_id')->where('year_id',$year)->first();
    }

    public function dept($year){
        $total = 0;
        foreach($this->feePayment()->where('year_id', $year)->get() as $payment){
            $total = $payment->amount + $total;
        }
        $classFee = getClassTotalFee($this->class($year)->id,$year);
        return $classFee - $total;
    }

    public function feePayment(){
        return $this->hasMany('App\StudentFeePayment','student_id');
    }
}
