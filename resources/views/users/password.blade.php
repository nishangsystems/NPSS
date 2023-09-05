@extends('layout.base')

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.change_password') }}</h3>
                </div>
            </div>
            <form class="new-added-form" method="post" action="{{route('user.password.post')}}">
                @csrf
                <div class="row">
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.enter_old_password') }}</label>
                        <input type="password" name="old_password" value="{{old('old_password')}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.new_password') }}</label>
                        <input type="password" name="password" value="{{old('new')}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark text-capitalize">{{ __('text.word_save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection



