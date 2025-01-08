@extends('layout.base')



@section('section')
    <div class="row">
        <div class=" col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title text-capitalize">
                            <h3>{{ __('text.word_edit') }} {{$subject->name}}</h3>
                        </div>
                    </div>
                    <form class="new-added-form" method="post" action="{{route('subject.update',$subject->slug)}}">
                        @csrf
                        <input name="_method" value="put" type="hidden">
                        <div class="row">
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label class="text-capitalize">{{ __('text.subject_name') }} *</label>
                                <input type="text" value="{{old('name', $subject->name)}}" name="name" placeholder="" class="form-control">
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label class="text-capitalize">{{ __('text.word_score') }} *</label>
                                <input type="number" value="{{old('score', $subject->score)}}" name="score" placeholder="" class="form-control">
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label class="text-capitalize">{{ __('text.select_section') }} *</label>
                                <select name="section" class="select2">
                                    <option value="0">{{ __('text.select_section') }}</option>
                                    @foreach(\App\Section::all() as $class)
                                        <option {{old('section', $subject->section_id)==$class->id?'selected':''}} value="{{$class->id}}">{{$class->byLocale()->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label class="text-capitalize">{{ __('text.enter_code') }}</label>
                                <input type="text" value="{{old('code', $subject->code)}}" name="code" placeholder="" class="form-control">
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


