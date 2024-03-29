
@extends('layout.base')



@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Add Expense Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title text-capitalize">
                    <h3>{{ __('text.add_new_role') }}</h3>
                </div>
            </div>
            <form class="new-added-form" method="post" action="{{route('roles.store')}}">
                @csrf
                <div class="row">
                    <div class="col-12 form-group">
                        <label class="text-capitalize">{{ __('text.word_name') }} *</label>
                        <input type="text" name="name" placeholder="" class="form-control">
                    </div>
                    <div class="row my-5 mx-3">
                        @foreach(\App\Permission::all() as $p)
                            <div class="col-md-3 my-2">
                                <div class="form-check">
                                    <input type="checkbox" value="{{$p->id}}" name="permissions[]" class="form-check-input">
                                    <label class="form-check-label">{{$p->name}}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12 form-group mg-t-8 text-capitalize">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('text.word_save') }}</button>
                        <a href="{{route('roles.index')}}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('text.word_reset') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection



