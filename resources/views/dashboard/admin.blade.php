@extends('layout.base')

@section('title')
    {{ __('text.admin_dashboard') }}
@endsection

@section('section')
    <div class="row gutters-20">
    
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-blue">
                            <i class="flaticon-multiple-users-silhouette text-blue"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title text-capitalize">{{ __('text.word_teachers') }}</div>
                            <div class="item-number"><span class="counter" data-num="{{\App\Role::whereSlug('teacher')->first()->users()->count()}}">{{\App\Role::whereSlug('teacher')->first()->users()->count()}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-yellow">
                            <i class="flaticon-couple text-orange"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title text-capitalize">{{ __('text.word_parent') }}</div>
                            <div class="item-number"><span class="counter" data-num="{{\App\Role::whereSlug('parent')->first()->users()->count()}}">{{\App\Role::whereSlug('parent')->first()->users()->count()}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-red">
                            <i class="flaticon-money text-red"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title text-capitalize">{{ __('text.word_roles') }}</div>
                            <div class="item-number"><span class="counter" data-num="{{\App\Role::count()}}">{{\App\Role::count()}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard summery End Here -->
    <!-- Dashboard Content Start Here -->
    <div class="row gutters-20">
    
        <div class="col-lg-12 col-xl-6 col-3-xxxl">
            <div class="card dashboard-card-three pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title text-capitalize">
                            <h3>{{ __('text.word_students') }}</h3>
                        </div>
                    </div>
                    <div class="doughnut-chart-wrap">
                        <canvas id="student-doughnut-chart" width="100" height="300"></canvas>
                    </div>
                    <div class="student-report">
                        <div class="student-count pseudo-bg-blue">
                            <h4 class="item-title text-capitalize">{{ __('text.female_students') }}</h4>
                            <div class="item-number">{{\App\Student::whereHas('classes', function($q){
                                $q->where('year_id',getYear());
                            })->where('gender','female')->count()}}</div>
                        </div>
                        <div class="student-count pseudo-bg-yellow">
                            <h4 class="item-title text-capitalize">{{ __('text.male_students') }}</h4>
                            <div class="item-number">{{\App\Student::whereHas('classes', function($q){
                                $q->where('year_id',getYear());
                            })->where('gender','male')->count()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12  col-xl-6">
            <div class="card dashboard-card-six pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1 mg-b-17">
                        <div class="item-title text-capitalize">
                            <h3>{{ __('text.notice_board') }}</h3>
                        </div>
                    </div>
                    <div class="notice-box-wrap">

                        @foreach(request()->user()->receivedMessages() as $notice)
                            <div class="notice-list">
                                <div class="post-date bg-skyblue">{{$notice->created_at->format('d F, Y')}}</div>
                                <h6 class="notice-title"><a href="#">{{$notice->content}}</a></h6>
                                <div class="entry-meta"> {{$notice->user->name}} / <span>{{$notice->created_at->diffForHumans()}}</span></div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('public/assets/js')}}/Chart.min.js"></script>
    <script src="{{asset('public/assets/js')}}/jquery.counterup.min.js"></script>
    <script src="{{asset('public/assets/js')}}/moment.min.js"></script>
    <script src="{{asset('public/assets/js')}}/jquery.waypoints.min.js"></script>
    <script>
        /*-------------------------------------
          Doughnut Chart
      -------------------------------------*/
        if ($("#student-doughnut-chart").length) {

            var doughnutChartData = {
                labels: ["Female Students", "Male Students"],
                datasets: [{
                    backgroundColor: ["#304ffe", "#ffa601"],
                    data: [{{\App\Student::where('gender','female')->get()->count()}}, {{\App\Student::where('gender','male')->get()->count()}}],
                    label: "Total Students"
                }, ]
            };
            var doughnutChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 65,
                rotation: -9.4,
                animation: {
                    duration: 2000
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                },
            };
            var studentCanvas = $("#student-doughnut-chart").get(0).getContext("2d");
            var studentChart = new Chart(studentCanvas, {
                type: 'doughnut',
                data: doughnutChartData,
                options: doughnutChartOptions
            });
        }
       
    </script>
@endsection
