@extends('layout.base')

@section('title')
    {{ __('text.word_fee') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>{{ __('text.all_student_scholarships') }}</h3>
                </div>
                <div class="dropdown">
                    <a href="{{route('fee.scholarship.report')}}?action=print" class="fw-btn-fill btn-gradient-yellow text-capitalize">{{ __('text.word_print') }}</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('text.word_name') }}</th>
                            <th>{{ __('text.word_class') }}</th>
                            <th>{{ __('text.word_amount') }}</th>
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
                                <td>{{$fee->created_at->format('d/m/Y')}}</td>
                                <td>
                                    <a class="btn btn-primary text-capitalize" href="{{route('fee.scholarship')}}?student={{$fee->student->slug}}"><i class="fas fa-edit"></i> {{ __('text.word_scholarship') }}</a>
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
