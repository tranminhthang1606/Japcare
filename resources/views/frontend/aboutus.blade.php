@extends('frontend.layouts.master_about')
@section('title', $page->title_page)
@section('description', $page->meta_description)
@section('keywords', $page->title_page)
@section('meta_keywords', $page->meta_title)
@section('meta_description', $page->meta_description)

@section('content')
{{--    <div class="pageAbout-us">--}}
{{--        <div class="wrapper-row pd-page">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 pd5">--}}
{{--                        <div class="sidebar-page">--}}
{{--                            <div class="group-menu">--}}
{{--                                <div class="page_menu_title title_block">--}}
{{--                                    <h2>Danh mục trang</h2>--}}
{{--                                </div>--}}
{{--                                <div class="layered layered-category">--}}
{{--                                    <div class="layered-content">--}}
{{--                                        @include('frontend.inc.policies_menu')--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 pd5">--}}
{{--                        @if(isset($page))--}}
{{--                        <div class="page-wrapper">--}}
{{--                            <div class="heading-page">--}}
{{--                                <h1>{{$page->title_page}}</h1>--}}
{{--                            </div>--}}
{{--                            <div class="wrapbox-content-page">--}}
{{--                                <div class="content-page ">--}}
{{--                                    {!! html_entity_decode($page->content) !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @else--}}
{{--                            <p>Trang này chưa được cập nhập</p>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

<div class="landing-page">
    <section class="section1">
        <a target="_blank" href="#">
            <img class="lazyload width-100" src="{{ asset('frontend/images/') }}/about-us-1.png" alt="">
        </a>
        <a class="goToScroll" href="#section2">
            <img class="lazyload width-100" src="{{ asset('frontend/images/') }}/about-us-2.png" alt="">
        </a>
    </section>
    <section id="section2" class="section2">
        <img class="width-100 lazyload" src="{{ asset('frontend/images/') }}/about-us-3.png" alt="">
    </section>
    <section class="section3">
        <img class="width-100 lazyload" src="{{ asset('frontend/images/') }}/about-us-4.png" alt="">
    </section>
    <section class="section4">
        <img class="width-100 lazyload" src="{{ asset('frontend/images/') }}/about-us-5.png" alt="">
    </section>
    <section class="section5">
        <img class="width-100 lazyload" src="{{ asset('frontend/images/') }}/text-about-us.png" alt="">
        <div class="d-flex san">
            <a href="#" target="_blank">
                <img src="{{ asset('frontend/images/') }}/sell-tm1.png" alt="">
            </a>
            <a href="#" target="_blank">
                <img src="{{ asset('frontend/images/') }}/sell-tm2.png" alt="">
            </a>
            <a href="#" target="_blank">
                <img src="{{ asset('frontend/images/') }}/sell-tm3.png" alt="">
            </a>
        </div>
        <img class="width-100 lazyload" src="{{ asset('frontend/images/') }}/about-us-6.png" alt="">
    </section>
    <section class="section5">
        <img class="width-100 lazyload" src="{{ asset('frontend/images/') }}/about-us-7.png" alt="">
    </section>
    <footer class="footer-swiper about-us-footer">
        <div class="swiper mySwiper20">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/about-us-sw-1.png" alt="" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/about-us-sw-2.png" alt="" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/about-us-sw-3.png" alt="" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/about-us-sw-4.png" alt="" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/about-us-sw-5.png" alt="" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/about-us-sw-6.png" alt="" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('frontend/images/') }}/about-us-sw-7.png" alt="" />
                </div>
            </div>
        </div>
        <h5>Contact us</h5>
        <p>
            <a href="mailto:{{ $generalsetting->email }}">
                <span class="__cf_email__">{{ $generalsetting->email }}</span>
            </a> |
            <a href="tel:{{$generalsetting->phone}}">{{$generalsetting->phone}}</a>
        </p>
        <p>CÔNG TY TNHH THƯƠNG MẠI & ĐẦU TƯ YUKI PHAM <a target="_blank" href="{{ route('home') }}">Japcare</a></p>
    </footer>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            var swiper20 = new Swiper(".mySwiper20", {
                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: "auto",
                coverflowEffect: {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: true,
                },
                loop: true,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false
                },
                pagination: {
                    el: ".swiper-pagination",
                },
            });
            $(".goToScroll").click(function () {
                $('html,body').animate({
                        scrollTop: $(".section2").offset().top - 130
                    },'fast');
            });
        });
    </script>
@endsection
