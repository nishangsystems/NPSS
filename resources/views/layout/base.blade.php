<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{env('APP_NAME','Laravel')}}  @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/assets/img')}}/favicon.png">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/normalize.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/main.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/all.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/fonts')}}/flaticon.css">
    <link rel="stylesheet" href="{{asset('public/assets')}}/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/animate.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/select2.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/datepicker.min.css">
    @yield('style')
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/style.css">
    <script src="{{asset('public/assets/js')}}/modernizr-3.6.0.min.js"></script>
</head>

<body>
<div id="preloader"></div>
<div id="wrapper" class="wrapper bg-ash">
    <div class="navbar navbar-expand-md header-menu-one bg-light">
        <div class="nav-bar-header-one">
            <div class="header-logo">
                <a href="{{route('dashboard')}}">
                    <img style="height :50px;" src="{{asset('public/assets/img')}}/logo.png" alt="logo">
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
            <ul class="navbar-nav text-capitalize">
                <li class="navbar-item header-admin">
                    {{ __('text.powered_by_nushang_system') }}
                </li>

                <li class="navbar-item header-admin">
                  <h4 class="mb-0 text-danger font-weight-bold"> {{ \App\Session::find(getYear())->name}} {{ __('text.academic_year') }}</h4>
                </li>
            </ul>
            <ul class="navbar-nav">
                @if(\Auth::user()->class(getYear()))
                    <li class="navbar-item header-admin">
                        <div class="input-group stylish-input-group">
                            <a href="{{route('student.index')}}?class={{\Auth::user()->class(getYear())->id}}">{{\Auth::user()->class(getYear())->class->name}} {{\Auth::user()->class(getYear())->section_id}}</a>
                        </div>
                    </li>
                @endif

                <li class="navbar-item dropdown header-admin">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                       aria-expanded="false">
                        <div class="admin-title">
                            <h5 class="item-title">{{request()->user()->name}}</h5>
                            <span>{{request()->user()->roles()->first()->byLocale()->name}}</span>
                        </div>
                        <div class="admin-img">
                            <img style="height: 50px;" src="{{route('image.render', Auth::user()->photo?Auth::user()->photo:'')}}">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="item-header">
                            <h6 class="item-title">{{request()->user()->name}}</h6>
                        </div>
                        <div class="item-content">
                            <ul class="settings-list text-capitalize">
                                <li><a href="{{route('user.show',\Auth::user()->slug)}}"><i class="flaticon-user"></i>{{ __('text.my_profile') }}</a></li>
                                <li><a href="{{route('user.edit',\Auth::user()->slug)}}"><i class="flaticon-gear-loading"></i>{{ __('text.Account Settings') }}</a></li>
                                <li><a href="{{route('user.password')}}"><i class="flaticon-gear-loading"></i>{{ __('text.change_password') }}</a></li>
                                <li><a href="{{route('logout')}}"><i class="flaticon-turn-off"></i>{{ __('text.log_out') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                @if(request()->user()->hasUnreadMessages())
                <li class="navbar-item dropdown header-message">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                       aria-expanded="false">
                        <i class="far fa-envelope"></i>
                        <div class="item-title d-md-none text-16 mg-l-10 text-capitalize">{{ __('text.word_message') }}</div>
                         <span>{{request()->user()->unreadMessageCount()}}</span>
                    </a>
                </li>
                @endif
                <li class="navbar-item dropdown header-language">
                    <a class="navbar-nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-expanded="false"><i class="fas fa-globe-americas"></i>{{ strtoupper(app()->getLocale()) }}</a>
                    <div class="dropdown-menu dropdown-menu-right text-capitalize">
                        <a class="dropdown-item" href="{{route('locale','en')}}">{{ __('text.word_english') }}</a>
                        <a class="dropdown-item" href="{{route('locale','fr')}}">{{ __('text.word_french') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="dashboard-page-one">
        <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
            <div class="mobile-sidebar-header d-md-none">
                <div class="header-logo">
                    <a href="{{route('dashboard')}}"><img style="height: 45px;" src="{{asset('public/assets/img')}}/logo1.png" alt="logo"></a>
                </div>
            </div>
            <div class="sidebar-menu-content">
                <ul class="nav nav-sidebar-menu sidebar-toggle-view text-capitalize">
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link"><i class="flaticon-dashboard"></i><span>{{ __('text.word_dashboard') }}</span></a>
                    </li>
                    @if(\Auth::user()->can('select_fee','update_fee','create_fee') )
                        <li class="nav-item sidebar-nav-item">
                            <a href="{{route('fee')}}" class="nav-link"><i class="flaticon-technological"></i><span>{{ __('text.fees&expnses') }}</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="{{route('expenses.type.post')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.expense_type') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('fee.type')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{__('text.create_income_type')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('fee.student')}}?action=fee" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.received_fees') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('fee')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.undo_fee') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('fee.print')}}?action=reciept" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.print_receipts') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('expenses')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.record_expenses') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('fee.student')}}?action=completed" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.fee_report') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('fee.student')}}?action=giftscholarship" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.give_scholarship') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('fee.drive')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.fee_drive') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('class.fee')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.configure_class_fee') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('fee.student')}}?action=scholarship" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.scholarship_reports') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('fee.income')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.income_statement') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('fee.monthly.report')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.monthly_report') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('fee.monthly.receipt')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.monthly_receipt') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (\Auth::user()->can('create_class','see_class','delete_class'))
                        <li class="nav-item">
                            <a href="{{route('class.index')}}" class="nav-link text-capitalize"><i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>{{ __('text.word_class') }}</span></a>
                        </li>
                    @endif
                    @if (\Auth::user()->can('create_student'))
                        <li class="nav-item sidebar-nav-item text-capitalize">
                            <a href="{{route('student.index')}}" class="nav-link"><i class="flaticon-classmates"></i><span>{{ __('text.pupils_center') }}</span></a>
                            <ul class="nav sub-group-menu">
                                @if (\Auth::user()->can('create_student'))
                                    <li class="nav-item">
                                        <a href="{{route('student.create')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.enroll_pupil') }}</a>
                                    </li>
                                @endif
                                    <li class="nav-item">
                                        <a href="{{route('class.index')}}?action=student" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.class_list') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('student.promote')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.promote_pupil') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('student.changeClass')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{__('text.change_class')}}</a>
                                    </li>
                            </ul>
                        </li>
                    @endif

                    @if(\Auth::user()->hasRole('admin'))
                        <li class="nav-item sidebar-nav-item text-capitalize">
                            <a href="{{route('user.index')}}?type=parent" class="nav-link"><i class="flaticon-couple"></i><span>{{__('text.parent_center')}}</span></a>
                            <ul class="nav sub-group-menu">

                                @if (\Auth::user()->can('create_user'))
                                    <li class="nav-item">
                                        <a href="{{route('user.create')}}?type=parent" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.create_parent') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('user.index')}}?type=assign_parent" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.assign_to_pupil') }}</a>
                                    </li>
                                @endif

                                <li class="nav-item">
                                    <a href="{{route('user.index')}}?type=parent" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.all_parents') }}</a>
                                </li>
                                    <li class="nav-item">
                                        <a href="{{route('pupil.parent')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.pupil_parent') }}</a>
                                    </li>
                            </ul>
                        </li>
                    @endif
{{-- 
                    @if (\Auth::user()->can('create_subject','see_class','delete_class'))
                        <li class="nav-item sidebar-nav-item text-capitalize">
                            <a href="{{route('subject.index')}}?type=parent" class="nav-link"><i class="flaticon-open-book"></i><span>{{ __('text.word_subjects') }}</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a  href="{{route('subject.create')}}" class="nav-link"><i class="fas fa-angle-right"></i><span>{{ __('text.create_subject') }}</span></a>
                                </li>
                                @if (\Auth::user()->hasRole('admin'))
                                    <li class="nav-item">
                                        <a href="{{route('subject.index')}}"  class="nav-link"><i class="fas fa-angle-right"></i><span>{{ __('text.all_subjects') }}</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif --}}
{{-- 
                    <li class="nav-item sidebar-nav-item text-capitalize">
                        <a href="{{route('fee')}}" class="nav-link"><i class="flaticon-technological"></i><span>{{ __('text.word_result') }}</span></a>
                        <ul class="nav sub-group-menu">
                           @if(\Auth::user()->hasRole('admin'))
                                <li class="nav-item">
                                    <a href="{{route('result.class')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.word_class') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('result.fee_control')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.fee_control_print') }}</a>
                                </li>
                           @elseif(\Auth::user()->hasRole('teacher'))
                                <li class="nav-item">
                                    <a href="{{route('result.class.student','teacher')}}?action=recordmarks" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.record_marks') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('result.ranksheet')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.rank_students') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('result.class.student','teacher')}}?action=print" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.print_results') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('result.fee_control')}}?year={{getYear()}}&class=0" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.fee_controlled_print') }}</a>
                                </li>
                           @else
                                <li class="nav-item">
                                    <a href="{{route('result.class.student','parent')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.word_student') }}</a>
                                </li>
                           @endif

                           @if(\Auth::user()->students->count() > 0)
                               <li class="nav-item">
                                   <a href="{{route('result.class.student','mine')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.my_children') }}</a>
                               </li>
                           @endif

                        </ul>
                    </li> --}}
                    @if(\Auth::user()->class(getYear()))
                        <li class="nav-item text-capitalize">
                            <a href="{{route('student.index')}}?class={{\Auth::user()->class(getYear())->id}}" class="nav-link"><i class="flaticon-dashboard"></i><span>{{ __('text.class_list') }}</span></a>
                        </li>
                    @endif
                   @if(\Auth::user()->hasRole('admin'))


                        <li class="nav-item sidebar-nav-item text-capitalize">
                            <a href="#" class="nav-link"><i class="flaticon-settings"></i><span>{{ __('text.users&accounts') }}</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="{{route('user.create')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.create_new_user') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('roles.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.word_roles') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('user.index')}}?action=password" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.change_user_password') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('user.index')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.view_users') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item text-capitalize">
                            <a href="#" class="nav-link"><i class="flaticon-settings-work-tool"></i><span>{{ __('text.word_setting') }}</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="{{route('settings.session')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.academic_year') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('settings.terms')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.word_terms') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('settings.sequences')}}" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.word_sequencies') }}</a>
                                </li>
                                <li class="nav-item">
                                    <span onclick="ShowModal()" class="nav-link"><i class="fas fa-angle-right"></i>{{ __('text.configure_year_and_sequence') }}</span>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item sidebar-nav-item text-capitalize">
                            <a href="#" class="nav-link"><i class="fas fa-inbox"></i><span>{{ __('text.abbr_sms') }}</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="{{route('message.index')}}" class="nav-link"><i class="fas fa-angle-right"></i><span>{{ __('text.sms_center') }}</span></a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('message.create')}}" class="nav-link"><i class="fas fa-angle-right"></i><span>{{ __('text.new_sms') }}</span></a>
                                </li>
                            </ul>
                        </li>

                   @endif
                </ul>
            </div>
        </div>

        @if(\Auth::user()->hasRole('admin'))
            <div class="modal fade" id="yearModal"  role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <form method="post" class="modal-content" action="{{route('config.set')}}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">{{ __('text.config_request') }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 form-group text-capitalize">
                                <label>{{ __('text.current_academic_year') }} *</label>
                                <select class="select2" name="year" required>
                                    <option value="">{{ __('text.select_academic_year') }} *</option>
                                    @foreach(\App\Session::get() as $session)
                                         <option {{$session->id == getYear() ? 'selected':''}} value="{{$session->id}}">{{$session->name}}</option>
                                    @endforeach
                                </select>

                                <label>{{ __('text.current_sequence') }} *</label>
                                <select class="select2" name="sequence" required>
                                    <option value="">{{__('text.please_select_sequence')}} *</option>
                                    @foreach(\App\Sequence::get() as $session)
                                        <option {{$session->id == getTerm() ? 'selected':''}}  value="{{$session->id}}">{{$session->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-gradient-yellow text-white text-capitalize">{{__('text.word_save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="dashboard-content-one">
            <div class="breadcrumbs-area text-capitalize d-flex">
                <h3>@yield('title')</h3> 
                <a href="{{route('student.create')}}" class="btn btn-primary btn-lg ml-5 h6"><i class="fa fa-plus mr-2"></i>{{ __('text.enroll_pupil') }}</a>
                <a href="{{route('fee.student')}}?action=fee" class="btn btn-success btn-lg ml-5 h6"><i class="fas fa-angle-right"></i>{{ __('text.received_fees') }}</a>
                <a href="{{url('/student')}}?action=fee" class="btn btn-dark btn-lg ml-5 h6"><i class="fas fa-angle-right"></i>{{ __('text.all_pupil') }}</a>
                
            </div>
            @yield('section')
        </div>
    </div>
</div>


<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 text-capitalize text-center">
               {{ __('text.powered_by_nushang_system') }}
            </div><!-- .col-12 -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .footer-bar -->
</footer><!-- .site-footer -->

<script src="{{asset('public/assets/js')}}/jquery-3.3.1.min.js"></script>
<script src="{{asset('public/assets/js')}}/plugins.js"></script>
<script src="{{asset('public/assets/js')}}/popper.min.js"></script>
<script src="{{asset('public/assets/js')}}/bootstrap.min.js"></script>
<script src="{{asset('public/assets/js')}}/moment.min.js"></script>
<script src="{{asset('public/assets/js')}}/jquery.scrollUp.min.js"></script>
<script src="{{asset('public/assets/js')}}/main.js"></script>
<script src="{{asset('public/assets')}}/toastr/toastr.min.js"></script>
<script src="{{asset('public/assets/js')}}/select2.min.js"></script>
<script src="{{asset('public/assets/js')}}/datepicker.min.js"></script>
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

    @if(\Auth::user()->hasRole('admin') && (getYear()==0 || getTerm() == 0))
        $('#yearModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    @endif

    function ShowModal(){
        $('#yearModal').modal().show()
    }
</script>
@yield('script')
</body>

</html>
