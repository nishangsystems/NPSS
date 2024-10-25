@extends('layout.base')

@section('title')
    {{ __('text.fee_receipt') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>{{$student->name}} {{ __('text.fee_payment') }}</h3>
                    <div class="dropdown">
                        <a class="text-dark text-left btn btn-fill-md w-100 bg-ash text-14" href="#" role="button" data-toggle="dropdown"
                           aria-expanded="false">{{\App\Session::find($q['year'])->name}}</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach(\App\Session::get() as $session)
                                <a class="dropdown-item" href="{{route('fee.print' ,['student'=>$q['student'],'action'=>$q['action'],'year'=>$session->id])}}">{{$session->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_collector') }}</th>
                            <th>{{ __('text.word_date') }}</th>
                            <th>{{ __('text.word_amount') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($student->feePayment()->where('year_id', $year)->get() as $payment)
                        @php
                            $fee = $payment;
                            $year = $payment->session->id;
                        @endphp

                        <tr>
                            <td>{{$payment->user->name}}</td>
                            <td>{{($payment->created_at->diffForHumans())}}</td>
                            <td>{{$payment->amount}}</td>
                            <td>
                                <button onclick="print('hello{{$payment->id}}')"  class="btn btn-primary text-capitalize" ><i class="fas fa-print"></i>{{ __('text.word_print') }}</button>
                                <button onclick="thermalprint('thermalhello{{$payment->id}}')"  class="btn btn-primary text-capitalize" ><i class="fas fa-print"></i>{{ __('text.thermal_receipt') }}</button>
                                <div class="d-none">
                                    <div id="hello{{$payment->id}}" class="eachrec">
                                        <div style="height:120px; width:95% " >
                                            <img src="{{asset('public/assets/img')}}/header.png" />
                                        </div>
                                        <div style=" float:left; width:550px; margin-top:17px;TEXT-ALIGN:CENTER;  height:34px;font-size:24px; text-transform: upparase;">
                                            {{ __('text.cash_receipt') }}
                                        </div>
                                        <div style=" float:left; width:140px; margin-top:17px;TEXT-ALIGN:CENTER;  height:34px;font-size:18px; ">
                                            N<SUP>0</SUP> 00{{$fee->id}}
                                        </div>
                                        <div style=" float:left; width:720px; margin-top:0px;TEXT-ALIGN:CENTER; font-family:arial; height:300px;font-size:13px; ">
                                            <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.word_name') }} :</div>
                                            <div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
                                                <div style=" float:left; width:300px;margin-top:3px;">
                                                    {{$fee->student->name}}
                                                </div>
                                                <div style=" float:left; width:200px;  height:25px;margin-top:3px;">

                                                </div>
                                            </div>
                                            <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.word_purpose') }} :</div>
                                            <div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
                                                <div style=" float:left; width:500px;margin-top:3px;">
                                                    {{$fee->type->name}}
                                                </div>
                                                <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div>
                                            </div>

                                            <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.academic_year') }}:</div>
                                            <div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
                                                <div style=" float:left; width:300px;margin-top:3px;">
                                                    {{\App\Session::find($year)->name}}
                                                </div>
                                                <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div>
                                            </div>
                                            <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.word_class') }}:</div>
                                            <div style=" float:left; width:500px;border-bottom:1px solid #000;font-weight:normal; height:25px;font-size:17px;">
                                                <div style=" float:left; width:300px;margin-top:3px;">
                                                    {{$fee->student->class($year)->name??null}}
                                                </div>
                                                <div style=" float:left; width:200px;  height:25px;margin-top:3px;"></div>
                                            </div>
                                            <div style=" float:left; width:700px;margin-top:3px;TEXT-ALIGN:CENTER; font-family:arial; height:300px; font-size:13px; ">
                                                <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> {{ __('text.amount_in_fugure') }}</div>
                                                <div style=" float:left; width:500px; height:25px;font-size:17px;">
                                                    <div style=" float:left; width:200px;border:1px solid #000;margin-top:3px;">
                                                        {{ __('text.currency_xaf') }} {{$fee->amount}}
                                                    </div>
                                                    <div style=" float:left; width:100px;margin-top:3px; text-transform: uppercase;">
                                                        {{ __('text.word_date') }}
                                                    </div>
                                                    <div style=" float:left; border-bottom:1px solid #000;margin-top:3px;">
                                                        {{$fee->updated_at->format('d/m/Y')}}
                                                    </div>
                                                </div>
                                                <div style=" float:left; width:700px;margin-top:3px;TEXT-ALIGN:CENTER; font-family:arial; height:30px; BORDER-BOTTOM:none; font-size:13px; ">
                                                    <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> <i>{{ __('text.amount_in_word') }}</i></div>
                                                    <div style=" float:left; width:500px; height:25px; border-bottom:none; font-size:16px; font-family:Chaparral Pro Light; border-bottom:1PX dashed#000"><i>{{numToWord($fee->amount)}}</i></div>
                                                </div>
                                                <div style=" float:left; width:700px;margin-top:3px;TEXT-ALIGN:CENTER; font-family:arial; height:30px; BORDER-BOTTOM:none; font-size:13px; ">
                                                    <div style=" float:left; width:170px; height:25px;font-size:17px; text-transform: capitalize;"> <i>{{ __('text.balance_due') }}</i></div>
                                                    <div style=" float:left; width:500px; height:25px; border-bottom:none; font-size:16px; font-family:Chaparral Pro Light; border-bottom:1PX dashed#000"><i>{{$fee->student->dept($year)}}</i></div>
                                                </div>
                                                <div style=" clear:both; height:30px"></div>

                                                <div style="float:left; margin:10px 30px; height:30px; text-transform: capitalize ">
                                                    ___________________<br /><br />{{ __('text.bursar_signature') }}
                                                </div>

                                                <div style="float:right; margin:10px 30px; height:30px; text-transform: capitalize">
                                                    ___________________<br /><br />{{ __('text.student_signature') }}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="thermalhello{{$payment->id}}" class="eachrec text-left" style="width:100vw !important; font-weight:700; font-size:2.1rem; text-transform:capitalize;">
                                        
                                        <div id="invoice-POS">
                                            
                                            <div id="top">
                                                <div class="logo">
                                                    <div style="text-transform: capitalize; text-align:center; padding-right: 3px;">
                                                        <span style="font-size: x-large; font-weight:700;">{{$institution->name??"SCHOOL-NAME-HERE"}}</span><br>
                                                        <span style="font-size: larger;"><b><i>{{$institution->motto??"SCHOOL-MOTTO-HERE"}}</i></b></span><br>
                                                        <span style="font-size: large;"><i>{{$institution->address??"school-address-here"}}</i></span><br>
                                                        <span style="font-size: large; font-weight:700"><i>{{$institution->contact??"school_contact-here"}}</i></span>
                                                    </div>
                                                </div>
                                                <div class="info" style="text-align: center; text-transform:capitalize;"> 
                                                    <h2>{{ __('text.cash_receipt') }}</h2>
                                                </div><!--End Info-->
                                            </div><!--End InvoiceTop-->
                                            
                                            <div id="mid">
                                                <div class="info" style="text-align: center; text-transform:capitalize;"><b><p>N<SUP>0</SUP> 00{{$fee->id}}</p></b></div>
                                            </div><!--End Invoice Mid-->
                                            
                                            <div id="bot" >
                                                <div id="table">
                                                    <table style="width:96%;">
                                                        <thead>
                                                            <tr class="tabletitle">
                                                                <td class="item"><h2></h2></td>
                                                                <td class="Hours"><h2></h2></td>
                                                                <td class="Rate"><h2></h2></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr class="service">
                                                                <th class="tableitem" style="text-align: start; text-transform: capitalize;"><p class="itemtext">{{ __('text.word_name') }} :</p></th>
                                                                <th class="tableitem" colspan="2" style="text-align: end;"><p class="itemtext" aria-colcount="3">{{$fee->student->name}}</p></th>
                                                            </tr>
                                                            <tr><td colspan="3"><hr></td></tr>
    
                                                            <tr class="service border-bottom">
                                                                <th class="tableitem" style="text-align: start; text-transform: capitalize;"><p class="itemtext">{{ __('text.word_purpose') }} :</p></th>
                                                                <th class="tableitem" colspan="2" style="text-align: end; font-weight:700"><p class="itemtext">{{$fee->type->name}}</p></th>
                                                            </tr>
                                                            <tr><td colspan="3"><hr></td></tr>
    
                                                            <tr class="service border-bottom">
                                                                <th class="tableitem" style="text-align: start; text-transform: capitalize;"><p class="itemtext">{{ __('text.academic_year') }}:</p></th>
                                                                <td class="tableitem text-right" colspan="2" style="text-align: end;"><p class="itemtext">{{\App\Session::find($year)->name}}</p></td>
                                                            </tr>
                                                            <tr><td colspan="3"><hr></td></tr>
    
                                                            <tr class="service border-bottom">
                                                                <th class="tableitem" style="text-align: start; text-transform: capitalize;"><p class="itemtext">{{ __('text.word_class') }}:</p></th>
                                                                <th class="tableitem" colspan="2" style="text-align: end;"><p class="itemtext">{{$fee->student->class($year)->name??null}}</p></th>
                                                            </tr>
                                                            <tr><td colspan="3"><hr></td></tr>
                                                            
                                                            <tr class="service border-bottom">
                                                                <th class="tableitem" style="text-align: start; text-transform: capitalize;"><p class="itemtext">{{ __('text.amount_in_fugure') }}:</p></th>
                                                                <th class="tableitem" colspan="2" style="text-align: end;"><p class="itemtext">{{ __('text.currency_xaf') }} {{$fee->amount}}</p></th>
                                                            </tr>
                                                            <tr><td colspan="3"><hr></td></tr>
                                                            
                                                            <tr class="service border-bottom">
                                                                <th class="tableitem" style="text-align: start; text-transform: capitalize;"><p class="itemtext">{{ __('text.word_date') }}:</p></th>
                                                                <th class="tableitem" colspan="2" style="text-align: end;"><p class="itemtext">{{$fee->updated_at->format('d/m/Y')}}</p></th>
                                                            </tr>
                                                            <tr><td colspan="3"><hr></td></tr>
                                                            
                                                            <tr class="service border-bottom">
                                                                <th class="tableitem" style="text-align: start; text-transform: capitalize;"><p class="itemtext">{{ __('text.amount_in_word') }}:</p></th>
                                                                <th class="tableitem" colspan="" style="text-align: end;"><p class="itemtext">{{numToWord($fee->amount)}}</p></th>
                                                            </tr>
    
                                                           
                                                            <tr><td colspan="3"><hr></td></tr>
    
                                                            <tr class="service border-bottom">
                                                                <th class="tableitem" style="text-align: start; text-transform: capitalize;"><p class="itemtext">{{ __('text.balance_due') }}:</p></th>
                                                                <th class="tableitem" colspan="2" style="text-align: end;"><p class="itemtext">{{$fee->student->dept($year)}}</p></th>
                                                            </tr>
                                                            {{-- <tr><td colspan="3"><br><br></td></tr>
    
                                                            <tr class="service border-bottom">
                                                                <th class="tableitem" colspan="3" style="text-align: end;"><p class="itemtext">___________________<br /><br />{{ __('text.student_signature') }}</p></th>
                                                            </tr>
                                                            <tr><td colspan="3"><br><br></td></tr>
    
                                                            <tr class="service border-bottom">
                                                                <th class="tableitem" colspan="3" style="text-align: end;"><p class="itemtext">___________________<br /><br />{{ __('text.bursar_signature') }}</p></th>
                                                            </tr>
                                                            <tr><td colspan="3"></td></tr> --}}
    
                                                            
                                                        </tbody>

                                                    </table>
                                                </div><!--End Table-->

                                            </div><!--End InvoiceBot-->
                                        </div><!--End Invoice-->
                                    </div>
                                </div>
                            </td>

                        </tr>


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
    <script>

        function print(id) {

            var printContents = $('#'+id).html();
            w = window.open();
            w.document.write('<html><head>');
            w.document.write('<link rel="stylesheet" href="{{asset('public/assets/css')}}/template.css" type="text/css" />');
            w.document.write('</head><body>');
            w.document.write('<div class="receipt"><div class="mainbox">');
            w.document.write(printContents);
            w.document.write('</div>');
            w.document.write('<div class="mainbox">');
            w.document.write(printContents);
            w.document.write('</div></div>');
            w.document.write('</body>');
           w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');
            w.document.write('</html>');
            w.document.close();
            w.focus();
            return true;
        }

        
        function thermalprint(id) {

            var printContents = $('#'+id).html();
            w = window.open();
            w.document.write('<html><head>');
            w.document.write('<link rel="stylesheet" href="{{asset('public/assets/css')}}/thermal_template.css" type="text/css" media="print" />');
            w.document.write('</head><body>');
            w.document.write('<div class="receipt"><div class="mainbox">');
            w.document.write(printContents);
            w.document.write('</div>');
            w.document.write('</body>');
            w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');
            w.document.write('</html>');
            w.document.close();
            w.focus();
            return true;
        }

    </script>
@endsection
