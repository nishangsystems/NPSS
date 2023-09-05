@extends('layout.base')

@section('section')
    <!-- Add Notice Area End Here -->
    <!-- All Notice Area Start Here -->
    <div>
        <div class="col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title text-capitalize">
                            <h3>{{ __('text.add_session') }}</h3>
                        </div>
                    </div>
                    <form class="mg-b-20" method="post" action="{{route('settings.sessionPost')}}">
                        @csrf
                        <div class="row gutters-8">
                            <div class="col-lg-6 col-12 form-group">
                                <input type="text" name="name" required placeholder="Session name" class="form-control">
                            </div>
                            <div class="col-lg-6 col-12 form-group">
                                <div>
                                    <button type="submit" class=" fw-btn-fill btn-gradient-yellow text-capitalize">{{ __('text.word_save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row px-2">
                @foreach(\App\Session::get() as $sequence)
                    <div class="col-md-3 card">
                       <div class="card-body d-flex justify-content-center align-items-center"> <div>{{$sequence->name}}</div></div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- All Notice Area End Here -->
    </div>
@endsection
