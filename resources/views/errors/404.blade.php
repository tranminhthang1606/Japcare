@extends('errors::minimal')

@extends('layouts.blank')

@section('content')
    <div class="container" style="margin-top: 100px; margin-bottom: 50px;">
        <div class="row justify-content-center error-page text-center">
            <div
                class="col-lg-8 col-12 block-404 text-center d-flex justify-content-center align-items-center page-404">
                <img class="img-404" style="width: 80%" , height="auto" src="{{asset('frontend/images/404_Error.png')}}"
                     alt="404">
            </div>
            <div class="col-lg-4 col-12" style="margin: auto;">
                <h1 class="header-font" style="font-size: 20px; font-weight: 600;">Xin lỗi, chúng tôi không tìm
                    thấy trang</h1>
                <p class="font-14 mb-0">Nội dung bạn tìm kiếm không đúng hoặc không tồn tại!</p>
                <p class="font-14">Vui lòng tìm kiếm nội dung khác.</p>
                <div class="d-flex justify-content-center buttons" style="padding-top: 10px;">
                    <a class="btn show" style="margin-right: 10px; background: linear-gradient(85.79deg,#804098 0,#ED3B94 51.04%,#F37747 100%); font-size:
                    14px;
                    border-radius: 8px; color: #fff"
                       href="#">Xem thêm tất cả các sản phẩm</a>
                    <a class="btn"
                       style="font-size: 14px; border-radius: 8px; color: #fff; background: linear-gradient(85.79deg,#804098 0,#ED3B94 51.04%,#F37747 100%)"
                       href="#">Xem thêm các
                        bài viết</a>
                </div>
            </div>
        </div>
    </div>
@endsection
