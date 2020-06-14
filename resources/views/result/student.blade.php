@extends('layout.base')

@section('title')
    Student Result
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
           @if($class != null)
                <form class="mg-b-20" method="post" action="{{route('result.class.student.post',$class->id)}}">
                    @csrf
                    <div class="row gutters-8 justify-content-between">
                        <div class="col-lg-6 col-12 form-group">
                            <select name="year" class="select2">
                                <option value="0">Select Session</option>
                                @foreach(\App\Session::all() as $session)
                                    <option value="{{$session->id}}">{{$session->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                            <button type="submit" class="fw-btn-fill btn-gradient-yellow">Get</button>
                        </div>
                    </div>
                </form>
           @endif
            <div class="table-responsive">
                <table class="table data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Fee Bal</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->name}}</td>
                                <td class="text-capitalize">{{$student->gender}}</td>
                                <td>{{$student->dept(getYear())}}</td>
                                <td>
                                   @if(request('action') == 'recordmarks')
                                        <a class="btn btn-danger text-white" href="{{route('result.edit',$student->slug)}}">Edit Result</a>
                                    @elseif(request('action') == 'print')
                                        <a class="btn btn-success text-white" href="{{route('result.session',$student->slug)}}?action=print">Print</a>
                                    @endif

                                    @if(\Auth::user()->hasRole('admin'))
                                           <a class="btn btn-danger text-white" href="{{route('result.edit',$student->slug)}}">Edit Result</a>
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
@endsection
