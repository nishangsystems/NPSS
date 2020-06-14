@extends('layout.template')

@section('content')
    <div class="card height-auto">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Amount</th>
                        <th>Date</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fees as $fee)
                        <tr>
                            <td>{{$fee->student->name}}</td>
                            <td>{{($fee->student->class($fee->session->id))?$fee->student->class($fee->session->id)->byLocale()->name:''}}</td>
                            <td>{{$fee->amount}}</td>
                            <td>{{$fee->created_at->format('d/m/Y')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
