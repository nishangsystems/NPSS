<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/main.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/style.css">
    <link rel="stylesheet" href="{{asset('public/assets/css')}}/jquery.dataTables.min.css">
</head>

<body>
<div class="row">
    <div class="col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>{{$title}}</h3>
                    </div>
                </div>
                <div class="my-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('public/assets/js')}}/jquery-3.3.1.min.js"></script>
<script src="{{asset('public/assets/js')}}/plugins.js"></script>
<script src="{{asset('public/assets/js')}}/popper.min.js"></script>
<script src="{{asset('public/assets/js')}}/bootstrap.min.js"></script>
<script src="{{asset('public/assets/js')}}/jquery.dataTables.min.js"></script>
</body>

</html>
