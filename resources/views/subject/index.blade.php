@extends('layout.base')

@section('title')
    Admin Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="row">
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>All Subjects</h3>
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
                            <input type="text" placeholder="Search by Exam ..." class="form-control">
                        </div>
                        <div class="col-lg-3 col-12 form-group">
                            <input type="text" placeholder="Search by Subject ..." class="form-control">
                        </div>
                        <div class="col-lg-3 col-12 form-group">
                            <input type="text" placeholder="dd/mm/yyyy" class="form-control">
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
                            <th>Subject Name</th>
                            <th>Subject Type</th>
                            <th>Class</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{$subject->byLocale()->name}}</td>
                                    <td>{{$subject->byLocale()->type}}</td>
                                    <td>{{$subject->class->byLocale()->name}}</td>
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
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
@endsection
