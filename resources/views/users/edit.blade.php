@extends('layout.base')

@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <form class="new-added-form" method="post" action="{{route('user.update',$user->slug)}}"  enctype="multipart/form-data" >
                @csrf
                <input type="hidden" value="put" name="_method">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Name *</label>
                        <input type="text" name="name" value="{{old('name')?old('name'):$user->name}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Gender *</label>
                        <select name="gender"  value="{{old('gender')}}" class="select2">
                            <option {{(old('name')?old('name'):$user->name == 'male')?'selected':''}} value="male">Male</option>
                            <option {{(old('name')?old('name'):$user->name == 'female')?'selected':''}} value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>E-Mail / Username</label>
                        <input type="text" name="username"  value="{{old('username')?old('username'):$user->email}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Address</label>
                        <input type="text" name="address" value="{{old('address')?old('address'):$user->address}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone</label>
                        <input type="text" name="phone"  value="{{old('phone')?old('phone'):$user->phone}}" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Password</label>
                        <input type="text"  name="password"  value="" placeholder="" class="form-control">
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


