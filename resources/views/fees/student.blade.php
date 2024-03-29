@extends('layout.base')

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div id="layout" class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.word_all') }} @if(request('action')=='scholarship' || request('action') =='giftscholarship') {{"Scholarships"}}  @elseif(request('action')=='owing') {{"UnCompleted Fee"}}  @else  {{"Completed Fee"}}   @endif  {{ __('text.word_for') }} {{\App\Session::find($year)->name}}</h3>
                </div>

                <button onclick="print()">{{ __('text.word_print') }}</button>
            </div>

            <form class="mg-b-20"  method="get" action="">
                <input type="hidden" name="action" value="{{request('action')}}">
                <div class="row gutters-8">
                    <div class="col-lg-3  mt-1">
                        <div class="dropdown text-capitalize">
                            <a class="text-dark text-left btn btn-fill-md w-100 bg-ash text-14" href="#" role="button" data-toggle="dropdown"
                               aria-expanded="false">@if(request('action')=='scholarship') {{__('text.word_scholarships')}}  @elseif(request('action')=='owing') {{__('text.uncompleted_fee')}}  @else  {{__('text.completed_fee')}}   @endif</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{route('fee.student',['action'=>'owing','year'=>$q['year'],'classr'=>$q['class']])}}">{{ __('text.uncompleted_fee') }}</a>
                                <a class="dropdown-item" href="{{route('fee.student',['action'=>'scholarship','year'=>$q['year'],'classr'=>$q['class']])}}">{{ __('text.word_scholarships') }}</a>
                                <a class="dropdown-item" href="{{route('fee.student',['action'=>'completed','year'=>$q['year'],'classr'=>$q['class']])}}">{{ __('text.completed_fee') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3  mt-1">
                        <div class="dropdown">
                            <a class="text-dark text-left btn btn-fill-md w-100 bg-ash text-14" href="#" role="button" data-toggle="dropdown"
                               aria-expanded="false">{{\App\Session::find($q['year'])->name}}</a>
                            <div class="dropdown-menu dropdown-menu-right">
                               @foreach(\App\Session::get() as $session)
                                    <a class="dropdown-item" href="{{route('fee.student' ,['action'=>$q['action'],'year'=>$session->id,'classr'=>$q['class']])}}">{{$session->name}}</a>
                               @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3  mt-1">
                        <div class="dropdown">
                            <a class="text-dark text-left btn btn-fill-md w-100 bg-ash text-14" href="#" role="button" data-toggle="dropdown"
                               aria-expanded="false">{{$q['class']?\App\Classes::find($q['class'])->name:'All Classes'}}</a>
                            <div class="dropdown-menu dropdown-menu-right">
                               @foreach(\App\Classes::get() as $session)
                                    <a class="dropdown-item" href="{{route('fee.student' ,['action'=>$q['action'],'classr'=>$session->id,'year'=>$q['year']])}}">{{$session->name}}</a>
                               @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            
            <div class="heading-layout1">
                <div class="row w-100">
                    <div class="col-12 form-group">
                        {{-- <label class="text-capitalize"> {{ __('text.search_student_and_change_class') }}</label> --}}
                        <input type="text" placeholder="Type to search"   oninput="search(this.value)" onkeypress="search(this.value)"  class="form-control border">
                    </div>
                </div>
            </div>


            <div class="table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
               
            <table class="table data-table text-nowrap dataTable no-footer" id="DataTables_Table_0" role="grid">
                    
                <thead>
                    <tr role="row text-capitalize">
                        <th class="sorting_asc" rowspan="1" colspan="1" aria-label="#" style="width: 16.1719px;">#</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 292.062px;">{{ __('text.word_name') }}</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Class: activate to sort column ascending" style="width: 77.1875px;">{{ __('text.word_class') }}</th>
                        {{-- <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="year: activate to sort column ascending" style="width: 70.5469px;">{{ __('text.word_year') }}</th> --}}
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="AmountPaid: activate to sort column ascending" style="width: 58.9219px;">{{ __('text.word_amount') }}<br>{{ __('text.word_paid') }}</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="AmountOwing: activate to sort column ascending" style="width: 58.9219px;">{{ __('text.word_amount') }}<br>{{ __('text.word_owing') }}</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Scholarship: activate to sort column ascending" style="width: 83.6875px;">{{ __('text.word_scholarship') }}</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 164.625px;">{{ __('text.word_action') }}</th>
                    </tr>
                </thead>

                <tbody id="body">
                    @php
                        $totalPaid = 0;
                        $scholarship = 0;
                        $dept= 0;
                        $i =1;
                    @endphp

                    @foreach($students as $student)

                        @php
                            $totalPaid =   $totalPaid + ($student->totalPaid($year) < 0?0:$student->totalPaid($year));
                            $scholarship += $student->scholarship($year);
                            $dept += $student->dept($year);
                        @endphp
                        <tr role="row" class="odd">
                            <td>{{$i++}} </td>
                            <td>{{$student->name}}</td>
                            <td>{{($student->sClass())?$student->sClass()->class->byLocale()->name:''}}</td>
                            {{-- <td>{{\App\Session::find($year)->name}}</td> --}}
                            <td>{{$student->totalPaid($year) < 0?0:$student->totalPaid($year)}}</td>
                            <td class="{{$student->dept($year) >0?'text-red':''}}">{{$student->dept($year)}}</td>
                            <td>{{$student->scholarship($year)}}</td>
                            <td class="text-capitalize">
                                <a class="btn btn-primary" href="{{route('fee.print')}}?student={{$student->slug}}&action=print"><i class="fas fa-print"></i> {{ __('text.view_receipt') }} </a>
                                <a class="btn btn-primary" href="{{route('fee.collect')}}?student={{$student->slug}}"><i class="fas fa-plus"></i> {{ __('text.collect_fee') }}</a>
                                @if(request('action')=='scholarship' || request('action') =='giftscholarship')
                                    <a class="btn btn-primary" href="{{route('fee.scholarship')}}?student={{$student->slug}}"><i class="fas fa-edit"></i> {{ __('text.word_scholarship') }}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr class="font-weight-bold">
                        <td class="text-capitalize"> {{ __('text.word_total') }}</td>
                        <td ></td>
                        <td ></td>
                        {{-- <td ></td> --}}
                        <td>{{number_format($totalPaid)}}</td>
                        <td>{{number_format($dept)}}</td>
                        <td>{{number_format($scholarship)}}</td>
                        <td> </td>
                    </tr>
                </tbody>
            </table>
            </div>
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

        function search(name) {
            if(name!=''){
                $.ajax({
                    type: "GET",
                    url: "{{route('search.student_fee')}}",
                    dataType: 'JSON',
                    data: {
                        'param':name
                    },
                    success: function (response) {
                        let html = "";
                        items = response.data;
                        for (let i = 0; i < items.length; i++) {
                            item = items[i];
                            html += `
                                <tr role="row" class="odd">
                                    <td>${i+1} </td>
                                    <td>${item.name}</td>
                                    <td>${item.class}</td>
                                    <td>${item.paid}</td>
                                    <td class="${item.debt >0? 'text-red':''}">${item.debt}</td>
                                    <td>${item.scholarship}</td>
                                    <td class="text-capitalize">
                                        <a class="btn btn-primary" href="${item.print_link}"><i class="fas fa-print"></i> {{ __('text.view_receipt') }} </a>
                                        <a class="btn btn-primary" href="${item.collect_link}"><i class="fas fa-plus"></i> {{ __('text.collect_fee') }}</a>
                                        @if(request('action')=='scholarship' || request('action') =='giftscholarship')
                                            <a class="btn btn-primary" href="${item.scholarship_link}"><i class="fas fa-edit"></i> {{ __('text.word_scholarship') }}</a>
                                        @endif
                                    </td>
                                </tr>
                            `;
                        }
                        if(items.length == 0){
                            html += "<tr><td colspan='3' align='center'>{{ __('text.no_results_found') }}</td> </tr>"
                        }
                        $('#body').html(html);
                    },
                    error: function(e){
                    }
                });
            }
        }
    </script>
@endsection
