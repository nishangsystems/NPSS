@extends('layout.base')



@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Add New User</h3>
                </div>
            </div>
            <form class="new-added-form" method="post" action="{{route('user.store')}}"  enctype="multipart/form-data" >
                @csrf
               @if(request('type'))
                    <input type="hidden" value="{{request('type')}}" name="type">
               @endif
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Name *</label>
                        <input type="text" name="name" value="{{old('name')}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Gender *</label>
                        <select name="gender"  value="{{old('gender')}}" class="select2">
                            <option value="">Please Select Gender *</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    @if(!request('type'))
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>User Role *</label>
                            <select name="type"  value="{{old('type')}}" class="select2">
                                <option value="">Please Select Role *</option>
                               @foreach(\App\Role::all() as $role)
                                    <option value="{{$role->byLocale()->slug}}">{{$role->byLocale()->name}}</option>
                               @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>E-Mail / Username</label>
                        <input type="text" name="email"  value="{{old('email')}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Address</label>
                        <input type="text" name="address" value="{{old('address')}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone</label>
                        <input type="text" name="phone"  value="{{old('phone')}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Student Photo (150px X 150px)</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


