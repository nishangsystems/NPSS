@extends('layout.base')



@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Add New Book Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.new_message') }}</h3>
                </div>
            </div>
            <form method="post" action="{{route('message.index')}}" class="new-added-form">
                @csrf
                <input type="hidden" value="{{$action}}" name="action">
                <div class="row">
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.message_title') }} *</label>
                        <input  name="title" type="text" value="{{old('title', $title)}}" placeholder="Type Title Here" class="form-control">
                    </div>
                    <div class="col-6 form-group">
                        <label class="text-capitalize">{{ __('text.min_fee_owed') }}</label>
                        <input  placeholder="Enter Amount" name="amount" type="number" value="{{old('amount', $amount)}}" class="form-control">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label class="text-capitalize">{{ __('text.academic_year') }}</label>
                        <select class="select2"  value="{{old('year')}}"  required name="year">
                            @foreach(\App\Session::all() as $class)
                                <option {{($class->id == old('year',$year))?'selected':''}} value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_message') }} *</label>
                        <textarea  placeholder="Type Short Message Here"  name="message" cols="5" class="form-control">{{old('message',$message)}}</textarea>
                    </div>

                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_contacts') }} </label>
                        <textarea  cols="5" readonly name="contact" class="form-control">{{$contact}}</textarea>
                    </div>

                    <div class="col-12 form-group mg-t-8 text-capitalize">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{($action=='send')? __('text.word_send') : __('text.get_contacts')}}</button>
                        <a href="{{route('message.index')}}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('text.word_back') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add New Book Area End Here -->
@endsection


