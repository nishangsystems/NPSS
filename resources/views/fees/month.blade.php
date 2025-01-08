@extends('layout.base')


@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Fees Table Area Start Here -->
    <div id="layout" class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <div class=" mt-1 text-capitalize">
                        <h3> {{ __('text.fee_collected_on') }} {{getMonthName($month)}} , {{$year}}</h3>
                        <div class="dropdown">
                            <a class="text-dark text-left btn btn-fill-md w-100 bg-ash text-14" href="#" role="button" data-toggle="dropdown"
                               aria-expanded="false">{{getMonthName($month)}}</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'1', 'year'=> $year])}}">{{ __('text.word_january') }}</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'2', 'year'=> $year])}}">{{ __('text.word_february') }}</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'3', 'year'=> $year])}}">{{ __('text.word_march') }}</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'4', 'year'=> $year])}}">{{ __('text.word_april') }}</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'5', 'year'=> $year])}}">{{ __('text.word_may') }}</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'6', 'year'=> $year])}}">{{ __('text.word_june') }}</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'7', 'year'=> $year])}}">{{ __('text.word_july') }}</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'8', 'year'=> $year])}}">{{ __('text.word_august') }}</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'9', 'year'=> $year])}}">{{ __('text.word_september') }}
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'10', 'year'=> $year])}}">{{ __('text.word_october') }}</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'11', 'year'=> $year])}}">{{ __('text.word_november') }}</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'12', 'year'=> $year])}}">{{ __('text.word_december') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3  mt-1">
                    <div class="dropdown">
                        <a class="text-dark text-left btn btn-fill-md w-100 bg-ash text-14" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">{{$year}}</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @for($y = \Carbon\Carbon::now()->year; $y >= 2016 ;  $y--)
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>$month, 'year'=> $y])}}">{{$y}}</a>
                            @endfor
                        </div>
                    </div>
                </div>

                <button onclick="print()">{{ __('text.word_print') }}</button>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_date') }}</th>
                            <th>{{ __('text.total_fee_collected') }} ({{ __('text.currency_xaf') }})</th>
                            <th>{{ __('text.total_expenses') }} ({{ __('text.currency_xaf') }})</th>
                            <th>{{ __('text.word_balance') }} ({{ __('text.currency_xaf') }})</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 1; $i <= 31; $i++)
                           @if(getDailyTotalFee($i, $month, $year) > 0 || getDailyTotalExpenses($i, $month, $year) > 0)
                                <tr>
                                    <td>{{$i}}/{{$month}}/{{$year}}</td>
                                    <td><b>{{getDailyTotalFee($i, $month, $year)}}</b></td>
                                    <td><b>{{getDailyTotalExpenses($i, $month, $year)}}</b></td>
                                    <td><b>{{getDailyTotalFee($i, $month, $year) - getDailyTotalExpenses($i, $month, $year)}}</b></td>
                                </tr>
                           @endif
                        @endfor
                            <tr>
                                <td class="text-capitalize">{{ __('text.word_total') }}</td>
                                <td><b>{{getMonthlyTotalFee($month, $year)}}</b></td>
                                <td><b>{{getMonthlyTotalExpenses($month, $year)}}</b></td>
                                <td><b>{{getMonthlyTotalFee($month, $year) - getMonthlyTotalExpenses($month, $year)}}</b></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
    <script>
        function print() {
            var printContents = $('#layout').html();
            var title = $('#title').html();
            w = window.open();
            w.document.write('<html><head>');
            w.document.write('<link rel="stylesheet" href="{{asset('public/assets/css')}}/bootstrap.min.css" type="text/css" />');
            w.document.write('<style>');
            w.document.write('#DataTables_Table_0_filter{display: none;} button {display: none ;}input {display: none; } .btn{display :none;}a{display: none;}');
            w.document.write('</style>');
            w.document.write('</head><body>');
            w.document.write('<img class="image-fluid" src="{{asset('public/assets/img')}}/header.png" />');
            w.document.write('<table>');
            w.document.write(printContents);
            w.document.write('</table>');
            w.document.write('</body>');
            // w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');
            w.document.write('</html>');
            w.document.close();
            w.focus();
            return true;
        }
    </script>
@endsection
