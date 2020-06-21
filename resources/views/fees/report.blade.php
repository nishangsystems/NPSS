@extends('layout.base')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Fees Collection</h3>
                </div>
            </div>
            <form class="mg-b-20">
                <div class="row gutters-8">
                    <div class="col-9">
                        <div class="dropdown">
                            <a class="text-dark text-left btn btn-fill-md w-100 bg-ash text-18" href="#" role="button" data-toggle="dropdown"
                               aria-expanded="false">{{ request('action')=="owing"?"UnCompleted Fee":request('action')=="completed"?"Completed Fee":'UnCompleted Fee' }}</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{route('fee.report')}}?action=owing">UnCompleted Fee</a>
                                <a class="dropdown-item" href="{{route('fee.student')}}?action=scholarship">Scholarships</a>
                                <a class="dropdown-item" href="{{route('fee.report')}}?action=completed">Completed Fee</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <a href="{{route('fee.report')}}?action=print" class="float-right btn btn-gradient-yellow btn-fill-md text-white">Print</a>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Amount</th>
                        <th>Collected By</th>
                        <th>Academic Year</th>
                        <th>Date</th>
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
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
@endsection
