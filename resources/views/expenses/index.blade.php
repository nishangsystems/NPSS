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
                <div class="dropdown">
                    <a href="{{route('expenses.collect')}}" class="fw-btn-fill btn-gradient-yellow">Add Expense</a>
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

            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <td>Motive</td>
                        <th>Amount</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $expense)
                        <tr>
                            <td><img src="{{route('image.render',$expense->user->photo)}}" width="30" alt="student"></td>
                            <td>{{$expense->user->name}}</td>
                            <td>{{$expense->motive}}</td>
                            <td>XAF {{$expense->amount}}</td>
                            <td class="badge badge-pill badge-success d-block mg-t-8">Paid</td>
                            <td>

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
        });
    </script>
@endsection
