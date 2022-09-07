@extends('layout.base')

@section('section')
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Change Student Class</h3>
                </div>
            </div>
            <form class="new-added-form" method="post"  enctype="multipart/form-data" action="{{route('student.changeClassForm', $student->id)}}">
                @csrf
                <div class="row">

                    <div class="col-12 form-group">
                        <label>Student</label>
                        <select class="select2" readonly name="student" required>
                            <option value="{{$student->id}}">{{$student->name}}</option>
                        </select>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Current Class</label>
                        <select class="select2" readonly name="current_class" required>
                            <option value="{{$student->sClass()->class->id}}">{{$student->sClass()->class->section->name}} - {{$student->sClass()->class->byLocale()->name}}</option>
                        </select>

                        <div class="form-check">
                            <input type="checkbox" value="1" name="remove" id="remove" class="form-check-input">
                            <label for="remove" class="form-check-label">Remove Student from current class</label>
                        </div>


                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Select Class to Send Student to</label>
                        <select class="select2"  value="{{old('class')}}"  name="class" required>
                            @foreach(\App\Classes::get() as $class)
                                <option {{(($student->sClass() != null)?
                ($student->sClass()->class->id):
                ($student->sClass()->class->id)) == $class->id?'selected':''}} value="{{$class->id}}">{{$class->section->name}} - {{$class->byLocale()->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
