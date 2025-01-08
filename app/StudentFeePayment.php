<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentFeePayment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'student_id','amount','method','bursar_id','year_id','reference','type_id'
    ];

    public function student(){
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function method(){
        return $this->belongsTo('App\PaymentMethod', 'method');
    }

    public function session(){
        return $this->belongsTo('App\Session', 'year_id');
    }

    public function type(){
        return $this->belongsTo('App\FeeType', 'type_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'bursar_id');
    }

    public function deletedBy(){
        return $this->belongsTo('App\User', 'deleted_by');
    }

    public function restoredBy(){
        return $this->belongsTo('App\User', 'restored_by');
    }
}
