@extends('layout.base')



@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Add New Book Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>New Message</h3>
                </div>
            </div>
            <form method="post" action="{{route('message.index')}}" class="new-added-form">
                @csrf
                <input type="hidden" value="{{$action}}" name="action">
                <div class="row">
                    <div class="col-12 form-group">
                        <label>Message Title *</label>
                        <input  name="title" type="text" value="{{old('title', $title)}}" placeholder="Type Title Here" class="form-control">
                    </div>
                    <div class="col-6 form-group">
                        <label>Minimum amount of fee owed</label>
                        <input  placeholder="Enter Amount" name="amount" type="number" value="{{old('amount', $amount)}}" class="form-control">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label>Academic Year</label>
                        <select class="select2"  value="{{old('year')}}"  required name="year">
                            @foreach(\App\Session::all() as $class)
                                <option {{($class->id == old('year',$year))?'selected':''}} value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 form-group">
                        <label>Message *</label>
                        <textarea  placeholder="Type Short Message Here"  name="message" cols="5" class="form-control">{{old('message',$message)}}</textarea>
                    </div>

                    <div class="col-12 form-group">
                        <label>Contacts </label>
                        <textarea  cols="5" readonly name="contact" class="form-control">{{$contact}}</textarea>
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{($action=='send')?'Send':'Get Contacts'}}</button>
                        <a href="{{route('message.index')}}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add New Book Area End Here -->
@endsection


