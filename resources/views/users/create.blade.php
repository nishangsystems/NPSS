@extends('layout.base')



@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.add_new_user') }}</h3>
                </div>
            </div>
            <form class="new-added-form" method="post" action="{{route('user.store')}}"  enctype="multipart/form-data" >
                @csrf
               @if(request('type'))
                    <input type="hidden" value="{{request('type')}}" name="type">
               @endif
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_name') }} *</label>
                        <input type="text" name="name" value="{{old('name')}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_gender') }} *</label>
                        <select name="gender"  value="{{old('gender')}}" class="select2 text-capitalize">
                            <option value="">{{ __('text.please_select_gender') }} *</option>
                            <option value="male">{{ __('text.word_male') }}</option>
                            <option value="female">{{__('text.word_female')}}</option>
                        </select>
                    </div>
                    @if(!request('type'))
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label class="text-capitalize">{{ __('text.user_role') }} *</label>
                            <select name="type"  value="{{old('type')}}" class="select2">
                                <option value="">{{ __('text.please_select_role') }} *</option>
                               @foreach(\App\Role::all() as $role)
                                    <option value="{{$role->byLocale()->slug}}">{{$role->byLocale()->name}}</option>
                               @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_email') }} / {{__('text.word_username')}}</label>
                        <input type="text" name="username"  value="{{old('username')}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{__('text.word_address')}}</label>
                        <input type="text" name="address" value="{{old('address')}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_phone') }}</label>
                        <input type="text" name="phone"  value="{{old('phone')}}" placeholder="" class="form-control">
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


