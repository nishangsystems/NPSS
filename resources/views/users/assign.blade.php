@extends('layout.base')

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.assign_parent_to_student') }}</h3>
                </div>
            </div>
            <form class="new-added-form" method="post" action="{{route('parent.assign.post', $user->slug)}}">
                @csrf
                <div class="row">
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.select_student') }}</label>
                        <select name="student_id" class="select2 form-control" required>
                            <option value="">{{ __('text.select_student') }}</option>
                            @foreach(\App\Student::where('admission_year', getYear())->get() as $student)
                                @if(!$student->hasParent($user))
                                    <option  value="{{$student->id}}">{{$student->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_parent') }}</label>
                        <select name="parent_id" class="select2 form-control" required>
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        </select>
                    </div>
                    <div class="col-12 form-group mg-t-8 text-capitalize">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('text.word_save') }}</button>
                        <a href="{{route('user.index')}}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('text.word_reset') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection



