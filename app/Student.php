<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name','email','gender','phone','dob','address','class','section','admission_year','phone','slug','photo'
    ];

    public function result($year, $sequence){
        return $this->hasMany('App\Result','student_id')->where('sequence_id', $sequence)->where('year_id', $year);
    }

    public function class($year){
        return $this->belongsToMany('App\Classes','students_classes','student_id','class_id')->where('year_id',$year)->first();
    }

    public function dept($year){
        $classFee = getClassTotalFee($this->class($year)->id,$year);
        return $classFee - $this->totalPaid($year)- $this->scholarship($year);
    }

    public function totalPaid($year){
        $total = 0;
        foreach($this->feePayment()->where('year_id', $year)->get() as $payment){
            $total = $payment->amount + $total;
        }
        return $total;
    }

    public function feePayment(){
        return $this->hasMany('App\StudentFeePayment','student_id');
    }

    public function discount(){
        return $this->hasMany('App\StudentDiscount','student_id');
    }

    public function parent(){
        return $this->belongsToMany('App\User','students_guardients','student_id','parent_id')->first();
    }

    public function parents(){
        return $this->belongsToMany('App\User','students_guardients','student_id','parent_id');
    }

    public function mark($subject, $year, $sequence){
        $result = $this->result($year, $sequence)->where('subject_id', $subject)->first();
        if($result == null){
            return 0;
        }else{
            return $result->mark;
        }
    }

    public function termMark($subject, $year, $term_id){
       $total = 0;
       $term = \App\Terms::find($term_id);
       foreach($term->sequence as $sequence){
           $total = $total + $this->mark($subject, $year, $sequence->id);
       }
       return $total;
    }

    public function total($year, $sequence){
        $results = $this->result($year, $sequence)->get();
        $total = 0;
        foreach($results  as $result){
            $total = $total + $result->mark;
        }
        return $total;
    }

    public function termTotal($year, $term_id){
        $total = 0;
        $term = \App\Terms::find($term_id);
        foreach($term->sequence as $sequence){
            $total = $total + $this->total($year, $sequence->id);
        }
        return $total;
    }

    public function saveResult($year, $sequence, $subject, $mark){
       $result = $this->result($year, $sequence)->where('subject_id', $subject)->first();
       if($result != null){
           $result->mark = $mark;
           $result->save();
       }else{
           $result = \App\Result::create([
               'student_id' => $this->id,
               'year_id' => $year,
               'sequence_id' => $sequence,
               'subject_id' => $subject,
               'mark' => $mark,
               'remark' => "Passed",
               'logged_by' => \Auth::user()->id
           ]);
       }
    }

    public function scholarship($year){
        $total = 0;
        foreach($this->discount()->where('year_id', $year)->get() as $payment){
            $total = $payment->amount + $total;
        }
        return $total;
    }

    public function hasParent($parent){
        return $this->parents->contains($parent);
    }

    public function setScholarShip($request){
        $result = $this->discount()->where('year_id', getYear())->first();
        if($result != null){
            $result->amount = $request->amount;
            $result->save();
        }else{
            \App\StudentDiscount::create([
                'student_id' => $this->id,
                'amount' => $request->amount,
                'year_id' => getYear(),
            ]);
        }
    }


}
