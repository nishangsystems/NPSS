@extends('layout.base')

@section('section')
    <!-- Breadcubs Area End Here -->
    <!-- Student Details Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="single-info-details">
                <div class="item-img">
                    <img src="{{asset('assets/img')}}/figure/parents.jpg" alt="student">
                </div>
                <div class="item-content">
                    <div class="header-inline item-header">
                        <h3 class="text-dark-medium font-medium">{{$user->first_name}} {{$user->last_name}}</h3>
                        <div class="header-elements">
                            <ul>
                                @if(\Auth::user()->hasRole('admin'))
                                    <li><a href="{{route('roles.assign')}}?user={{$user->slug}}"><i class="far fa-edit"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <p>Aliquam erat volutpat. Curabiene natis massa sedde lacu stiquen sodale
                        word moun taiery.Aliquam erat volutpaturabiene natis massa sedde  sodale
                        word moun taiery.</p>
                    <div class="info-table table-responsive">
                        <table class="table text-nowrap">
                            <tbody>
                            <tr>
                                <td>Name:</td>
                                <td class="font-medium text-dark-medium">Steven Jones</td>
                            </tr>
                            <tr>
                                <td>Gender:</td>
                                <td class="font-medium text-dark-medium">Male</td>
                            </tr>
                            <tr>
                                <td>Occupation:</td>
                                <td class="font-medium text-dark-medium">Business</td>
                            </tr>
                            <tr>
                                <td>ID:</td>
                                <td class="font-medium text-dark-medium">#15059</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td class="font-medium text-dark-medium">House #10, Road #6, Australia</td>
                            </tr>
                            <tr>
                                <td>Religion:</td>
                                <td class="font-medium text-dark-medium">Islam</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td class="font-medium text-dark-medium">+ 88 98568888418</td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td class="font-medium text-dark-medium">jessiarose@gmail.com</td>
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
