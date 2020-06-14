<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'student_id','year_id','sequence_id','subject_id','mark','remark','logged_by'
    ];

    public function student(){
        return $this->belongsTo('App\Student', 'student_id');
    }
}
