@extends('layout.base')

@section('title')
    Admin Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('assets/css')}}/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/css')}}/datepicker.min.css">
@endsection

@section('section')
    <div class="row">
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>{{$title}}</h3>
                    </div>
                    <div class="dropdown">
                       @if(\Auth::user()->can('create_subject'))
                            <a href="{{route('subject.create')}}" class="fw-btn-fill btn-gradient-yellow">Add Subject</a>
                       @endif
                    </div>
                </div>
                <form class="mg-b-20">
                    <div class="row gutters-8">
                        <div class="col-lg-4 col-12 form-group">
                            <input type="text" placeholder="Search by Name..." class="form-control">
                        </div>
                        <div class="col-lg-3 col-12 form-group">
                            <select name="section" class="select2">
                                <option value="0">Select Section</option>
                                @foreach(\App\Section::all() as $class)
                                    <option value="{{$class->id}}">{{$class->byLocale()->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-12 form-group">
                            <button type="submit"
                                    class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead>
                        <tr>
                            <th>Subject Name</th>
                            <th>Subject Code</th>
                            <th>Section</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{$subject->byLocale()->name}}</td>
                                    <td>{{$subject->id}}</td>
                                    <td>{{$subject->section->byLocale()->name}}</td>
                                    <td>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/js')}}/select2.min.js"></script>
    <script src="{{asset('assets/js')}}/datepicker.min.js"></script>
@endsection
