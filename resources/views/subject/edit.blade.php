@extends('layout.base')



@section('section')
    <div class="row">
        <div class=" col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Edit {{$subject->name}}</h3>
                        </div>
                    </div>
                    <form class="new-added-form" method="post" action="{{route('subject.update',$subject->slug)}}">
                        @csrf
                        <input name="_method" value="put" type="hidden">
                        <div class="row">
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Subject Name *</label>
                                <input type="text" value="{{old('name', $subject->name)}}" name="name" placeholder="" class="form-control">
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Score *</label>
                                <input type="number" value="{{old('score', $subject->score)}}" name="score" placeholder="" class="form-control">
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Select Section *</label>
                                <select name="section" class="select2">
                                    <option value="0">Please Select Section</option>
                                    @foreach(\App\Section::all() as $class)
                                        <option {{old('section', $subject->section_id)==$class->id?'selected':''}} value="{{$class->id}}">{{$class->byLocale()->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Enter Code</label>
                                <input type="text" value="{{old('code', $subject->code)}}" name="code" placeholder="" class="form-control">
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


