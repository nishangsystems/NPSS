@extends('layout.template')
@section('content')
    <div class="table-responsive">
        <table class="table data-table text-nowrap">
            <thead>
            </thead>
            <tbody>
            <tr>
                <td><b>Fee Type</b></td>
                <td><b>Amount</b></td>
                <td></td>
            </tr>
            @foreach(\App\FeeType::get() as $type)
                <tr>
                    <td>{{$type->name}}</td>
                    <td>XAF  {{$type->total(getYear())}}</td>
                    <td></td>
                </tr>
            @endforeach

            <tr>
                <td><b>Payment Method</b></td>
                <td><b>Amount</b></td>
                <td></td>
            </tr>
            @foreach(\App\PaymentMethod::get() as $type)
                <tr>
                    <td>{{$type->name}}</td>
                    <td>XAF  {{$type->total(getYear())}}</td>
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td><b>Scholarships</b></td>
                <td><b>XAF {{getTotalScholarship(getYear())}}</b></td>
                <td></td>
            </tr>

            <tr>
                <td><b>Total Fee Payed</b></td>
                <td><b>XAF  {{getFeePayed(getYear())}}</b></td>
                <td></td>
            </tr>
            </tbody>
            </tbody>
        </table>
    </div>
@endsection
