@extends('layout.base')
@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="item-title">
                <div class=" mt-1 text-capitalize">
                    <h3> {{ __('text.fee_collected_on') }} {{getMonthName($month)}} , {{$year}}</h3>
                    <div class="row">
                        <div class="col-sm-6 p-3">
                            <div class="dropdown">
                                <a class="text-dark text-left btn btn-fill-md w-100 bg-ash text-14" href="#" role="button" data-toggle="dropdown"
                                   aria-expanded="false">{{getMonthName($month)}}</a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'1', 'year'=>$year])}}">{{ __('text.word_january') }}</a>
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'2','year'=>$year])}}">{{ __('text.word_february') }}</a>
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'3','year'=>$year])}}">{{ __('text.word_march') }}</a>
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'4','year'=>$year])}}">{{ __('text.word_april') }}</a>
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'5','year'=>$year])}}">{{ __('text.word_may') }}</a>
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'6','year'=>$year])}}">{{ __('text.word_june') }}</a>
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'7','year'=>$year])}}">{{ __('text.word_july') }}</a>
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'8','year'=>$year])}}">{{ __('text.word_august') }}</a>
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'9','year'=>$year])}}">{{ __('text.word_september') }}</a>
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'10','year'=>$year])}}">{{ __('text.word_october') }}</a>
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'11','year'=>$year])}}">{{ __('text.word_november') }}</a>
                                    <a class="dropdown-item" href="{{route('fee.monthly.receipt',['month'=>'12','year'=>$year])}}">{{ __('text.word_december') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 p-3">
                            <div class="dropdown">
                                <a class="text-dark text-left btn btn-fill-md w-100 bg-ash text-14" href="#" role="button" data-toggle="dropdown"
                                   aria-expanded="false">{{$year}}</a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    @foreach(\App\Session::all() as $k=>$session)
                                        <a class="dropdown-item" href="{{route('fee.monthly.receipt',['year'=>(\Carbon\Carbon::now()->year - $k), 'month'=>$month])}}">{{\Carbon\Carbon::now()->year - $k }}</a>
                                    @endforeach
                                        <a class="dropdown-item" href="{{route('fee.monthly.receipt',['year'=>(\Carbon\Carbon::now()->year - $k - 1),'month'=>$month])}}">{{\Carbon\Carbon::now()->year - $k-1 }}</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_name') }}</th>
                            <th>{{ 'text.word_class' }}/th>
                            <th>{{ __('text.word_amount') }}</th>
                            <th>{{ __('text.collected_by') }}</th>
                            <th>{{ __('text.academic_year') }}</th>
                            <th>{{ __('text.word_date') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($fees as $fee)
                        <tr>
                            <td>{{$fee->student->name}}</td>
                            <td>{{($fee->student->class($fee->session->id))?$fee->student->class($fee->session->id)->byLocale()->name:''}}</td>
                            <td>{{$fee->amount}}</td>
                            <td>{{$fee->user->first_name}} {{$fee->user->last_name}}</td>
                            <td>{{$fee->session->name}}</td>
                            <td>{{$fee->created_at->format('d/m/Y')}}</td>
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
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
@endsection
