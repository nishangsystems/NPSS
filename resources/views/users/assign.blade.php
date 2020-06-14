@extends('layout.base')

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Assign Parent to student</h3>
                </div>
            </div>
            <form class="new-added-form" method="post" action="{{route('parent.assign.post', $user->slug)}}">
                @csrf
                <div class="row">
                    <div class="col-12 form-group">
                        <label>Select Student</label>
                        <select name="student_id" class="select2 form-control" required>
                            <option value="">Please Select Student</option>
                            @foreach(\App\Student::where('admission_year', getYear())->get() as $student)
                                @if(!$student->hasParent($user))
                                    <option  value="{{$student->id}}">{{$student->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 form-group">
                        <label>Parent</label>
                        <select name="parent_id" class="select2 form-control" required>
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        </select>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <a href="{{route('user.index')}}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection



