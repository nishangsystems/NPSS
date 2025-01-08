@extends('layout.template')
@section('content')
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
                <td><b>{{ __('text.word_amount') }}</b></td>
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
                <td><b>{{ __('text.word_scholarships') }}</b></td>
                <td><b>{{ __('text.currency_xaf') }} {{getTotalScholarship(getYear())}}</b></td>
                <td></td>
            </tr>

            <tr>
                <td><b>{{ __('text.total_fee_paid') }}</b></td>
                <td><b>{{ __('text.currency_xaf') }}  {{getFeePayed(getYear())}}</b></td>
                <td></td>
            </tr>
            </tbody>
            </tbody>
        </table>
    </div>
@endsection
