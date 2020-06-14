@extends('layout.base')
@section('section')
    <div class="row">
        <div class="col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Nursery School</h3>
                        </div>
                    </div>
                    <div class="row my-5">
                        @foreach(\App\Classes::where('section_id',1)->get() as $class)
                            <div class="col-md-3 card">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <a class="text-dark" href="{{route('class.section',$class->id)}}?action={{request('action')}}">{{$class->byLocale()->name}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Primary School</h3>
                        </div>
                    </div>
                    <div class="row my-5">
                        @foreach(\App\Classes::where('section_id',2)->get() as $class)
                            <div class="col-md-3 card">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <a class="text-dark" href="{{route('class.section',$class->id)}}?action={{request('action')}}">{{$class->byLocale()->name}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

