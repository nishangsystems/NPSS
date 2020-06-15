@extends('layout.base')

@section('title')
    Recent Student
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Recent Student</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Amount Payed</th>
                        <th>Amount Owing</th>
                        <th>Scholarship</th>
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
                                <td>{{$student->scholarship(getYear())}}</td>
                                <td>
                                    @if(request('action')=='reciept')
                                        <a class="btn btn-primary" href="{{route('fee.print')}}?student={{$student->slug}}&action=print"><i class="fas fa-print"></i> Print </a>
                                    @elseif(request('action')=='scholarship')
                                        <a class="btn btn-primary" href="{{route('fee.scholarship')}}?student={{$student->slug}}"><i class="fas fa-edit"></i> Scholarship</a>
                                    @else
                                        <a class="btn btn-primary" href="{{route('fee.collect')}}?student={{$student->slug}}"><i class="fas fa-plus"></i> Collect Fee</a>
                                    @endif
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
    <script>

    </script>
@endsection
