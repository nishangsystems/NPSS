@extends('layout.base')

@section('title')
    @if(request('daterange'))
      {{   __('text.expenses_between')  }} {request('daterange')}}
    @else
        {{ __('text.todays_expenses') }}
    @endif    
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Fees Table Area Start Here -->
    <div  id="layout"  class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
            <div></div>
                <div class="d-flex justify-content-between text-capitalize">
                    <button onclick="print()" class="text-white float-right btn-fill-md mx-2 bg-primary">{{ __('text.word_print') }}</button>
                    <a href="{{route('expenses.collect')}}" class="btn-fill-md btn-gradient-yellow">{{ __('text.add_expense') }}</a>
                </div>
            </div>
            <form class="mg-b-20"  method="get" action="">
                <input type="hidden" name="action" value="{{request('action')}}">
                <div id="query" class="row gutters-8 form-group">
                    <div class=" text-center pr-3 mt-1">
                        <label class="text-center text-capitalize">{{ __('text.select_date_rage') }}</label>
                    </div>
                    <div class="flex-grow-1 mt-1">
                        <input type="text" class="form-control" name="daterange" required value="{{request('daterange')}}" />
                    </div>
                    <div class="col-lg-2 mt-1">
                        <button type="submit" class="text-white float-right btn-fill-md btn bg-success btn-success text-capitalize">{{ __('text.word_search') }}</button>
                    </div>
                </div>
            </form>

            <div  class="table-responsive">
                <table  class="table data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_date') }}</th>
                            <th>{{ __('text.word_name') }}</th>
                            <td>{{ __('text.word_motive') }}</td>
                            <td>{{ __('text.word_expense') }}</td>
                            <th>{{ __('text.word_amount') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $sum = 0;
                    @endphp

                    @foreach($expenses as $expense)
                        @php
                        $sum += $expense->amount;
                        @endphp
                        <tr>
                            <td>{{$expense->created_at->format('d/m/Y')}}</td>
                            <td>{{$expense->user->name}}</td>
                            <td>{{$expense->motive}}</td>
                            <td>{{$expense->category->name}}</td>
                            <td>{{__('text.currency_xaf')}} {{$expense->amount}}</td>
                            <td class="text-capitalize">
                                <a class="btn btn-success" href="{{route('expenses.edit', $expense->id)}}"><i
                                        class="fas fa-edit"></i> {{ __('text.word_view') }}</a>

                                <a onclick="event.preventDefault();
												document.getElementById('delete').submit();" class=" btn text-white btn-danger"><i
                                        class="fas"></i> {{ __('text.word_delete') }}</a>


                                <form id="delete" action="{{route('expenses.destroy')}}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{$expense->id}}" name="id">
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <tr class="text-capitalize">
                            <td colspan="5">{{ __('text.word_total') }}</td>
                            <td><b>{{ __('text.currency_xaf') }} {{$sum}}</b></td>
                        
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
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
            });

            $('.dt-buttons .buttons-print').addClass('d-none')
        });

        function print() {
            var printContents = $('#layout').html();
            var title = $('#title').html();
            w = window.open();
            w.document.write('<html><head>');
            w.document.write('<link rel="stylesheet" href="{{asset('public/assets/css')}}/bootstrap.min.css" type="text/css" />');
            w.document.write('<style>');
            w.document.write('#DataTables_Table_0_filter{display: none;} #query {display: none ;} form {display: none ;} button {display: none ;}input {display: none; } .btn{display :none;}a{display: none;}');
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
