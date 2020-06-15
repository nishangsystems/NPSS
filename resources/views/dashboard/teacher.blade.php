@extends('layout.base')

@section('title')
    Teacher Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <!-- Breadcubs Area End Here -->
    <div class="row">
        <div class="col-lg-6 col-4-xxxl col-xl-6">
            <div class="card dashboard-card-three">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Students</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <div class="doughnut-chart-wrap">
                        <canvas id="student-doughnut-chart" width="100" height="270"></canvas>
                    </div>
                    <div class="student-report">
                        <div class="student-count pseudo-bg-blue">
                            <h4 class="item-title">Female Students</h4>
                            <div class="item-number">10,500</div>
                        </div>
                        <div class="student-count pseudo-bg-yellow">
                            <h4 class="item-title">Male Students</h4>
                            <div class="item-number">24,500</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Students Chart End Here -->
        <!-- Notice Board Start Here -->
        <div class="col-lg-6 col-4-xxxl col-xl-6">
            <div class="card dashboard-card-six">
                <div class="card-body">
                    <div class="heading-layout1 mg-b-17">
                        <div class="item-title">
                            <h3>Notifications</h3>
                        </div>
                    </div>
                    <div class="notice-box-wrap">
                        <div class="notice-list">
                            <div class="post-date bg-skyblue">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag mene esom tus eleifend lectus
                                    sed maximus mi faucibusnting.</a></h6>
                            <div class="entry-meta">  Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Notice Board End Here -->
    </div>
    <!-- Student Table Area Start Here -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card dashboard-card-eleven">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>My Students</h3>
                        </div>
                    </div>
                    <div class="table-box-wrap">
                        <div class="table-responsive student-table-box">
                            <table class="table display data-table text-nowrap">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Parents</th>
                                    <th>Fee Bal</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                   @if(\Auth::user()->class(getYear()))
                                       @foreach(\Auth::user()->class(getYear())->students(getYear()) as $student )
                                           <tr>
                                               <td>{{$student->name}}</td>
                                               <td>{{$student->gender}}</td>
                                               <td>{{$student->parent()?$student->parent()->name:''}}</td>
                                               <td>{{$student->dept(getYear())}}</td>
                                               <td> <a class="btn btn-success text-white" href="{{route('result.session',$student->slug)}}">View Result</a></td>
                                           </tr>
                                       @endforeach
                                   @endif
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
    <script src="{{asset('assets/js')}}/Chart.min.js"></script>
    <script src="{{asset('assets/js')}}/jquery.counterup.min.js"></script>
    <script src="{{asset('assets/js')}}/moment.min.js"></script>
    <script src="{{asset('assets/js')}}/jquery.waypoints.min.js"></script>
@endsection

