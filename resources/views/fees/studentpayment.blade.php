@extends('layout.base')

@section('title')
    Fee Reciept
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>{{$student->name}} Fee Payment</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Collector</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($student->feePayment()->where('year_id', $year)->get() as $payment)
                        <tr>
                            <td>{{$payment->user->name}}</td>
                            <td>{{($payment->created_at->diffForHumans())}}</td>
                            <td>{{$payment->amount}}</td>
                            <td>
                                <a  class="btn btn-primary" href="{{route('fee.print.action',$payment->id)}}"><i class="fas fa-print"></i>  Print</a>
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
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
@endsection
