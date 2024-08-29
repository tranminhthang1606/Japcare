@extends('errors::minimal')

@extends('layouts.blank')

@section('content')
    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
        <div class="row justify-content-center error-page text-center">
            <div class="col-lg-8 col-12 block-404 text-center d-flex justify-content-center align-items-center page-404">
                <img class="img-404" style="width: 80%" , height="auto" src="{{asset('frontend/images/500_error.png')}}" alt="500">
            </div>
            <div class="col-lg-4 col-12" style="margin: auto;">
                <h1 class="header-font" style="font-size: 20px; font-weight: 600;">Lỗi 500</h1>
                <p class="font-14 mb-0">Xin lỗi quý khách vì sự bất tiện này</p>
                <p class="font-14">Vui lòng liên hệ với quản trị viên để biết thêm chi tiết.</p>
                <div class="d-flex justify-content-center buttons" style="padding-top: 10px;">
                    <a class="btn show" style="margin-right: 10px; background: linear-gradient(85.79deg,#804098 0,#ED3B94 51.04%,#F37747 100%); font-size:
                    14px; border-radius: 8px; color: #fff" href="/">
                        Về trang chủ
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
