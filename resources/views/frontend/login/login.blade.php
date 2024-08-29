@extends('frontend.layouts.master')
@section('title', 'Đăng nhập')

@section('content')
    @php
    $banners = \App\Models\Banner::all();
    @endphp
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 d-sm-none">
                    @foreach($banners as $banner)
                        @if($banner && $banner->type_show == "1" & $banner->status == "1")
                            <img src="{{ asset($banner->image) }}" alt="Mua sản phẩm mỹ phẩm, thực phẩm chức năng chính hãng tại Japcare">
                        @endif
                    @endforeach
                </div>
                <div class="col-12 col-lg-6 login-box">
                    <h1>Japcare xin chào!</h1>
                    <p>Đăng nhập để trải nghiệm thêm nhiều tiện ích từ Japcare!</p>
                    <form id="login_form" method="POST" action="{{route('loginPost')}}" class="form-login">
                        @csrf
                        @include ('frontend.partials.messages')

                        <div class="mb-3">
                            <div class="col col-sm-12">
                                <input type="text" name="email" placeholder="Email/Số điện thoại" class="form-control"
                                       data-parsley-required-message="Vui lòng nhập email hoặc SĐT" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-password-group">
                                <input type="password" name="password" placeholder="Mật khẩu" class="form-control"
                                       data-parsley-required-message="Vui lòng nhập mật khẩu"
                                       data-parsley-minlength="6" data-parsley-minlength-message="Mật khẩu có ít nhất 6 ký tự" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn_login btn btn-primary text-uppercase w-100" type="submit">
                                Đăng nhập
                            </button>
                            <a href="{{route('forget_password')}}" class="forgotten">
                                <i class="fa-solid fa-lock" style="color: #808285;"></i>
                                Quên mật khẩu?
                            </a>
                            <p class="text-center">Bạn chưa có tài khoản?
                                <a href="{{route('register')}}">
                                    <i class="fa-solid fa-hand-point-right"></i> Đăng ký
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('form').parsley();

            $('.btn_login').on('click', function (e) {
                let form = $('#login_form');
                form.parsley().validate();
                if (form.parsley().isValid()) {
                    $('.btn_login').prop('disabled', true)
                    form.submit();
                }
            });
        });
    </script>
@endsection
