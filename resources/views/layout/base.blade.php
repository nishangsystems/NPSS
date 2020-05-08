<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{env('APP_NAME','Laravel')}}  @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img')}}/favicon.png">
    <link rel="stylesheet" href="{{asset('assets/css')}}/normalize.css">
    <link rel="stylesheet" href="{{asset('assets/css')}}/main.css">
    <link rel="stylesheet" href="{{asset('assets/css')}}/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/css')}}/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/fonts')}}/flaticon.css">
    <link rel="stylesheet" href="{{asset('assets')}}/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{asset('assets/css')}}/animate.min.css">
    @yield('style')
    <link rel="stylesheet" href="{{asset('assets/css')}}/style.css">
    <script src="{{asset('assets/js')}}/modernizr-3.6.0.min.js"></script>
</head>

<body>
<!-- Preloader Start Here -->
<div id="preloader"></div>
<!-- Preloader End Here -->
<div id="wrapper" class="wrapper bg-ash">
    <!-- Header Menu Area Start Here -->
    <div class="navbar navbar-expand-md header-menu-one bg-light">
        <div class="nav-bar-header-one">
            <div class="header-logo">
                <a href="{{route('home')}}">
                    <img src="{{asset('assets/img')}}/logo.png" alt="logo">
                </a>
            </div>
            <div class="toggle-button sidebar-toggle">
                <button type="button" class="item-link">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                </button>
            </div>
        </div>
        <div class="d-md-none mobile-nav-bar">
            <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
                <i class="far fa-arrow-alt-circle-down"></i>
            </button>
            <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
            <ul class="navbar-nav">
                <li class="navbar-item header-search-bar">
                    <div class="input-group stylish-input-group">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="flaticon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                        <input type="text" class="form-control" placeholder="Find Something . . .">
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="navbar-item dropdown header-admin">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                       aria-expanded="false">
                        <div class="admin-title">
                            <h5 class="item-title">{{request()->user()->first_name}} {{request()->user()->last_name}}</h5>
                            <span>{{request()->user()->roles()->first()->byLocale()->name}}</span>
                        </div>
                        <div class="admin-img">
                            <img src="{{asset('assets/img')}}/figure/admin.jpg" alt="Admin">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="item-header">
                            <h6 class="item-title">{{request()->user()->first_name}} {{request()->user()->last_name}}</h6>
                        </div>
                        <div class="item-content">
                            <ul class="settings-list">
                                <li><a href="{{route('user.show',1)}}?type=teacher"><i class="flaticon-user"></i>My Profile</a></li>
                                <li><a href="{{route('message.index')}}"><i class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i>Message</a></li>
                                <li><a href="{{route('user.edit',1)}}?type=teacher"><i class="flaticon-gear-loading"></i>Account Settings</a></li>
                                <li><a href="{{route('logout')}}"><i class="flaticon-turn-off"></i>Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                @if(request()->user()->hasUnreadMessages())
                <li class="navbar-item dropdown header-message">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                       aria-expanded="false">
                        <i class="far fa-envelope"></i>
                        <div class="item-title d-md-none text-16 mg-l-10">Message</div>
                         <span>{{request()->user()->unreadMessageCount()}}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="item-header">
                            <h6 class="item-title">{{request()->user()->unreadMessageCount()}} New Message</h6>
                        </div>
                        <div class="item-content">
                            <div class="media">
                                <div class="item-img bg-skyblue author-online">
                                    <img src="{{asset('assets/img')}}/figure/student11.png" alt="{{asset('assets/img')}}">
                                </div>
                                <div class="media-body space-sm">
                                    <div class="item-title">
                                        <a href="#">
                                            <span class="item-name">John Glenn</span>
                                            <span class="item-time">18:30</span>
                                        </a>
                                    </div>
                                    <p>What is the reason of buy this item.
                                        Is it usefull for me.....</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </li>
                @endif
                <li class="navbar-item dropdown header-language">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-expanded="false"><i class="fas fa-globe-americas"></i>{{ strtoupper(app()->getLocale()) }}</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('locale','en')}}">English</a>
                        <a class="dropdown-item" href="{{route('locale','fr')}}">French</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- Header Menu Area End Here -->
    <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
            <div class="mobile-sidebar-header d-md-none">
                <div class="header-logo">
                    <a href="{{route('home')}}"><img src="{{asset('assets/img')}}/logo1.png" alt="logo"></a>
                </div>
            </div>
            <div class="sidebar-menu-content">
                <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>
                    </li>

                    <li class="nav-item sidebar-nav-item">
                        <a href="{{route('student.index')}}" class="nav-link"><i class="flaticon-classmates"></i><span>Students</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{route('student.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>All Students</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('student.create')}}" class="nav-link"><i class="fas fa-angle-right"></i>Admission Form</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="{{route('user.index')}}?type=teacher" class="nav-link"><i class="flaticon-multiple-users-silhouette"></i><span>Teachers</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{route('user.index')}}?type=teacher" class="nav-link"><i class="fas fa-angle-right"></i>All Teachers</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('user.create')}}?type=teacher" class="nav-link"><i class="fas fa-angle-right"></i>Add Teacher</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="{{route('user.index')}}?type=parent" class="nav-link"><i class="flaticon-couple"></i><span>Parents</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{route('user.index')}}?type=parent" class="nav-link"><i class="fas fa-angle-right"></i>All Parents</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('user.create')}}?type=parent" class="nav-link"><i class="fas fa-angle-right"></i>Add Parent</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="{{route('books.index')}}" class="nav-link"><i class="flaticon-books"></i><span>Library</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{route('books.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>All Book</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('books.create')}}" class="nav-link"><i class="fas fa-angle-right"></i>Add New Book</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="{{route('fee')}}" class="nav-link"><i class="flaticon-technological"></i><span>Fees & Expenses</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{route('fee')}}" class="nav-link"><i class="fas fa-angle-right"></i>All Fees Collection</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('expenses')}}" class="nav-link"><i class="fas fa-angle-right"></i>Expenses</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('class.index')}}" class="nav-link"><i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Class</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('subject.index')}}" class="nav-link"><i class="flaticon-open-book"></i><span>Subject</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('attendance.index')}}" class="nav-link"><i class="flaticon-checklist"></i><span>Attendance</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('transport.index')}}" class="nav-link"><i class="flaticon-bus-side-view"></i><span>Transport</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('notice.index')}}" class="nav-link"><i class="flaticon-script"></i><span>Notice</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('message.index')}}" class="nav-link"><i class="flaticon-chat"></i><span>Message</span></a>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-settings"></i><span>Account</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{route('user.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>Users</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('roles.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>Roles</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <!-- Breadcubs Area Start Here -->
            <div class="breadcrumbs-area">
                <h3>@yield('title')</h3>
                <ul>
                    <li>
                        <a href="{{route('home')}}">Home</a>
                    </li>
                </ul>
            </div>

            @yield('section')

            <footer class="footer-wrap-layout1">
                <div class="copyright">© Copyrights <a href="#">{{env('APP_NAME',"")}}</a> 2020. All rights reserved. Designed by <a href="#">@fritz</a></div>
            </footer>
        </div>
    </div>
    <!-- Page Area End Here -->
</div>

<script src="{{asset('assets/js')}}/jquery-3.3.1.min.js"></script>
<script src="{{asset('assets/js')}}/plugins.js"></script>
<script src="{{asset('assets/js')}}/popper.min.js"></script>
<script src="{{asset('assets/js')}}/bootstrap.min.js"></script>
<script src="{{asset('assets/js')}}/jquery.scrollUp.min.js"></script>
<script src="{{asset('assets/js')}}/main.js"></script>
<script src="{{asset('assets')}}/toastr/toastr.min.js"></script>
<script>
    @if(Session::has('success'))
        toastr.success('{{Session::get('success')}}');
    @endif

    @if(Session::has('error'))
        toastr.error('{{Session::get('error')}}');
    @endif

    @if(count($errors)>0)
    @foreach ($errors->all() as $e)
        toastr.error('{{$e}}');
    @endforeach
    @endif
</script>
@yield('script')
</body>

</html>
