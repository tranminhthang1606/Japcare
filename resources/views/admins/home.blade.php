@extends('admins.layouts.master')
@section('title', 'Dashboard')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="mini-stat clearfix bg-white">
                        <a href="{{ url('/admin/products') }}">
                            <span class="mini-stat-icon bg-purple mr-0 float-right"><i class="mdi mdi-table-large"></i></span>
                        </a>
                        <div class="mini-stat-info">
                            <span class="counter text-purple">{{ $data['total_product'] }}</span>
                            Tổng Sản phẩm
                        </div>
                        <div class="clearfix"></div>
                        <p class=" mb-0 m-t-20 text-muted">
                            Số sản phẩm mới thêm trong tháng: {{ $data['total_product_m'] }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="mini-stat clearfix bg-white">
                        <a href="{{ url('/admin/customers') }}">
                            <span class="mini-stat-icon bg-brown mr-0 float-right"><i class="mdi mdi-account-multiple"></i></span>
                        </a>
                        <div class="mini-stat-info">
                            <span class="counter text-brown">{{ $data['total_customer'] }}</span>
                            Tổng khách hàng
                        </div>
                        <div class="clearfix"></div>
                        <p class="text-muted mb-0 m-t-20">Số khách mới trong tháng: {{ $data['total_customer_m'] }}</p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="mini-stat clearfix bg-white">
                        <a href="{{ url('/admin/orders') }}">
                            <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="mdi mdi-clipboard"></i></span>
                        </a>
                        <div class="mini-stat-info">
                            <span class="counter text-blue-grey">{{ $data['total_order'] }}</span>
                            Tổng đơn hàng
                        </div>
                        <div class="clearfix"></div>
                        <p class=" mb-0 m-t-20 text-muted">
                            Số đơn mới trong tháng: {{ $data['total_order_m'] }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="mini-stat clearfix bg-white">
                        <a href="{{ url('/admin/articles') }}">
                            <span class="mini-stat-icon bg-teal mr-0 float-right"><i class="mdi mdi-desktop-mac"></i></span>
                        </a>
                        <div class="mini-stat-info">
                            <span class="counter text-teal">{{ $data['total_news'] }}</span>
                            Tổng bài viết
                        </div>
                        <div class="clearfix"></div>
                        <p class="text-muted mb-0 m-t-20">
                            Số bài viết mới trong tháng: {{ $data['total_news_m'] }}
                        </p>
                    </div>
                </div>
            </div>

        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
