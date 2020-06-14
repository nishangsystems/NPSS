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
                    <a href="{{route('expenses.collect')}}" class="fw-btn-fill btn-gradient-yellow">Save Expense</a>
                </div>
            </div>
            <form class="mg-b-20">
                <div class="row gutters-8">
                    <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by ID ..." class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Name ..." class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Phone" class="form-control">
                    </div>
                    <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                        <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
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
@endsection
