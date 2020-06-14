@extends('layout.base')

@section('title')
   Result
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Choose Class</h3>
                </div>
            </div>
            <div class="row px-2">
                @foreach($classes as $class)
                    <div class="col-md-3 card">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <a class="text-dark" href="{{route('result.class.student',$class->id)}}">{{$class->name}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
@endsection
