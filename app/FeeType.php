<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    protected $fillable = [
        'name'
    ];
    public function byLocale()
    {
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
            $this->desc = $this->desc_fr != null ? $this->desc_fr : $this->desc;
        }
        return $this;
    }

    public function feePayment(){
        return $this->hasMany('App\StudentFeePayment','type_id');
    }

    public function total($year){
        $total = 0;
        foreach($this->feePayment()->where('year_id', $year)->get() as $payment){
            $total = $payment->amount + $total;
        }
        return $total;
    }
}
