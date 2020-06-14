@extends('layout.base')

@section('title')
    Admin Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All System Users</h3>
                </div>

            </div>
            <form class="mg-b-20">
                <div class="row gutters-8">
                    <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by ID ..." class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Name ..." class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Phone ..." class="form-control">
                    </div>
                    <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                        <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>E-mail</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center"><img src="{{route('image.render', $user->photo?$user->photo:' ')}}" width="30"></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->gender}}</td>
                            <td>{{$user->roles->first()->name}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if(request('type') == 'assign_parent')
                                    <a class="btn btn-primary" href="{{route('parent.assign',$user->slug)}}"><i
                                            class="fas fa-cogs"></i> Assign Student</a>
                                 @else
                                    <a class="btn btn-primary" href="{{route('roles.assign')}}?user={{$user->slug}}"><i
                                            class="fas fa-cogs text-dark-pastel-green"></i> Edit</a>
                                    <a class="btn btn-success" href="{{route('user.show',$user->slug)}}"><i
                                            class="fa fa-eye text-orange-peel"></i> View</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
@endsection
