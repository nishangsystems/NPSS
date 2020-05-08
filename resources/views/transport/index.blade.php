@extends('layout.base')

@section('title')
    Admin Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div>
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>All Transport Lists</h3>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                           aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i
                                    class="fas fa-times text-orange-red"></i>Close</a>
                            <a class="dropdown-item" href="#"><i
                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i
                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                        </div>
                    </div>
                </div>
                <form class="mg-b-20">
                    <div class="row gutters-8">
                        <div class="col-lg-4 col-12 form-group">
                            <input type="text" placeholder="Search by Route ..." class="form-control">
                        </div>
                        <div class="col-lg-3 col-12 form-group">
                            <input type="text" placeholder="Search by Car Number ..."
                                   class="form-control">
                        </div>
                        <div class="col-lg-3 col-12 form-group">
                            <input type="text" placeholder="Search by Phone ..." class="form-control">
                        </div>
                        <div class="col-lg-2 col-12 form-group">
                            <button type="submit"
                                    class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead>
                        <tr>
                            <th>Vehicle No</th>
                            <th>Driver Name</th>
                            <th>Driver License</th>
                            <th>Contact Number</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($transports as $transport)
                                <tr>
                                    <td>{{$transport->vehicle_nu}}</td>
                                    <td>{{$transport->driver->first_name}} {{$transport->driver->last_name}}</td>
                                    <td>{{$transport->license}}</td>
                                    <td>{{$transport->phone}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false">
                                                <span class="flaticon-more-button-of-three-dots"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i
                                                        class="fas fa-times text-orange-red"></i>Close</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- All Transport List Area End Here -->
    </div>
    <!-- All Subjects Area End Here -->
@endsection

@section('script')
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
@endsection
