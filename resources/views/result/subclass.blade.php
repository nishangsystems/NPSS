@extends('layout.base')

@section('title')
   Result
@endsection


@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <form method="post" action="" class="row w-100">
                    @csrf
                    <div class="col-md-4 form-group">
                        <select class="select2"  value="{{old('admission_year')}}"  required name="year">
                            <option>Change Academic year</option>
                            @foreach(\App\Session::all() as $class)
                                <option {{($class->id == $year)?'selected':''}} value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label></label>
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Get</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Section</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tr id="body">
                        @foreach($classes as $class)
                        <tr>
                            <th>{{$class->class->name}}</th>
                            <th>{{$class->section_id}}</th>
                            <th>
                                <a class="btn btn-primary float-right" href="{{route('result.class.student',$class->id)}}">
                                    View Student
                                </a>
                            </th>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
