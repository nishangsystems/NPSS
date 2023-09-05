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
    <link rel="stylesheet" href="{{asset('public/assets')}}/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/fonts')}}/flaticon.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/animate.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/style.css">
    <script src="{{asset('public/assets/js')}}/modernizr-3.6.0.min.js"></script>
</head>

<body>
<div id="preloader"></div>
<div class="login-page-wrap">
    <div class="login-page-content">
        <div class="login-box">
            <div class="item-logo">
                <img style="height:80px" src="{{asset('public/assets/img')}}/logo2.png" alt="logo">
            </div>
            <form action="{{route('login.submit')}}" method="post" class="login-form">
                @csrf
                <div class="form-group">
                    <label class="text-capitalize">{{ __('text.word_username')}}</label>
                    <input type="text" placeholder="{{ __('text.enter_username_slash_email') }} "  name="email" class="form-control">
                    <i class="far fa-envelope"></i>
                </div>
                <div class="form-group">
                    <label class="text-capitalize">{{ __('text.word_password') }}</label>
                    <input type="password" placeholder="{{ __('text.enter_password') }}" name="password" class="form-control">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember-me">
                        <label for="remember-me" name="remember" class="form-check-label text-capitalize">{{ __('text.remember_me') }}</label>
                    </div>
                    <a href="#" class="forgot-btn text-capitalize">{{ __('text.forgot_password') }}</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="login-btn text-capitalize">{{ __('text.word_login') }}</button>
                </div>
            </form>
    </div>
</div>
<script src="{{asset('public/assets/js')}}/jquery-3.3.1.min.js"></script>
<script src="{{asset('public/assets/js')}}/plugins.js"></script>
<script src="{{asset('public/assets/js')}}/popper.min.js"></script>
<script src="{{asset('public/assets/js')}}/bootstrap.min.js"></script>
<script src="{{asset('public/assets/js')}}/jquery.scrollUp.min.js"></script>
<script src="{{asset('public/assets/js')}}/main.js"></script>
<script src="{{asset('public/assets')}}/toastr/toastr.min.js"></script>
<script>
    // $("#password").password('toggle');
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

</body>

</html>
