<?php

if (!function_exists('getYear')) {
    function getYear()
    {
        return setting('current_year',"0");
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
