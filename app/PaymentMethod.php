<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public function feePayment(){
        return $this->hasMany('App\StudentFeePayment','method');
    }

    public function total($year){
        $total = 0;
        foreach($this->feePayment()->where('year_id', $year)->get() as $payment){
            $total = $payment->amount + $total;
        }
        return $total;
    }
}
