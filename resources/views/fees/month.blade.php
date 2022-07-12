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
                    <div class=" mt-1">
                    <h3> Fee Collected on {{getMonthName($month)}} , {{$year}}</h3>
                        <div class="dropdown">
                            <a class="text-dark text-left btn btn-fill-md w-100 bg-ash text-14" href="#" role="button" data-toggle="dropdown"
                               aria-expanded="false">{{getMonthName($month)}}</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'1', 'year'=> $year])}}">January</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'2', 'year'=> $year])}}">February</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'3', 'year'=> $year])}}">March</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'4', 'year'=> $year])}}">April</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'5', 'year'=> $year])}}">May</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'6', 'year'=> $year])}}">June</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'7', 'year'=> $year])}}">July</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'8', 'year'=> $year])}}">August</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'9', 'year'=> $year])}}">September</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'10', 'year'=> $year])}}">October</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'11', 'year'=> $year])}}">November</a>
                                <a class="dropdown-item" href="{{route('fee.monthly.report',['month'=>'12', 'year'=> $year])}}">December</a>
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

                <button onclick="print()">print</button>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Total Fee Collected (XAF)</th>
                        <th>Total Expenses (XAF)</th>
                        <th>Balance (XAF)</th>
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
                                <td>Total</td>
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
