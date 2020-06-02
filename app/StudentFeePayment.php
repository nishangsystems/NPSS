<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFeePayment extends Model
{

    protected $fillable = [
        'student_id','amount','method','bursar_id','year_id','reference','type_id'
    ];

    public function student(){
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function session(){
        return $this->belongsTo('App\Session', 'year_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'bursar_id');
    }
}
