@extends('layout.base')

@section('title')
    {{ __('text.owing_fee') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.all_owing_students') }}</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_name') }}</th>
                            <th>{{ __('text.word_class') }}</th>
                            <th>{{ __('text.amount_paid') }}</th>
                            <th>{{ __('text.amount_owing') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->name}}</td>
                            <td>{{($student->class(getYear()))?$student->class(getYear())->byLocale()->name:''}}</td>
                            <td>{{$student->totalPaid(getYear())}}</td>
                            <td>{{$student->dept(getYear())}}</td>
                            <td>
                                <a class="btn btn-primary text-capitalize" href="{{route('fee.collect')}}?student={{$student->slug}}"><i class="fas fa-plus"></i> {{ __('text.collect_fee') }}</a>
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
