@extends('layout.base')



@section('section')
    <div class="row">
        <div class=" col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title text-capitalize">
                            <h3>{{ __('text.import_old_student') }}</h3>
                        </div>
                    </div>
                    <form class="new-added-form" method="post" action="{{route('upload.csv')}}"  enctype="multipart/form-data" >
                        @csrf
                        <div class="row">

                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label class="text-capitalize">{{ __('text.select_section') }} *</label>
                                <select name="year" required class="select2">
                                    <option >{{ __('text.select_academic_year') }}</option>
                                    @foreach(\App\Session::all() as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label class="text-capitalize">{{ __('text.select_class') }} *</label>
                                <select name="class"  required class="select2">
                                    <option>{{ __('text.please_select_class') }}</option>
                                    @foreach(\App\Classes::all() as $class)
                                        <option value="{{$class->id}}">{{$class->section->name}} {{$class->byLocale()->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label class="text-capitalize">{{ __('text.select_csv_file') }}</label>
                                <input  required type="file" name="file" placeholder="" class="form-control">
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark text-capitalize">{{ __('text.word_save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
