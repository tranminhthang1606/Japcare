@extends('frontend.layouts.master')
@section('title', isset($cateInfo) ? $cateInfo->title : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('description', isset($cateInfo) ? $cateInfo->description : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('keywords', isset($cateInfo) ? $cateInfo->title : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('meta_keywords', isset($cateInfo) ? $cateInfo->meta_title : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('meta_description', isset($cateInfo) ? $cateInfo->meta_description : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')

@section('content')
    <div class="container">
{{--        <div class="row">--}}
{{--            <div class="col-12 border-carousel">--}}
{{--                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">--}}
{{--                    <div class="carousel-indicators">--}}
{{--                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"--}}
{{--                                class="active" aria-current="true" aria-label="Slide 1"></button>--}}
{{--                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"--}}
{{--                                aria-label="Slide 2"></button>--}}
{{--                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"--}}
{{--                                aria-label="Slide 3"></button>--}}
{{--                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"--}}
{{--                                aria-label="Slide 4"></button>--}}
{{--                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"--}}
{{--                                aria-label="Slide 5"></button>--}}
{{--                    </div>--}}
{{--                    <div class="carousel-inner">--}}
{{--                        <div class="carousel-item active">--}}
{{--                            <img src="{{ asset('frontend/images/') }}/promotion-1.jpg" class="d-block w-100" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="carousel-item">--}}
{{--                            <img src="{{ asset('frontend/images/') }}/promotion-2.jpg" class="d-block w-100" alt="...">--}}
{{--                        </div>--}}
{{--                        <div class="carousel-item">--}}
{{--                            <img src="{{ asset('frontend/images/') }}/promotion-3.jpg" class="d-block w-100" alt="...">--}}
{{--                        </div>--}}
{{--                        <div class="carousel-item">--}}
{{--                            <img src="{{ asset('frontend/images/') }}/promotion-4.jpg" class="d-block w-100" alt="...">--}}
{{--                        </div>--}}
{{--                        <div class="carousel-item">--}}
{{--                            <img src="{{ asset('frontend/images/') }}/promotion-5.jpg" class="d-block w-100" alt="...">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">--}}
{{--                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                        <span class="visually-hidden">Previous</span>--}}
{{--                    </button>--}}
{{--                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">--}}
{{--                        <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                        <span class="visually-hidden">Next</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="swiper mySwiper40">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/promotion-1.jpg" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/promotion-2.jpg" alt="...">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/promotion-3.jpg" alt="...">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/promotion-4.jpg" alt="...">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/promotion-5.jpg" alt="...">
                </div>
            </div>
            <div class="swiper-button-next gray"></div>
            <div class="swiper-button-prev gray"></div>
            <div class="swiper-pagination news-cate"></div>
        </div>
        <div class="header-news-cate">
            <div class="title">
                <h2>Chăm sóc sức khoẻ</h2>
            </div>
        </div>
        <nav class="nav-bread" aria-label="breadcrumb">
            <ol class="breadcrumb policy">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chăm sóc sức khoẻ</li>
            </ol>
        </nav>
        <div class="row">
            <div class="list-blogs-full">
                <div class="col-12">
                    <div class="title-header-blog">
                        <a href="#" rel="nofollow">
                            <i class="fa-regular fa-file-lines" style="color: #263a7b;"></i>
                            bài viết mới
                        </a>
                    </div>
                </div>
                <div id="posts-every-day"
                     class="row row-cols-2 row-cols-xs-2 row-cols-sm-2 row-cols-md-4 row-cols-lg-5">
                    <div class="col blog-item">
                        <a href="#">
                            <img src="{{ asset('frontend/images/') }}/promotion-sp-1.jpg" alt="">
                            <div>
                                <div class="d-flex text-second mt-2">
                                    <i class="fa-regular fa-calendar-days" style="color: #797979;"></i>
                                    <span>08/09/2023</span>
                                </div>
                                <p class="title-blog"
                                   title="Đại hội sale 9/9, Bestme ưu đãi collagen DHC kèm voucher lên tới 100K">Đại
                                    hội sale 9/9, Bestme ưu đãi collagen DHC kèm voucher lên tới 100K</p>
                                <p class="description">
                                    Bestme 9/9 siêu sale hàng loạt mã collagen hot như collagen nước, kem dưỡng collagen
                                    cùng ngàn voucher lên tới 100K.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col blog-item">
                        <a href="#">
                            <img src="{{ asset('frontend/images/') }}/promotion-sp-2.jpg" alt="">
                            <div>
                                <div class="d-flex text-second mt-2">
                                    <i class="fa-regular fa-calendar-days" style="color: #797979;"></i>
                                    <span>05/09/2023</span>
                                </div>
                                <p class="title-blog" title="Hậu nghỉ lễ, vẫn có sale deal hời tại Japcare!">Hậu nghỉ
                                    lễ,
                                    vẫn có sale deal hời tại Japcare!</p>
                                <p class="description">
                                    Hết kỳ nghỉ lễ Quốc khánh, Bestme vẫn tặng bạn chương trình sale hấp dẫn các item
                                    chăm sóc cơ thể, làm đẹp da.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col blog-item">
                        <a href="#">
                            <img src="{{ asset('frontend/images/') }}/promotion-sp-3.jpg" alt="">
                            <div>
                                <div class="d-flex text-second mt-2">
                                    <i class="fa-regular fa-calendar-days" style="color: #797979;"></i>
                                    <span>30/08/2023</span>
                                </div>
                                <p class="title-blog"
                                   title="Chuẩn bị hành trang vào năm học mới cùng ưu đãi 50% của Japcare">Chuẩn bị hành
                                    trang vào năm học mới cùng ưu đãi 50% của Japcare</p>
                                <p class="description">
                                    Đến hẹn lại lên, Japcare cùng bạn đón mùa tựu trường 2023 tưng bừng với hàng loạt ưu
                                    đãi lên tới 50%. Cùng đón chờ nhé!
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col blog-item">
                        <a href="#">
                            <img src="{{ asset('frontend/images/') }}/promotion-sp-4.jpg" alt="">
                            <div>
                                <div class="d-flex text-second mt-2">
                                    <i class="fa-regular fa-calendar-days" style="color: #797979;"></i>
                                    <span>23/08/2023</span>
                                </div>
                                <p class="title-blog"
                                   title="Đại tiệc môi xinh giảm giá 30% sản phẩm son dưỡng môi DHC tại Japcare">Đại
                                    tiệc môi xinh giảm giá 30% sản phẩm son dưỡng môi DHC tại Japcare</p>
                                <p class="description">
                                    Hẹn lịch mua sắm ngày 25/8 trên website của Japcare để có cơ hội “rinh” các item son
                                    dưỡng siêu hot về tủ đồ làm đẹp của mình bạn nhé!
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col blog-item">
                        <a href="#">
                            <img src="{{ asset('frontend/images/') }}/promotion-sp-5.jpg" alt="">
                            <div>
                                <div class="d-flex text-second mt-2">
                                    <i class="fa-regular fa-calendar-days" style="color: #797979;"></i>
                                    <span>14/08/2023</span>
                                </div>
                                <p class="title-blog" title="Đặt lịch hẹn săn sale trị mụn tại Bestme vào ngày 15/8">Đặt
                                    lịch hẹn săn sale trị mụn tại Japcare vào ngày 15/8</p>
                                <p class="description">
                                    Japcare mở đại hội sale vũ trụ trị mụn từ tinh chất đến sữa rửa mặt, các loại viên
                                    uống trị mụn lên tới 41% vào ngày 15/8.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col blog-item">
                        <a href="#">
                            <img src="{{ asset('frontend/images/') }}/promotion-sp-6.jpg" alt="">
                            <div>
                                <div class="d-flex text-second mt-2">
                                    <i class="fa-regular fa-calendar-days" style="color: #797979;"></i>
                                    <span>07/08/2023</span>
                                </div>
                                <p class="title-blog"
                                   title="Nhập tiệc sale 8/8 giảm giá 50% “vũ trụ collagen&quot; nhà DHC">Nhập tiệc
                                    sale 8/8 giảm giá 50% “vũ trụ collagen" nhà DHC</p>
                                <p class="description">
                                    Đặt lịch săn sale 8/8 ngay hôm nay tại Japcare để nhập vào vũ trụ collagen DHC được
                                    giảm giá lên tới 50% bạn nhé!
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col blog-item">
                        <a href="#">
                            <img src="{{ asset('frontend/images/') }}/promotion-sp-7.jpg" alt="">
                            <div>
                                <div class="d-flex text-second mt-2">
                                    <i class="fa-regular fa-calendar-days" style="color: #797979;"></i>
                                    <span>03/08/2023</span>
                                </div>
                                <p class="title-blog" title="Chương trình tặng quà tháng 8 siêu lớn tại Bestme">Chương
                                    trình tặng quà tháng 8 siêu lớn tại Bestme</p>
                                <p class="description">
                                    Tháng 8 này, Bestme dành riêng ra 3 dịp để tặng quà cho các khách hàng khi mua sắm
                                    tại bestme.vn. Đừng bỏ lỡ cơ hội thu lớn các item mỹ ph
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col blog-item">
                        <a href="#">
                            <img src="{{ asset('frontend/images/') }}/promotion-sp-8.jpg" alt="">
                            <div>
                                <div class="d-flex text-second mt-2">
                                    <i class="fa-regular fa-calendar-days" style="color: #797979;"></i>
                                    <span>18/07/2023</span>
                                </div>
                                <p class="title-blog" title="Tìm người giúp việc tại Japcare? Tại sao không thể?">Tìm
                                    người giúp việc tại Japcare? Tại sao không thể?</p>
                                <p class="description">
                                    Japcare gửi tặng khách hàng mã giảm giá 25K được sử dụng 2 lần khi đặt dịch vụ tại
                                    ứng dụng của JUPVIEC.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col blog-item">
                        <a href="#">
                            <img src="{{ asset('frontend/images/') }}/promotion-sp-9.jpg" alt="">
                            <div>
                                <div class="d-flex text-second mt-2">
                                    <i class="fa-regular fa-calendar-days" style="color: #797979;"></i>
                                    <span>13/07/2023</span>
                                </div>
                                <p class="title-blog" title="HOT: Tặng bàn chải LocknLock khi mua hàng tại Japcare">HOT:
                                    Tặng bàn chải LocknLock khi mua hàng tại Japcare</p>
                                <p class="description">
                                    Tháng 7 này khi mua sắm tại Japcare.vn sẽ được tặng bàn chải điện LocknLock siêu xịn
                                    dành cho đơn hàng có giá trị cao nhất.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col blog-item">
                        <a href="#">
                            <img src="{{ asset('frontend/images/') }}/promotion-sp-10.jpg" alt="">
                            <div>
                                <div class="d-flex text-second mt-2">
                                    <i class="fa-regular fa-calendar-days" style="color: #797979;"></i>
                                    <span>04/07/2023</span>
                                </div>
                                <p class="title-blog" title="Đừng bỏ lỡ sale lớn 7/7 15/7 và 25/7 tại Japcare!">Đừng bỏ
                                    lỡ sale lớn 7/7 15/7 và 25/7 tại Japcare!</p>
                                <p class="description">
                                    Tháng 7 này, Japcare gửi tặng bạn 3 chương trình sale sốc mùa hè vào ngày 7/7 15/7 và
                                    25/7 với các gói viên uống và mỹ
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <a id="view-more-blogs-list" class="view-more-blogs full" href="javascript:void(0)">
                    Xem thêm
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 6.22076V9.78076C4 11.9941 5.56667 12.8941 7.48 11.7941L8.33333 11.3008C8.54 11.1808 8.66667 10.9608 8.66667 10.7208V5.28076C8.66667 5.04076 8.54 4.82076 8.33333 4.70076L7.48 4.20743C5.56667 3.10743 4 4.00743 4 6.22076Z"
                            fill="#F6ACCB"></path>
                        <path
                            d="M9.33301 5.86102V10.1477C9.33301 10.4077 9.61301 10.5677 9.83301 10.4343L10.5663 10.0077C12.4797 8.90768 12.4797 7.09435 10.5663 5.99435L9.83301 5.56768C9.61301 5.44102 9.33301 5.60102 9.33301 5.86102Z"
                            fill="#F6ACCB"></path>
                    </svg>
                </a>
            </div>
        </div>
@endsection
@section('script')
    <script type="text/javascript">
        var swiper41 = new Swiper(".mySwiper40", {
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>
@endsection
