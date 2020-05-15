<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = [
        'user_id','amount','date','motive','status'
    ];

    public function user() {

        return $this->belongsTo(User::class,'user_id');
    }
}
