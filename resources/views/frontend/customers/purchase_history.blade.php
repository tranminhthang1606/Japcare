@extends('frontend.layouts.master')
@section('title', 'Lịch sử mua hàng')
@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Tài khoản</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lịch sử mua hàng</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-lg-3">
            @include('frontend.customers.sidebar', ['link'=>'profile'])
        </div>
        <div class="col-12 col-lg-9">
            <ul class="nav nav-tabs mb-3 customer-history-tabs" id="pills-tab">
                <li class="nav-item">
                    <a class="nav-link customer-history-link active" id="new-order-tab" data-bs-toggle="pill" data-bs-target="#new-order">Đơn hàng mới</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link customer-history-link" id="order-success-tab" data-bs-toggle="pill" data-bs-target="#order-success">Đơn hàng thành công</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link customer-history-link" id="order-cancel-tab" data-bs-toggle="pill" data-bs-target="#order-cancel">Đơn hàng đã huỷ</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="new-order" aria-labelledby="new-order-tab" tabindex="0">
                    <table class="table table-borderless table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Giá trị đơn</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Trạng thái đơn hàng</th>
                            <th scope="col">Trạng thái giao vận</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row"><a class="link-to-history-detail" href="#">BM00000006494</a></th>
                            <td>2023-10-06 11:44:44</td>
                            <td>770,000 VND</td>
                            <td>Chưa thanh toán</td>
                            <td>Đang xử lý</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row"><a class="link-to-history-detail" href="#">BM00000006496</a></th>
                            <td>2023-10-06 14:44:44</td>
                            <td>370,000 VND</td>
                            <td>Chưa thanh toán</td>
                            <td>Đang xử lý</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="order-success" aria-labelledby="order-success-tab" tabindex="0">
                    <table class="table table-borderless table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Giá trị đơn</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Trạng thái đơn hàng</th>
                            <th scope="col">Trạng thái giao vận</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row"><a class="link-to-history-detail" href="#">BM00000006498</a></th>
                            <td>2023-10-06 11:44:44</td>
                            <td>570,000 VND</td>
                            <td>Chưa thanh toán</td>
                            <td>Đặt thành công</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="order-cancel" aria-labelledby="order-cancel-tab" tabindex="0">
                    <table class="table table-borderless table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Giá trị đơn</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Trạng thái đơn hàng</th>
                            <th scope="col">Trạng thái giao vận</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row"><a class="link-to-history-detail" href="#">BM00000006494</a></th>
                            <td>2023-10-06 11:44:44</td>
                            <td>770,000 VND</td>
                            <td>Chưa thanh toán</td>
                            <td>Đã huỷ</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

