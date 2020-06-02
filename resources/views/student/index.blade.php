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
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Students Data</h3>
                </div>
            </div>
            <form class="mg-b-20">
                <div class="row gutters-8">
                    <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Name ..." class="form-control">
                    </div>
                    <div class="col-lg-3 col-12 form-group">
                        <select name="section" class="select2">
                            <option value="0">Select by Section</option>
                            @foreach(\App\Section::all() as $class)
                                <option value="{{$class->id}}">{{$class->byLocale()->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-12 form-group">
                        <select name="section" class="select2">
                            <option value="0">Select by Class</option>
                            @foreach(\App\Classes::all() as $class)
                                <option value="{{$class->id}}">{{$class->byLocale()->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                        <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Parents</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td class="text-center"><img src="{{route('image.render', $student->photo)}}" style="width: 30px;" alt="student"></td>
                                <td>{{$student->first_name}} {{$student->last_name}}</td>
                                <td>{{$student->gender}}</td>
                                <td>{{($student->classes != null)?$student->classes->name:''}}</td>
                                <td>{{($student->parent != null)?$student->parent->first_name:''}} {{($student->parent != null)?$student->parent->last_name:''}}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                           aria-expanded="false">
                                            <span class="flaticon-more-button-of-three-dots"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Student Table Area End Here -->
@endsection
@section('script')
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/js')}}/select2.min.js"></script>
    <script src="{{asset('assets/js')}}/datepicker.min.js"></script>
@endsection
