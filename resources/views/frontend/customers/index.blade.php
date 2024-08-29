@extends('frontend.layouts.master')
@section('title', 'Hồ sơ')

@section('content')
    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item promotion"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item promotion active"><a class="breadcrumb-item" href="">Tài khoản</a></li>
            </ol>
        </nav>
        <div class="main-content profile">
            <div class="row mt-3">
                <div class="col-12 col-lg-3 order-mobile mb-3">
                    @include('frontend.customers.sidebar', ['link'=>'info'])
                </div>
                <div class="col-12 col-lg-9">
                    <div class="panel infomaiton-detail">
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <div class="h-100 p-3 bg-white panel">
                                    <p class="fw-bold d-flex justify-content-between">
                                        <span class="title fz-16 mr-2">Thông tin tài khoản</span>
                                        <a href="{{ route('profile') }}" class="text-primary fz-14 fw-600 ms-4">Chỉnh
                                            sửa</a>
                                    </p>
                                    <div class="row">
                                        <p class="col-4 text-second">Họ và tên:</p>
                                        <p class="col">{{ $customer->full_name }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-4 text-second">Điện thoại:</p>
                                        <p class="col">{{ $customer->phone }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-4 text-second">Email:</p>
                                        <p class="col">{{ $customer->email }}</p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-12 mb-3 infomaiton-wrap">
                                <div class="h-100 p-3 bg-white panel">
                                    <div class="d-flex promotion-info">
                                        <a href="">
                                            <p class="fw-bold">
                                                <span class="fz-16 mr-2 title">Địa chỉ nhận hàng</span>
                                                <span class="tag-address-default">Mặc định</span>
                                            </p>
                                        </a>
                                        <a href="">
                                            <img src="{{ asset('frontend/images/') }}/arrow-left-step1.png" alt="">
                                        </a>
                                    </div>
                                    <div class="row">
                                        <p class="col-4 col-lg-3 text-second-address">Họ tên:</p>
                                        <p class="col d-flex">
                                        </p>
                                    </div>
                                    <div class="row">
                                        <p class="col-4 col-lg-3 text-second-address">Điện thoại:</p>
                                        <p class="col"></p>
                                    </div>
                                    <div class="row">
                                        <p class="col-4 col-lg-3 text-second-address">Địa chỉ:</p>
                                        <p class="col"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 mb-3">
                                <div class="bg-white panel p-3">
                                    <h2 class="title mb-2">Đổi mật khẩu</h2>
                                    <form method="post" action="{{ route('profile.change_pwd') }}"
                                          id="formForgotPassword" autocomplete="off">
                                        @csrf
                                        @include ('frontend.partials.messages')
                                        <div class="form-group">
                                            <label for="current_pwd" class="form-label">
                                                Mật khẩu hiện tại <span class="text-danger">*</span>
                                            </label>
                                            <div class="pass_show">
                                                <i class="far fa-eye ptxt" style="color: #969696;"></i>
                                                <i class="far fa-eye-slash ptxt" style="display: none"></i>
                                                <input type="password" id="current_pwd" name="current_pwd"
                                                       class="form-control pwd_style"
                                                        placeholder="Nhập mật khẩu hiện tại" required minlength="6"
                                                       maxlength="20"
                                                       data-parsley-required-message="Vui lòng nhập mật khẩu hiện tại"
                                                       data-parsley-minlength-message="Mật khẩu có ít nhất 6 ký tự"
                                                >
                                            </div>
                                            <small>Mật khẩu phải từ 6-20 ký tự (không dấu).</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_pwd" class="form-label">
                                                Mật khẩu mới <span class="text-danger">*</span>
                                            </label>
                                            <div class="pass_show">
                                                <i class="far fa-eye ptxt" style="color: #969696;"></i>
                                                <i class="far fa-eye-slash ptxt" style="display: none"></i>
                                                <input type="password" id="new_pwd" name="new_pwd"
                                                       class="form-control pwd_style"
                                                       placeholder="Nhập mật khẩu mới" required minlength="6"
                                                       maxlength="20"
                                                       data-parsley-required-message="Vui lòng nhập mật khẩu mới"
                                                       data-parsley-minlength-message="Mật khẩu có ít nhất 6 ký tự"
                                                >
                                            </div>
                                            <small>Mật khẩu phải từ 6-20 ký tự (không dấu).</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_new_pwd" class="form-label">
                                                Nhập lại mật khẩu mới <span class="text-danger">*</span>
                                            </label>
                                            <div class="pass_show">
                                                <i class="far fa-eye ptxt" style="color: #969696;"></i>
                                                <i class="far fa-eye-slash ptxt" style="display: none"></i>
                                                <input type="password" id="confirm_new_pwd"
                                                       class="form-control pwd_style" name="confirm_new_pwd"
                                                       placeholder="Nhập lại mật khẩu mới" required minlength="6"
                                                       maxlength="20" data-parsley-equalto="#new_pwd"
                                                       data-parsley-required-message="Vui lòng nhập lại mật khẩu mới"
                                                       data-parsley-equalto-message="Mật khẩu nhập lại không khớp"
                                                       data-parsley-minlength-message="Mật khẩu có ít nhất 6 ký tự"
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" id="submitForm" class="btn btn-primary">Xác nhận
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type='text/javascript' src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('form').parsley();
            $('#submitForm').on('click', function (e) {
                let form = $('#formForgotPassword');
                form.parsley().validate();
                if (form.parsley().isValid()) {
                    $('#submitForm').prop('disabled', true)
                    form.submit();
                }
            });

            $('.pass_show .ptxt').on('click', function (e) {
                e.preventDefault();
                let inputCheck = $(this).parent('.pass_show').find('.pwd_style').attr('type');
                if (inputCheck === 'password') {
                    $(this).parent('.pass_show').find('.pwd_style').attr('type', 'text');
                    $(this).parent('.pass_show').find('i.fa-eye').hide();
                    $(this).parent('.pass_show').find('i.fa-eye-slash').show();
                } else {
                    $(this).parent('.pass_show').find('.pwd_style').attr('type', 'password');
                    $(this).parent('.pass_show').find('i.fa-eye').show();
                    $(this).parent('.pass_show').find('i.fa-eye-slash').hide();
                }
            });

        });
    </script>
@endsection
