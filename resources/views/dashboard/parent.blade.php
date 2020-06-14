@extends('layout.base')

@section('title')
    Parent Dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/jquery.dataTables.min.css">
@endsection

@section('section')
    <div class="row">
        <div class="col-3-xxxl col-sm-6 col-12">
            <div class="dashboard-summery-one">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon bg-light-red">
                            <i class="flaticon-money text-red"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Due Fees</div>
                            <div class="item-number"><span>$</span><span class="counter" data-num="4503">4,503</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3-xxxl col-sm-6 col-12">
            <div class="dashboard-summery-one">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon bg-light-magenta">
                            <i class="flaticon-shopping-list text-magenta"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Notifications</div>
                            <div class="item-number"><span class="counter" data-num="12">12</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3-xxxl col-sm-6 col-12">
            <div class="dashboard-summery-one">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon bg-light-yellow">
                            <i class="flaticon-mortarboard text-orange"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Result</div>
                            <div class="item-number"><span class="counter" data-num="16">16</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3-xxxl col-sm-6 col-12">
            <div class="dashboard-summery-one">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon bg-light-blue">
                            <i class="flaticon-money text-blue"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Expenses</div>
                            <div class="item-number"><span>$</span><span class="counter" data-num="193000">1,93,000</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard summery End Here -->
    <!-- Dashboard Content Start Here -->
    <div class="row">
        <div class="col-5-xxxl col-12">
            <div class="card dashboard-card-twelve">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>My Kids</h3>
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
                    <div class="kids-details-wrap">
                        <div class="row">
                            <div class="col-12-xxxl col-xl-6 col-12">
                                <div class="kids-details-box mb-5">
                                    <div class="item-img">
                                        <img src="{{asset('assets/img')}}/figure/student.png" alt="kids">
                                    </div>
                                    <div class="item-content table-responsive">
                                        <table class="table text-nowrap">
                                            <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td>Jessia Rose</td>
                                            </tr>
                                            <tr>
                                                <td>Gender:</td>
                                                <td>Female</td>
                                            </tr>
                                            <tr>
                                                <td>Class:</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>Roll:</td>
                                                <td>#2225</td>
                                            </tr>
                                            <tr>
                                                <td>Section:</td>
                                                <td>A</td>
                                            </tr>
                                            <tr>
                                                <td>Admission Id:</td>
                                                <td>#0021</td>
                                            </tr>
                                            <tr>
                                                <td>Admission Date:</td>
                                                <td>07.08.2017</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12-xxxl col-xl-6 col-12">
                                <div class="kids-details-box">
                                    <div class="item-img">
                                        <img src="{{asset('assets/img')}}/figure/student1.png" alt="kids">
                                    </div>
                                    <div class="item-content table-responsive">
                                        <table class="table text-nowrap">
                                            <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td>Jack Steve</td>
                                            </tr>
                                            <tr>
                                                <td>Gender:</td>
                                                <td>Male</td>
                                            </tr>
                                            <tr>
                                                <td>Class:</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td>Roll:</td>
                                                <td>#2205</td>
                                            </tr>
                                            <tr>
                                                <td>Section:</td>
                                                <td>A</td>
                                            </tr>
                                            <tr>
                                                <td>Admission Id:</td>
                                                <td>#0045</td>
                                            </tr>
                                            <tr>
                                                <td>Admission Date:</td>
                                                <td>07.08.2017</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7-xxxl col-12">
            <div class="card dashboard-card-eleven">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>All Expenses</h3>
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
                    <div class="table-box-wrap">
                        <form class="search-form-box">
                            <div class="row gutters-8">
                                <div class="col-lg-4 col-md-3 form-group">
                                    <input type="text" placeholder="Search by Exam ..."
                                           class="form-control">
                                </div>
                                <div class="col-lg-3 col-md-3 form-group">
                                    <input type="text" placeholder="Search by Subject ..."
                                           class="form-control">
                                </div>
                                <div class="col-lg-3 col-md-3 form-group">
                                    <input type="text" placeholder="dd/mm/yyyy" class="form-control">
                                </div>
                                <div class="col-lg-2 col-md-3 form-group">
                                    <button type="submit"
                                            class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive expenses-table-box">
                            <table class="table data-table text-nowrap">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input checkAll">
                                            <label class="form-check-label">ID</label>
                                        </div>
                                    </th>
                                    <th>Expanse</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>E-Mail</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                            <label class="form-check-label">#0021</label>
                                        </div>
                                    </td>
                                    <td>Exam Fees</td>
                                    <td>$150.00</td>
                                    <td class="badge badge-pill badge-success d-block mg-t-8">Paid</td>
                                    <td>akkhorschool@gmail.com</td>
                                    <td>22/02/2019</td>
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
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                            <label class="form-check-label">#0022</label>
                                        </div>
                                    </td>
                                    <td>Semister Fees</td>
                                    <td>$350.00</td>
                                    <td class="badge badge-pill badge-danger d-block mg-t-8">Due</td>
                                    <td>akkhorschool@gmail.com</td>
                                    <td>22/02/2019</td>
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
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                            <label class="form-check-label">#0023</label>
                                        </div>
                                    </td>
                                    <td>Exam Fees</td>
                                    <td>$150.00</td>
                                    <td class="badge badge-pill badge-success d-block mg-t-8">Paid</td>
                                    <td>akkhorschool@gmail.com</td>
                                    <td>22/02/2019</td>
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
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                            <label class="form-check-label">#0024</label>
                                        </div>
                                    </td>
                                    <td>Exam Fees</td>
                                    <td>$150.00</td>
                                    <td class="badge badge-pill badge-danger d-block mg-t-8">Due </td>
                                    <td>akkhorschool@gmail.com</td>
                                    <td>22/02/2019</td>
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
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                            <label class="form-check-label">#0025</label>
                                        </div>
                                    </td>
                                    <td>Exam Fees</td>
                                    <td>$150.00</td>
                                    <td class="badge badge-pill badge-success d-block mg-t-8">Paid</td>
                                    <td>akkhorschool@gmail.com</td>
                                    <td>22/02/2019</td>
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
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                            <label class="form-check-label">#0026</label>
                                        </div>
                                    </td>
                                    <td>Semister Fees</td>
                                    <td>$350.00</td>
                                    <td class="badge badge-pill badge-danger d-block mg-t-8">Due</td>
                                    <td>akkhorschool@gmail.com</td>
                                    <td>22/02/2019</td>
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
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                            <label class="form-check-label">#0027</label>
                                        </div>
                                    </td>
                                    <td>Exam Fees</td>
                                    <td>$150.00</td>
                                    <td class="badge badge-pill badge-success d-block mg-t-8">Paid</td>
                                    <td>akkhorschool@gmail.com</td>
                                    <td>22/02/2019</td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/js')}}/jquery.counterup.min.js"></script>
    <script src="{{asset('assets/js')}}/moment.min.js"></script>
    <script src="{{asset('assets/js')}}/jquery.waypoints.min.js"></script>
@endsection

