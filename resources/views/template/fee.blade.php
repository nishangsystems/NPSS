@extends('layout.template')
@section('content')
    <div class="table-responsive">
        <table class="table data-table text-nowrap">
            <thead>
            <tr>
                <th>Amount</th>
                <td>Date</td>
                <th>Collector</th>
            </tr>
            </thead>
            <tbody>
            @foreach($student->feePayment()->where('year_id',getYear())->get() as $fee)
                <tr>
                    <td>XAF {{$fee->amount}} </td>
                    <td>{{$fee->created_at->format('d/m/Y')}}</td>
                    <td>{{$fee->user->name}} / {{$fee->user->roles->first()->name}}</td>
                </tr>
            @endforeach
            <tr>
                <td><b>Total Paid</b> </td>
                <td  colspan="2">XAF <b>{{$student->totalPaid(getYear())}}</b></td>
            </tr>
            <tr>
                <td><b>Scholarship</b> </td>
                <td  colspan="2">XAF <b>{{$student->scholarship(getYear())}}</b></td>
            </tr>
            <tr>
                <td><b>Balance</b> </td>
                <td  colspan="2">XAF <b>{{$student->dept(getYear())}}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
