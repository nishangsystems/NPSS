<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = [
        'user_id','amount','date','motive','status','expense_id'
    ];

    public function user() {

        return $this->belongsTo(User::class,'user_id');
    }

    public function category() {

        return $this->belongsTo(ExpenceType::class,'expense_id');
    }
}
