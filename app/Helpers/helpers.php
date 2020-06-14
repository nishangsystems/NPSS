<?php

if (!function_exists('getYear')) {
    function getYear()
    {
        return setting('current_year',"0");
    }
}

if (!function_exists('getTerm')) {
    function getTerm()
    {
        return setting('current_term',"0");
    }
}

if (!function_exists('getClassFee')) {
    function getClassFee($class, $year, $type)
    {
        $fee = \App\ClassFee::where(['year_id'=>$year, 'class_id'=>$class,'type_id'=>$type,])->get()->last();
        if($fee == null){
            return 0;
        }else{
            return $fee->amount;
        }
    }
}

if (!function_exists('getClassTotalFee')) {
    function getClassTotalFee($class, $year)
    {
        $total = 0;
       foreach(\App\FeeType::get() as $type){
           $fee = getClassFee($class,$year, $type->id);
           $total = $total + $fee;
       }
       return $total;
    }
}

if (!function_exists('getTotalScholarship')) {
    function getTotalScholarship($year)
    {
        $total = 0;
        foreach(\App\StudentDiscount::where('year_id', $year)->get() as $type){
            $total = $total + $type->amount;
        }
        return $total;
    }
}


if (!function_exists('getFeePayed')) {
    function getFeePayed( $year)
    {
        $total = 0;
        foreach(\App\StudentFeePayment::where('year_id', $year)->get() as $type){
            $total = $total + $type->amount;
        }
        return $total;
    }
}
if (!function_exists('getExpenses')) {
    function getExpenses( $year)
    {
        $total = 0;
        foreach(\App\Expenses::get() as $type){
            $total = $total + $type->amount;
        }
        return $total;
    }
}

