@extends('layout.base')

@section('title')
    Rank Sheet
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')

    <div class="row">
        <div class="col-lg-12">
            <div class="card dashboard-card-eleven">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>All Pupil</h3>
                        </div>
                    </div>
                    <div class="table-box-wrap">
                        <div class="table-responsive student-table-box">
                            <table class="table display data-table text-nowrap">
                                <thead>
                                <tr>
                                    <th>Name</th
                                    <th>Gender</th>
                                    <th>Average</th>
                                </tr>
                                </thead>
                                <tbody>
                                   @if(\Auth::user()->class(getYear()))
                                       @foreach(\Auth::user()->class(getYear())->student as $student )
                                           <tr>
                                               <td>{{$student->name}}</td>
                                               <td>{{$student->average(getYear(),getTerm())}}</td>
                                          </tr>
                                       @endforeach
                                   @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
@endsection

