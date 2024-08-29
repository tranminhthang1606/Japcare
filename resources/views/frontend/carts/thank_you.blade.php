@extends('frontend.layouts.master')
@section('title', 'Cảm ơn quý khách')
@section('description', 'Cảm ơn quý khách đã lựa chọn sản phẩn của Máy tính Lạng Sơn')
@section('keywords', 'Cảm ơn quý khách đã lựa chọn sản phẩn của Máy tính Lạng Sơn')
@section('meta_keywords', 'Cảm ơn quý khách đã lựa chọn sản phẩn của Máy tính Lạng Sơn')
@section('meta_description', 'Cảm ơn quý khách đã lựa chọn sản phẩn của Máy tính Lạng Sơn')

@section('content')
    <section class="about" style="height: 50vh">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-inner">
                        <div class="null_style">
                            <h3 style="text-align: center; font-size: 2em">Cảm ơn quý Khách</h3>
                            <h4 style="text-align: center;">Cảm ơn quý Khách đã lựa chọn sản phẩm của chúng tôi!</h4>
                            <a class="btn_buy btn_add_cart" href="{{ route('home') }}">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
