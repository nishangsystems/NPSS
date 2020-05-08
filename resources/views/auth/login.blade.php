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
    <link rel="stylesheet" href="{{asset('assets/css')}}/animate.min.css">
    <link rel="stylesheet" href="{{asset('assets/css')}}/style.css">
    <script src="{{asset('assets/js')}}/modernizr-3.6.0.min.js"></script>
</head>

<body>
<div id="preloader"></div>
<div class="login-page-wrap">
    <div class="login-page-content">
        <div class="login-box">
            <div class="item-logo">
                <img src="{{asset('assets/img')}}/logo2.png" alt="logo">
            </div>
            <form action="index.html" class="login-form">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" placeholder="Enter usrename" class="form-control">
                    <i class="far fa-envelope"></i>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" placeholder="Enter password" class="form-control">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember-me">
                        <label for="remember-me" class="form-check-label">Remember Me</label>
                    </div>
                    <a href="#" class="forgot-btn">Forgot Password?</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="login-btn">Login</button>
                </div>
            </form>
    </div>
</div>
<script src="{{asset('assets/js')}}/jquery-3.3.1.min.js"></script>
<script src="{{asset('assets/js')}}/plugins.js"></script>
<script src="{{asset('assets/js')}}/popper.min.js"></script>
<script src="{{asset('assets/js')}}/bootstrap.min.js"></script>
<script src="{{asset('assets/js')}}/jquery.scrollUp.min.js"></script>
<script src="{{asset('assets/js')}}/main.js"></script>
</body>

</html>
