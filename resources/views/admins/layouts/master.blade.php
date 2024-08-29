<!doctype html>
<html lang="vi">
<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App Icons -->
    <title>@yield('title') - Quản trị</title>
    <link name="favicon" type="image/x-icon" href="{{ asset(\App\Models\Setting::first()->favicon) }}" rel="shortcut icon"/>

    <!-- DataTables -->
    <link href="{{ asset('assets/css/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/rwd-table.min.css') }}" rel="stylesheet">
    <!-- Basic Css files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <!-- Sweet Alert -->
    <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    @yield('stylesheet')

    <!-- jQuery  -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/waves.js') }}"></script>
</head>
<body class="fixed-left">
    <!-- Loader -->
    <div id="preloader"><div id="status"><div class="spinner"></div></div></div>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- sidebar -->
        @include('admins.layouts.sidebar')
        <!-- //sidebar -->
        <!-- Container -->
        <div class="content-page">
            <div class="content">
                <!-- topbar -->
                @include('admins.layouts.topbar')
                <!-- topbar -->
                @yield('content')
            </div><!-- content -->
            <!-- footer -->
            @include('admins.layouts.footer')
            <!-- footer -->
        </div>
        <!-- //Container -->
    </div>
    <!-- END wrapper -->
    @include('admins.partials.modal')

    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-colorpicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.bootstrap-touchspin.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/rwd-table.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/form-advanced.js') }}"></script>
    <!--Spartan Image JavaScript [ REQUIRED ]-->
    <script type="text/javascript" src="{{ asset('assets/js/spartan-multi-image-picker-min.js') }}"></script>
    <!-- Sweet-Alert  -->
    <script type="text/javascript" src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <!-- App js -->
    <script type="text/javascript" src="{{asset('assets/js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
    @yield('bottom_script')
</body>
</html>
