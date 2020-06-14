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
                                <td class="text-center"><img src="{{route('image.render', $student->photo)}}" style="width: 30px;" alt=""></td>
                                <td>{{$student->name}} </td>
                                <td>{{$student->gender}}</td>
                                <td>{{($student->class(getYear()) != null)?$student->class(getYear())->name:''}}</td>
                                <td>{{($student->parent() != null)?$student->parent()->first_name:''}} {{($student->parent() != null)?$student->parent()->last_name:''}}</td>
                                <td>

                                     <a class="btn btn-primary" href="{{route('student.show', $student->slug)}}"><i
                                                    class="fas fa-eye text-orange-peel"></i> View</a>
                                    @if(\Auth::user()->hasRole('admin'))
                                        <a class="btn btn-success" href="{{route('student.edit', $student->slug)}}"><i
                                                class="fas fa-edit text-dark-pastel-green"></i> Edit</a>

                                        <a onclick="event.preventDefault();
												document.getElementById('delete').submit();" class=" btn btn-danger"><i
                                                class="fas fa-trash"></i> Delete</a>


                                        <form id="delete" action="{{route('student.destroy', $student->slug)}}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                        </form>
                                    @endif
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
