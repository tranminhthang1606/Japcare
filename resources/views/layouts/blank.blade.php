<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link name="favicon" type="image/x-icon" href="{{asset('img/favicon.png')}}" rel="shortcut icon" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--Font Awesome [ OPTIONAL ]-->
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.css')}}">
    <link href="{{ asset('frontend/css/error_page.css') }}" rel="stylesheet">

</head>
<body>
    <div id="container">
        <div class="cls-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div class="panel">
                            <div class="panel-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--JAVASCRIPT-->
    <!--jQuery [ REQUIRED ]-->
    <script src=" {{asset('frontend/js/jquery.min.js') }}"></script>
    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

    @yield('script')
</body>
</html>
