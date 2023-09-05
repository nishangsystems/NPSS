@extends('layout.base')

@section('section')
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.add_new_student') }}</h3>
                </div>
            </div>
            <form class="new-added-form" method="post"  enctype="multipart/form-data" action="{{route('student.store')}}">
                @csrf
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_name') }} *</label>
                        <input type="text" value="{{old('name')}}" name="name" required class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_gender') }} *</label>
                        <select class="select2 text-capitalize" name="gender" required>
                            <option value="">{{ __('text.please_select_gender') }} *</option>
                            <option value="male">{{ __('text.word_male') }}</option>
                            <option value="female">{{ __('text.word_female') }}</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.date_of_birth') }} *</label>
                        <input type="text" placeholder="dd/mm/yyyy"  value="{{old('dob')}}"  required name="dob" class="form-control air-datepicker"
                               data-position='bottom right'>
                        <i class="far fa-calendar-alt"></i>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_address') }}</label>
                        <input name="address" type="text"  value="{{old('address')}}"  required placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_email') }}</label>
                        <input type="email" name="email"  value="{{old('email')}}"  class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_class') }} *</label>
                        <select class="select2"  value="{{old('class')}}"  name="class" required>
                            <option  value="">{{ __('text.please_select_class') }} *</option>
                            @foreach(\App\Section::all() as $section)
                                @foreach($section->class as $class)
                                    <option value="{{$class->id}}">{{$section->name}} - {{$class->byLocale()->name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.admission_year') }}</label>
                        <select class="select2"  value="{{old('admission_year')}}"  required name="admission_year">
                            <option>{{ __('text.please_select_admission_year') }}</option>
                            @foreach(\App\Session::all() as $class)
                                <option {{($class->id == getYear())?'selected':''}} value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_phone') }}</label>
                        <input type="text" name="phone"  value="{{old('phone')}}"  placeholder="" class="form-control">
                    </div>
                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium text-capitalize">{{ __('text.upload_student_photo') }} (150px X 150px)</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    <div class="col-12 form-group mg-t-8 text-capitalize">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('text.word_save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
