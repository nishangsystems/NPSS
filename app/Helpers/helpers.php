<?php

use App\AnnualClass;

if (!function_exists('getYear')) {
    function getYear()
    {
        return setting('current_year',"0");
    }
}
if (!function_exists('numToWord')) {
    function numToWord($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'numToWord only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . numToWord(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . numToWord($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = numToWord($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= numToWord($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
}
if (!function_exists('getTerm')) {
    function getTerm()
    {
        return setting('current_term',"0");
    }
}
if (!function_exists('genMat')) {
    function genMat($clas, $year){
        $session = \App\Session::find($year);
        $class = \App\Classes::find($clas);
        $section = getSection($clas, $year);
        return $class->abbreviations.substr($session->name, 2,2).$section->section_id.(\App\Student::orderBy('id','DESC')->first()?(\App\Student::orderBy('id','DESC')->first()->id+1):1);
    }
}
if (!function_exists('getSection')) {
    function getSection($class, $year){
        $class = \App\Classes::find($class);
        $anualClass = $class->subClass($year)->last();
        if($anualClass == null){
            $anualClass = AnnualClass::create([
                'class_id'=>$class->id,
                'year_id'=>$year,
                'section_id'=>'A',
            ]);
        }else{
            $limit = $anualClass->class->limit;
            if($limit == $anualClass->student->count()){
                $var = $anualClass->section_id;
                $var++;
                $anualClass = AnnualClass::create([
                    'class_id'=>$class->id,
                    'year_id'=>$year,
                    'section_id'=>$var,
                ]);
            }
        }

        return $anualClass;
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

if (!function_exists('getBal')) {
    function getBal(\App\StudentFeePayment $fee, $year){
       $student = $fee->student;
       $otherFee = $student->feePayment()->where('id','<=',$fee->id)->where('year_id', $year)->get();
       $total = 0;
       foreach($otherFee as $fee){
           $total = $total + $fee->amount;
       }
       return getClassTotalFee($student->class($year)->id,$year) - $total;
    }
}

if (!function_exists('getTotalFee')) {
    function getTotalFee(){
        $total = 0;
        $fromDate = \Carbon\Carbon::now()->subWeek()->startOfWeek()->toDateString(); // or ->format(..)
        $tillDate = \Carbon\Carbon::now()->subDay()->toDateString();
        $fees = \App\StudentFeePayment::whereBetween( 'created_at', [$fromDate, $tillDate] )->get();
        foreach($fees as $fee){
            $total =  $total + $fee->amount;
        }
        return $total;
    }
}

if (!function_exists('getTotalExpenses')) {
    function getTotalExpenses(){
        $total = 0;
        $fromDate = Carbon\Carbon::now()->subWeek()->startOfWeek()->toDateString(); // or ->format(..)
        $tillDate = Carbon\Carbon::now()->subDay()->toDateString();
        $fees = \App\Expenses::whereBetween( 'created_at', [$fromDate, $tillDate] )->get();
        foreach($fees as $fee){
            $total =  $total + $fee->amount;
        }
        return $total;
    }
}

if (!function_exists('getMonthName')) {
    function getMonthName($monthNumber){
        return date("F", mktime(0, 0, 0, $monthNumber, 1));
    }
}

if (!function_exists('getTotal')) {
    function getTotal($fees){
        $total = 0;
        foreach($fees as $fee){
            $total =  $total + $fee->amount;
        }
        return $total;
    }
}

if (!function_exists('getDailyTotalFee')) {
    function getDailyTotalFee($day, $month, $year){
        $total = 0;
        $fees = \App\StudentFeePayment::whereDay('created_at', '=', $day)->whereMonth('created_at', '=', $month)->whereYear('created_at','=',$year)->get();
        foreach($fees as $fee){
            $total =  $total + $fee->amount;
        }
        return $total;
    }
}

if (!function_exists('getDailyTotalExpenses')) {
    function getDailyTotalExpenses($day, $month, $year){
        $total = 0;
        $fees = \App\Expenses::whereDay('created_at', '=', $day)->whereMonth('created_at', '=', $month)->whereYear('created_at','=',$year)->get();
        foreach($fees as $fee){
            $total =  $total + $fee->amount;
        }
        return $total;
    }
}

if (!function_exists('getMonthlyTotalExpenses')) {
    function getMonthlyTotalExpenses($month, $year){
        $total = 0;
        $fees = \App\Expenses::whereMonth('created_at', '=', $month)->whereYear('created_at','=',$year)->get();
        foreach($fees as $fee){
            $total =  $total + $fee->amount;
        }
        return $total;
    }
}

if (!function_exists('getMonthlyTotalFee')) {
    function getMonthlyTotalFee($month, $year){
        $total = 0;
        $fees = \App\StudentFeePayment::whereMonth('created_at', '=', $month)->whereYear('created_at','=',$year)->get();
        foreach($fees as $fee){
            $total =  $total + $fee->amount;
        }
        return $total;
    }
}



