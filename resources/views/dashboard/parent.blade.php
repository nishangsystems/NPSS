@extends('layout.base')

@section('title')
    Parent Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="row">
        <div class="col-3-xxxl col-sm-6 col-12">
            <div class="dashboard-summery-one">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon bg-light-red">
                            <i class="flaticon-money text-red"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Due Fees</div>
                            <div class="item-number"><span>$</span><span class="counter" data-num="4503">4,503</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3-xxxl col-sm-6 col-12">
            <div class="dashboard-summery-one">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon bg-light-magenta">
                            <i class="flaticon-shopping-list text-magenta"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Notifications</div>
                            <div class="item-number"><span class="counter" data-num="0">0</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3-xxxl col-sm-6 col-12">
            <div class="dashboard-summery-one">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon bg-light-yellow">
                            <i class="flaticon-mortarboard text-orange"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">My Student</div>
                            <div class="item-number"><span class="counter" data-num="{{\Auth::user()->students->count()}}">{{\Auth::user()->students->count()}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3-xxxl col-sm-6 col-12">
            <div class="dashboard-summery-one">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon bg-light-blue">
                            <i class="flaticon-money text-blue"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Expenses</div>
                            <div class="item-number"><span class="counter" data-num="193000">0</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard summery End Here -->
    <!-- Dashboard Content Start Here -->
    <div class="row">
        <div class="col-5-xxxl col-12">
            <div class="card dashboard-card-twelve">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>My Kids</h3>
                        </div>
                    </div>
                    <div class="kids-details-wrap">
                        <div class="row">
                            @foreach(\Auth::user()->students as $studend)
                                <div class="col-12-xxxl col-xl-6 col-12">
                                    <div class="kids-details-box mb-5">
                                        <div class="item-img">
                                            <img src="{{route('image.render',$user->photo)}}" alt="kids">
                                        </div>
                                        <div class="item-content table-responsive">
                                            <table class="table text-nowrap">
                                                <tbody>
                                                <tr>
                                                    <td>Name:</td>
                                                    <td>{{$student->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Gender:</td>
                                                    <td>{{$student->gender}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Class:</td>
                                                    <td>{{$student->class(getYear())->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Id:</td>
                                                    <td>{{$student->id}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Date:</td>
                                                    <td>{{$student->created_at->format('d.m.Y')}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7-xxxl col-12">
            <div class="card dashboard-card-eleven">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>All Expenses</h3>
                        </div>
                    </div>
                    <div class="table-box-wrap">
                        <form class="search-form-box">
                            <div class="row gutters-8">
                                <div class="col-lg-4 col-md-3 form-group">
                                    <input type="text" placeholder="Search by Exam ..." class="form-control">
                                </div>
                                <div class="col-lg-3 col-md-3 form-group">
                                    <input type="text" placeholder="Search by Subject ..." class="form-control">
                                </div>
                                <div class="col-lg-3 col-md-3 form-group">
                                    <input type="text" placeholder="dd/mm/yyyy" class="form-control">
                                </div>
                                <div class="col-lg-2 col-md-3 form-group">
                                    <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive expenses-table-box">
                            <table class="table data-table text-nowrap">
                                <thead>
                                <tr>
                                    <th>Expense</th>
                                    <th>Amount</th>
                                    <th>Student</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Exam Fees</td>
                                        <td>$150.00</td>
                                        <td>Neba Emmanuel</td>
                                        <td>22/02/2019</td>
                                        <td>
                                            <a class="btn btn-success" href="#"><i class="fas fa-times"></i> Close</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/js')}}/jquery.counterup.min.js"></script>
    <script src="{{asset('assets/js')}}/moment.min.js"></script>
    <script src="{{asset('assets/js')}}/jquery.waypoints.min.js"></script>
@endsection

