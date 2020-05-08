@extends('layout.base')

@section('title')
    Admin Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/select2.min.css">
@endsection

@section('section')
    <div class="row">
        <!-- Student Attendence Search Area Start Here -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Student Attendence</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <form class="new-added-form" action="{{route('attendance.show',1)}}">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Select Class</label>
                                <select class="select2" required>
                                    <option value="">Select Class</option>
                                    @foreach(\App\Classes::all() as $session)
                                        <option value="{{$session->id}}">{{$session->byLocale()->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Select Section</label>
                                <select class="select2">
                                    <option value="0">Select Section</option>
                                    <option value="1">A</option>
                                    <option value="2">B</option>
                                    <option value="3">C</option>
                                    <option value="4">D</option>
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Select Month</label>
                                <select class="select2">
                                    <option value="0">Select Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Select Session</label>
                                <select class="select2" required>
                                    <option value="0">Select Session</option>
                                    @foreach(\App\Session::all() as $session)
                                        <option value="{{$session->id}}">{{$session->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Check</button>
                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Student Attendence Search Area End Here -->
        <!-- Student Attendence Area Start Here -->
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js')}}/select2.min.js"></script>
@endsection

