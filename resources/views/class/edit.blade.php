@extends('layout.base')

@section('section')
    <div class="row">
            <div class="col-12">
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title text-capitalize">
                                <h3>{{ __('text.word_edit') }} {{$class->name}}</h3>
                            </div>
                        </div>
                        <form class="new-added-form" method="post" action="{{route('class.update', $class->id)}}">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label class="text-capitalize">{{ __('text.class_name') }} *</label>
                                    <input type="text" value="{{old('name')?old('name'):$class->name}}" name="name" placeholder="{{$class->name}}" class="form-control">
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

