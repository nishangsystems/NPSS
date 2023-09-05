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
            <div class="heading-layout1 text-capitalize">
                <div class="item-title">
                    <h3>{{ __('text.fee_report') }}</h3>
                </div>
                <div class="dropdown">
                    <a href="{{route('fee.income')}}?action=print" class="fw-btn-fill btn-gradient-yellow">{{ __('text.word_print') }}</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead>
                    </thead>
                    <tbody class="text-capitalize">
                        <tr>
                            <td><b>{{ __('text.fee_type') }}</b></td>
                            <td><b>{{ __('text.word_amount') }}</b></td>
                            <td></td>
                        </tr>
                        @foreach(\App\FeeType::get() as $type)
                            <tr>
                                <td>{{$type->name}}</td>
                                <td>{{ __('text.currency_xaf') }}  {{$type->total(getYear())}}</td>
                                <td></td>
                            </tr>
                        @endforeach

                        <tr>
                            <td><b>{{ __('text.payment_method') }}</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach(\App\PaymentMethod::get() as $type)
                            <tr>
                                <td>{{$type->name}}</td>
                                <td>{{ __('text.currency_xaf') }}  {{$type->total(getYear())}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><b>{{ __('text.word_scholarship') }}</b></td>
                            <td><b>{{ __('text.currency_xaf') }} {{getTotalScholarship(getYear())}}</b></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td><b>{{ __('text.total_fee_paid') }}</b></td>
                            <td><b>{{ __('text.currency_xaf') }}  {{getFeePayed(getYear())}}</b></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td><b>{{ __('text.total_expenses') }}</b></td>
                            <td><b>{{ __('text.currency_xaf') }}  {{getExpenses(getYear())}}</b></td>
                            <td></td>
                        </tr>
                    </tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

