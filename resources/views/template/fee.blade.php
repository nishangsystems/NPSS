
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Receipt</title>
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/template.css">
</head>

<body onload="window.print();">

<div class="receipt">
    <div class="mainbox">

        <div class="eachrec">
            <div style="height:120px; width:95% " >
                <img src="{{asset('public/assets/img')}}/header.png" />
            </div>
            <div style=" float:left; width:550px; margin-top:17px;TEXT-ALIGN:CENTER; text-transform:uppercase;  height:34px;
font-size:24px; ">
                {{ __('text.cash_receipt') }}
            </div>
            <div style=" float:left; width:140px; margin-top:17px;TEXT-ALIGN:CENTER; text-transform:uppercase;  height:34px;
font-size:18px; ">
                N<SUP>0</SUP> 00{{$fee->id}}
            </div>
            <div style=" float:left; width:720px; margin-top:0px;TEXT-ALIGN:CENTER; font-family:arial; height:300px;
font-size:13px; ">
                <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.word_name') }} :</div>
                <div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
                    <div style=" float:left; width:300px;margin-top:3px;">
                        {{$fee->student->name}}
                    </div>
                    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div></div>
                <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.word_purpose') }} :</div>
                <div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
                    <div style=" float:left; width:500px;margin-top:3px;">
                        {{$fee->type->name}}</div>
                    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div></div>

                <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.academic_year') }}:</div>
                <div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
                    <div style=" float:left; width:300px;margin-top:3px;">
                        {{\App\Session::find($year)->name}}
                    </div>
                    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div></div>
                <div style=" float:left; width:700px;margin-top:3px;TEXT-ALIGN:CENTER; font-family:arial; height:300px;
font-size:13px; ">
                    <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.amount_in_figure') }}</div>
                    <div style=" float:left; width:500px; height:25px;font-size:17px;">
                        <div style=" float:left; width:200px;border:1px solid #000;margin-top:3px;">
                          {{ __('text.currency_xaf') }} {{$fee->amount}}
                        </div>
                        <div style="text-transform:uppercase; float:left; width:100px;margin-top:3px;">
                            {{ __('text.word_date') }}
                        </div>
                        <div style=" float:left; border-bottom:1px solid #000;margin-top:3px;">
                            {{$fee->updated_at->format('d/m/Y')}}
                        </div>
                    </div>
                    <div style=" float:left; width:700px;margin-top:3px;TEXT-ALIGN:CENTER; font-family:arial; height:30px; BORDER-BOTTOM:none;
font-size:13px; ">
                        <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> <i>{{ __('text.amount_in_word') }}</i></div>
                        <div style=" float:left; width:500px; height:25px; border-bottom:none; font-size:16px; font-family:Chaparral Pro Light; border-bottom:1PX dashed#000"><i>{{numToWord($fee->amount)}}</i></div>
                    </div>
                    <div style=" float:left; width:700px;margin-top:3px;TEXT-ALIGN:CENTER; font-family:arial; height:30px; BORDER-BOTTOM:none;
font-size:13px; ">
                        <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> <i>{{ __('text.balance_due') }}</i></div>
                        <div style=" float:left; width:500px; height:25px; border-bottom:none; font-size:16px; font-family:Chaparral Pro Light; border-bottom:1PX dashed#000"><i>{{getBal($fee, $year)}}</i></div>
                    </div>


                    <div style=" clear:both; height:30px"></div>

                    <div style="float:left; margin:10px 30px; height:30px; text-transform: capitalize;">
                        ___________________<br /><br />{{ __('text.bursar_signature') }}
                    </div>

                    <div style="float:right; margin:10px 30px; height:30px; text-transform: capitalize;">
                        ___________________<br /><br />{{ __('text.student_signature') }}
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="mainbox">

        <div class="eachrec">
            <div style="height:120px; width:95% " >
                <img src="{{asset('public/assets/img')}}/header.png" />
            </div>
            <div style=" float:left; width:550px; margin-top:17px;TEXT-ALIGN:CENTER;  height:34px; text-transform: uppercase;
font-size:24px; ">
                {{ __('text.cash_receipt') }}
            </div>
            <div style=" float:left; width:140px; margin-top:17px;TEXT-ALIGN:CENTER;  height:34px;
font-size:18px; ">
                N<SUP>0</SUP> 00{{$fee->id}}
            </div>
            <div style=" float:left; width:720px; margin-top:0px;TEXT-ALIGN:CENTER; font-family:arial; height:300px;
font-size:13px; ">
                <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.word_name') }} :</div>
                <div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
                    <div style=" float:left; width:300px;margin-top:3px;">
                        {{$fee->student->name}}
                    </div>
                    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div></div>
                <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.word_purpose') }} :</div>
                <div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
                    <div style=" float:left; width:500px;margin-top:3px;">
                        {{$fee->type->name}}</div>
                    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div></div>

                <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.academic_year') }}:</div>
                <div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
                    <div style=" float:left; width:300px;margin-top:3px;">
                        {{\App\Session::find($year)->name}}
                    </div>
                    <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div></div>
                <div style=" float:left; width:700px;margin-top:3px;TEXT-ALIGN:CENTER; font-family:arial; height:300px;
font-size:13px; ">
                    <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.amount_in_figure') }}</div>
                    <div style=" float:left; width:500px; height:25px;font-size:17px;">
                        <div style=" float:left; width:200px;border:1px solid #000;margin-top:3px;">
                            {{ __('text.currency_xaf') }} {{$fee->amount}}
                        </div>
                        <div style=" float:left; text-transform: uppercase; width:100px;margin-top:3px;">
                            {{ __('text.word_date') }}
                        </div>
                        <div style=" float:left; border-bottom:1px solid #000;margin-top:3px;">
                            {{$fee->updated_at->format('d/m/Y')}}
                        </div>
                    </div>
                    <div style=" float:left; width:700px;margin-top:3px;TEXT-ALIGN:CENTER; font-family:arial; height:30px; BORDER-BOTTOM:none;
font-size:13px; ">
                        <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> <i>{{ __('text.amount_in_word') }}</i></div>
                        <div style=" float:left; width:500px; height:25px; border-bottom:none; font-size:16px; font-family:Chaparral Pro Light; border-bottom:1PX dashed#000"><i>{{numToWord($fee->amount)}}</i></div>
                    </div>
                    <div style=" float:left; width:700px;margin-top:3px;TEXT-ALIGN:CENTER; font-family:arial; height:30px; BORDER-BOTTOM:none;
font-size:13px; ">
                        <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> <i>{{ __('text.balance_due') }}</i></div>
                        <div style=" float:left; width:500px; height:25px; border-bottom:none; font-size:16px; font-family:Chaparral Pro Light; border-bottom:1PX dashed#000"><i>{{getBal($fee, $year)}}</i></div>
                    </div>


                    <div style=" clear:both; height:30px"></div>

                    <div style="float:left; margin:10px 30px; height:30px; text-transform: capitalize;">
                        ___________________<br /><br />{{ __('text.bursar_signature') }}
                    </div>

                    <div style="float:right; margin:10px 30px; height:30px; text-transform: capitalize;">
                        ___________________<br /><br />{{ __('text.student_signature') }}
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</body>
</html>

