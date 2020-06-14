@extends('layout.base')

@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Student Details Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="single-info-details">
                <div class="item-img">
                    <img src="{{route('image.render', $user->photo?$user->photo:'')}}" alt="image">
                </div>
                <div class="item-content">
                    <div class="header-inline item-header">
                        <h3 class="text-dark-medium font-medium">{{$user->name}}</h3>
                        <div class="header-elements">
                            <ul>
                                @if(\Auth::user()->hasRole('admin') && \Auth::user()->id != $user->id)
                                    <li><a href="{{route('roles.assign')}}?user={{$user->slug}}">Edit Role</a></li>
                                @endif

                                @if(\Auth::user()->id == $user->id)
                                    <li><a href="{{route('user.edit',$user->slug)}}?user={{$user->slug}}">Edit Profile</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="info-table table-responsive">
                        <table class="table text-nowrap">
                            <tbody>
                            <tr>
                                <td>Name:</td>
                                <td class="font-medium text-dark-medium">{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>Gender:</td>
                                <td class="font-medium text-dark-medium">{{$user->gender}}</td>
                            </tr>
                            <tr>
                                <td>Occupation:</td>
                                <td class="font-medium text-dark-medium">{{$user->roles->first()->name}}</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td class="font-medium text-dark-medium">{{$user->address}}</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td class="font-medium text-dark-medium">{{$user->phone}}</td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td class="font-medium text-dark-medium">{{$user->email}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Student Details Area End Here -->
@endsection
