@extends('frontend.layouts.master')
@section('title', 'Lịch sử mua hàng')
@section('content')
    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item promotion"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item promotion active">Chi tiết đơn hàng</li>
            </ol>
        </nav>
        <div class="order-detail-main">
            <div class="order-detail-list">
                <div class="text-center border-bottom mb-4">
                    <h1 class="page-title fz-24 my-3"><span class="fw-400">#</span> BM00000006494</h1>
                </div>
                <div class="d-flex flex-wrap px-3 px-lg-4">
                    <div class="col-12 col-lg mb-3">
                        <h2 class="fz-20 mb-4">Địa chỉ nhận hàng</h2>
                        <p class="row">
                            <span class="text-second col-lg-3 col pr-0">Người nhận:</span>
                            <span class="col">Nguyễn Thành Chung</span>
                        </p>
                        <p class="row">
                            <span class="text-second col-lg-3 col pr-0">Địa chỉ:</span>
                            <span class="col">Long Biên, Cẩm Lý, Lục Nam, Bắc Giang</span>
                        </p>
                        <p class="row">
                            <span class="text-second col-lg-3 col pr-0">Điện thoại:</span>
                            <span class="col">03654976233</span>
                        </p>
                    </div>
                    <div class="col-12 col-lg mb-3">
                        <h2 class="fz-20 mb-4">Thông tin đơn hàng</h2>
                        <p class="row">
                            <span class="text-second col">Ngày tạo đơn:</span>
                            <span class="col">06/10/2023</span>
                        </p>
                        <p class="row">
                            <span class="text-second col">Phương thức thanh toán:</span>
                            <span class="col">Thanh toán khi nhận hàng (COD)</span>
                        </p>
                        <p class="row">
                            <span class="text-second col">Trạng thái thanh toán:</span>
                            <span class="col">Chưa thanh toán</span>
                        </p>
                        <p class="row">
                            <span class="text-second col">Phương thức vận chuyển:</span>
                            <span class="col">Giao hàng tiêu chuẩn của Japcare.vn</span>
                        </p>
                        <p class="row">
                            <span class="text-second col">Trạng thái đơn hàng:</span>
                            <span class="col text-primary">Đang xử lý</span>
                        </p>
                    </div>
                </div>

                <h2 class="fz-20 mt-lg-4 px-3">Chi tiết đơn hàng</h2>
                <div class="box-cart-result">
                    <div class=" table-custom mb-3 fz-16 py-3">
                        <div class="border-bottom table-header">
                            <div class="col-10 offset-2">
                                <div class="order-menu row">
                                    <div class="col-4 col-item">Sản phẩm</div>
                                    <div class="col-3 col-item justify-content-center">Đơn giá</div>
                                    <div class="col-2 col-item justify-content-center">Số lượng</div>
                                    <div class="col-3 col-item justify-content-end">Thành tiền</div>
                                </div>
                            </div>
                        </div>
                        <div class="table-body">
                            <div class="menu-product row">
                                <div class="col-3 col-lg-2 col-item">
                                    <a href="">
                                        <img src="{{asset('frontend/images/order-detail-1.jpg')}}" class=" lazyloaded"
                                             alt="Viên uống DHC DHA bổ sung DHA hỗ trợ giảm mỡ máu">
                                    </a>
                                </div>
                                <div class="col-9 col-lg-10 p-0 d-flex flex-wrap">
                                    <div class="col-12 col-lg-4 col-item">
                                        <a href=""
                                           title="Viên uống DHC DHA bổ sung DHA hỗ trợ giảm mỡ máu" class="text-dark">
                                            Viên uống DHC DHA bổ sung DHA hỗ trợ giảm mỡ máu:60 ngày
                                        </a>
                                    </div>
                                    <div class="price-mobile col-12 col-lg-3 col-item">
                                        <span class="mobile-label">Đơn giá</span>
                                        <span class="price flex-fill"
                                              data-value="770.000đ">770.000đ</span>
                                    </div>
                                    <div class="price-mobile col-12 col-lg-2 col-item ">
                                        <span class="mobile-label ">Số lượng</span>
                                        <span class="flex-fill">1</span>
                                    </div>
                                    <div class="price-mobile col-12 col-lg-3 col-item">
                                        <span class="mobile-label">Thành tiền</span>
                                        <span class="total-price" data-value="770.000đ">770.000đ</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 col-lg-2 col-item">
                                    <a href="">
                                        <img src="{{asset('frontend/images/order-detail-2.jpg')}}"
                                             class=" lazyloaded" alt="Hộp thuốc">
                                    </a>
                                </div>
                                <div class="col-9 col-lg-10 p-0 d-flex flex-wrap">
                                    <div class="col-12 col-lg-4 col-item">
                                        <a href="" title="Hộp thuốc" class="text-dark">
                                            Hộp thuốc
                                        </a>
                                    </div>
                                    <div class="price-mobile col-12 col-lg-3 col-item">
                                        <span class="mobile-label">Đơn giá</span>
                                        <span class="price flex-fill" data-value="0đ">0đ</span>
                                    </div>
                                    <div class="price-mobile col-12 col-lg-2 col-item buy-total">
                                        <span class="mobile-label">Số lượng</span>
                                        <span class="flex-fill">1</span>
                                    </div>
                                    <div class="price-mobile col-12 col-lg-3 col-item">
                                        <span class="mobile-label ">Thành tiền</span>
                                        <span class="total-price " data-value="0đ">0đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-bill-order my-4">
                <div class="row purchase-log">
                    <ul class="list-unstyled col-12 col-lg-4 m-0">
                        <li class="d-flex mb-2">
                            <span class="">Thành tiền:</span>
                            <span class="ms-auto"><span class="total-price">770.000đ</span></span>
                        </li>
                        <li class="d-flex mb-2">
                            <span class="">Vận chuyển:</span>
                            <span class="ms-auto"><span class="total-transport" data-value="0đ">0đ</span></span>
                        </li>
                        <li class="d-flex">
                            <span class="">Tổng:</span>
                            <span class="ms-auto"><span class="total-cart">770.000đ</span></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

