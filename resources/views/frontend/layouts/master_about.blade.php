<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">

    <meta name="description" content="@yield('meta_description', $generalsetting->meta_description)"/>
    <meta name="keywords" content="@yield('meta_keywords', $generalsetting->meta_keywords)">
    <meta name="author" content="{{ $generalsetting->st_name_site }}">
    <meta property="og:title" content="@yield('title', $generalsetting->meta_keywords)"/>
    <meta property="og:image" content="@yield('thumbnail_img', asset($generalsetting->st_logo))"/>
    <meta property="og:description" content="@yield('meta_description', $generalsetting->meta_description)"/>
    <meta property="og:site_name" content="{{ $generalsetting->st_name_site }}"/>
    @yield('meta')

    <title>@yield('title') - {{ $generalsetting->st_name_site }}</title>
    <link name="favicon" type="image/x-icon" href="{{ asset($generalsetting->favicon) }}" rel="shortcut icon"/>

    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.min.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/font-awesome/css/all.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/swipper.min.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}?v={{ config('user.version') }}">
    @yield('bottom_style')

    <script type='text/javascript' src="{{asset('frontend/js/jquery.min.js')}}?v={{ config('user.version') }}"></script>
</head>
<body>
    @yield('content')

    <script type='text/javascript' src="{{asset('frontend/js/jquery-ui.min.js')}}?v={{ config('user.version') }}"></script>
    <script type='text/javascript' src='{{asset('frontend/js/bootstrap.min.js')}}'></script>
    <script type='text/javascript' src='{{asset('frontend/js/swipper.min.js')}}'></script>
    <!-- Sweet-Alert  -->
    <script type="text/javascript" src="{{ asset('frontend/js/sweetalert2.all.min.js') }}"></script>
    <script type='text/javascript' src="{{asset('frontend/js/custom.js')}}?v={{ config('user.version') }}"></script>
    @yield('script')
</body>
</html>
