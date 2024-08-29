@extends('frontend.layouts.master_about')
@section('content')
<div class="main-content pb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb new">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Trang chủ</a>
                </li>
                <li class="breadcrumb-item">Quên mật khẩu</li>
            </ol>
        </nav>
        <div class="wrap-auth-form col-12 col-lg-7 mx-auto mb-5 py-4">
            <div class="text-center">
                <h1 class="page-title mt-4 mb-lg-4">Quên mật khẩu</h1>
            </div>
            <div class="mail-success text-center px-3 pb-4 px-lg-5">
                <p>
                    Chúng tôi đã gửi thư khôi phục mật khẩu đến email
                </p>
                <p>
                    hanghai@gmail.com
                </p>
                <p>
                    Bạn vui lòng kiểm tra, thực hiện theo hướng dẫn và đăng nhập lại!
                </p>
            </div>
        </div>

    </div>
</div>
@endsection
