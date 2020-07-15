@extends('layout.base')

@section('title')
    Expenses
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Fees Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Expenses</h3>
                </div>
                <div class="d-flex justify-content-between">
                    <button onclick="print()" class="text-white float-right btn-fill-md mx-2 bg-primary">Print</button>
                    <a href="{{route('expenses.collect')}}" class="btn-fill-md btn-gradient-yellow">Add Expense</a>
                </div>
            </div>
            <form class="mg-b-20"  method="get" action="">
                <input type="hidden" name="action" value="{{request('action')}}">
                <div class="row gutters-8 form-group">
                    <div class="col-lg-3  mt-1">
                        <label class="text-sm-center">Select Date Range</label>
                    </div>
                    <div class="col-lg-7  mt-1">
                        <input type="text" class="form-control" name="daterange" required value="{{request('daterange')}}" />
                    </div>
                    <div class="col-lg-2 mt-1">
                        <button type="submit" class="text-white float-right btn-fill-md btn bg-success btn-success">Query</button>
                    </div>
                </div>
            </form>

            <div  class="table-responsive">
                <table  class="table data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <td>Motive</td>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $expense)
                        <tr>
                            <td>{{$expense->created_at->diffForHumans()}}</td>
                            <td>{{$expense->user->name}}</td>
                            <td>{{$expense->motive}}</td>
                            <td>XAF {{$expense->amount}}</td>
                            <td>
                                <a class="btn btn-success" href="{{route('expenses.edit', $expense->id)}}"><i
                                        class="fas fa-edit"></i> View</a>

                                <a onclick="event.preventDefault();
												document.getElementById('delete').submit();" class=" btn text-white btn-danger"><i
                                        class="fas"></i> Delete</a>


                                <form id="delete" action="{{route('expenses.destroy')}}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{$expense->id}}" name="id">
                                </form>
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
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
            });

            $('.dt-buttons .buttons-print').addClass('d-none')
        });

        function print(){
            var printContents = "<table  class=\"table data-table text-nowrap\"><thead>\n" +
                "                    <tr>\n" +
                "                         <th>Date</th>\n" +
                "                        <th>Name</th>\n" +
                "                        <td>Motive</td>\n" +
                "                        <th>Amount</th>\n" +
                "                    </tr>\n" +
                "                    </thead><tbody>"
                @foreach($expenses as $expense)
                    +"<tr>" +
                    "<td>{{$expense->created_at->diffForHumans()}}</td>" +
                    "<td>{{$expense->user->name}}</td>" +
                    "<td>{{$expense->motive}}</td>" +
                    "<td>XAF {{$expense->amount}}</td>" +
                "</tr></td>" +
                @endforeach
                " </tbody></table>";


            w = window.open();
            w.document.write('<html><head>');
            w.document.write('<link rel="stylesheet" href="{{ url('assets') }}/css/bootstrap.min.css" type="text/css" />');
            w.document.write('<link rel="stylesheet" href="{{ url('assets') }}/css/style.css" type="text/css" />');
            w.document.write('</head><body>');
            w.document.write('<div class="card height-auto"><div class="card-body">')
            w.document.write('<img src="{{ url('assets') }}/img/header.png" />');
            w.document.write('<div class="table-responsive">');
            w.document.write('<h3 class="text-center">{{$title}}</h3>');
            w.document.write(printContents);
            w.document.write('</div></div></div>')
            w.document.write('</body>');
            w.document.write('<script src="{{asset('assets/js')}}/jquery-3.3.1.min.js" type="text/javascript" >' + '</sc'+'ript>');
            w.document.write('<script src="{{asset('assets/js')}}/bootstrap.min.js" type="text/javascript" />' + '</sc'+'ript>');
            w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');
            w.document.write('</html>');
            w.document.close();
            w.focus();
            return true;
        }
    </script>
@endsection
