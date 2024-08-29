<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">

    <meta name="description" content="@yield('meta_description', $generalsetting->meta_description)" />
    <meta name="keywords" content="@yield('meta_keywords', $generalsetting->meta_keywords)">
    <meta name="author" content="{{ $generalsetting->st_name_site }}">
    <meta property="og:title" content="@yield('title', $generalsetting->meta_keywords)" />
    <meta property="og:image" content="@yield('thumbnail_img', asset($generalsetting->st_logo))" />
    <meta property="og:description" content="@yield('meta_description', $generalsetting->meta_description)" />
    <meta property="og:site_name" content="{{ $generalsetting->st_name_site }}" />
    @yield('meta')

    <title>@yield('title') - {{ $generalsetting->st_name_site }}</title>
    <link name="favicon" type="image/x-icon" href="{{ asset($generalsetting->favicon) }}" rel="shortcut icon" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap-select.min.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.min.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/font-awesome/css/all.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/swipper.min.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}?v={{ config('user.version') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}?v={{ config('user.version') }}">
    @yield('bottom_style')

    <script type='text/javascript' src="{{asset('frontend/js/jquery.min.js')}}?v={{ config('user.version') }}"></script>
</head>

<body>
    <div class="banner-header">
        @if(isset($bannerTop))
        <a href="{{ $bannerTop->link }}">
            <img src="{{ asset($bannerTop->image) }}" width="100%" alt="{{ $bannerTop->title }}" />
        </a>
        @endif
    </div>
    <!-- main-wrap -->
    @if($_isDerive == 'pc')
    @include('frontend.layouts.header')
    <main id="main-wrap">
        @yield('content')
    </main>
    @include('frontend.layouts.footer')
    @else
    @include('frontend.layouts.header_mb')
    <main id="main-wrap">
        @yield('content')
    </main>
    @include('frontend.layouts.footer_mb')
    @endif

    <div class="popup-index" style="display: none;">
        <div class="popup-modal">
            <button class="btn-close-popup-index">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <a href="#">
                <img src="{{asset('frontend/images/popup-index.png')}}" alt="">
            </a>
        </div>
    </div>

    <div class="up-to-top">
        <button class="btn scroll-to-top" type="button">
            <i class="fa-solid fa-arrow-up" style="color: #ffffff;"></i>
        </button>
    </div>

    <script type='text/javascript' src="{{asset('frontend/js/jquery-ui.min.js')}}?v={{ config('user.version') }}">
    </script>
    <script type='text/javascript' src='{{asset('frontend/js/bootstrap.min.js')}}'></script>
    <script type='text/javascript'
        src="{{asset('frontend/js/bootstrap-select.min.js')}}?v={{ config('user.version') }}"></script>
    <script type='text/javascript' src='{{asset('frontend/js/swipper.min.js')}}'></script>
    <!-- Sweet-Alert  -->
    <script type="text/javascript" src="{{ asset('frontend/js/sweetalert2.all.min.js') }}"></script>
    <script type='text/javascript' src="{{asset('frontend/js/custom.js')}}?v={{ config('user.version') }}"></script>
    <script type="text/javascript">
        function addToCart() {
            $.ajax({
                type: "POST",
                url: '{{ route('cart.addToCart') }}',
                data: $('#option-choice-form').serializeArray(),
                success: function (data) {
                    if (data != 0) {
                        if (data == 1) {
                            $('.header_cart-quantity').html(parseInt($('.header_cart-quantity').html()) + 1);
                        }
                        $.ajax({
                            type: "GET",
                            url: '{{ route('cart.previewCart') }}',
                            success: function (data) {
                                $('.cart-view').html(data);
                                $('.header_nav').removeClass('nav-down').addClass('nav-up');
                                $("#icon-cart").trigger("click");
                            },
                        });
                    } else {
                        showFrontendAlert('error', 'Thêm sản phẩm vào giỏ hàng thất bại!');
                    }
                }
            });
        }

        function removeFromCart(key) {
            $.post('{{ route('cart.removeFromCart') }}', {_token: '{{ csrf_token() }}', key: key}, function (data) {
                if (data == 1) {
                    $('.header_cart-quantity').html(parseInt($('.header_cart-quantity').html()) - 1);
                    $.ajax({
                        type: "GET",
                        url: '{{ route('cart.previewCart') }}',
                        success: function (data) {
                            $('.cart-view').html(data);
                        },
                    });
                } else {
                    showFrontendAlert('error', 'Xóa sản phẩm ở giỏ hàng thất bại!');
                }
            });
        }

        function searchingItem() {
            var keyword = $('#search').val();
           console.log($('#search').val()); 
            $.get('{{route('auto_search')}}',{
                _token: '{{ csrf_token() }}',
                txtsearch: keyword
            },function(data){
                console.log(data);
            })
        }

        $(document).ready(function () {
            window.onscroll = function () {
                scrollFunc();
                upToTop();
            }
            let scrollFunc = function () {
                if ($('body').scrollTop() > 300 || $(document).scrollTop() > 300) {
                    $('.header-v2').addClass('fixed');
                } else {
                    $('.header-v2').removeClass('fixed');
                }
            };

            let upToTop = function () {
                if ($('body').scrollTop() > 1500 || $(document).scrollTop() > 1500) {
                    $('.up-to-top').addClass('show');
                } else {
                    $('.up-to-top').removeClass('show');
                }
            }
            $('button.scroll-to-top').on('click', function () {
                $('html, body').animate({ scrollTop: 0 }, "slow");
            })
            $("li.has-child span.toggle").click(function () {
                $(this).parent().toggleClass("active");
            });
            $('.favourite .tab-content').on('click', function () {
                $('.favourite .tab-content').removeClass('active');
                $(this).addClass('active');
                $('.favourite .tab-pane').fadeOut('1000');
                $('.favourite .tab-pane').eq($(this).index()).fadeIn('1000');
            })
            $('.open-show').on('click', function(){
                $('.view-show-footer').show();
                $('.close-show').show();
                $(this).hide();
            });
            $('.close-show').on('click', function(){
                $('.view-show-footer').hide();
                $(this).hide();
                $('.open-show').show();
            });

            var swiper = new Swiper(".mySwiper", {
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

            var swiper2 = new Swiper(".mySwiper2", {
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1.2,
                        spaceBetween: 20,
                    },
                    480: {
                        slidesPerView: 1.2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2.2,
                        spaceBetween: 30,
                    },
                    980: {
                        slidesPerView: 3.2,
                        spaceBetween: 30,
                    },
                    1280: {
                        slidesPerView: 3.2,
                        spaceBetween: 30,
                    }
                }
            });

            var swiper3 = new Swiper(".mySwiper3", {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                        resistanceRatio: 0.85
                    },
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                        resistanceRatio: 0.85
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                        resistanceRatio: 0.85
                    },
                    980: {
                        slidesPerView: 4,
                        spaceBetween: 40,
                        resistanceRatio: 0.85
                    },
                    1280: {
                        slidesPerView: 5,
                        spaceBetween: 50,
                        resistanceRatio: 0
                    }
                }
            });
            var swiper4 = new Swiper(".mySwiper4", {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                        resistanceRatio: 0.85
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                        resistanceRatio: 0.85
                    },
                    980: {
                        slidesPerView: 4,
                        spaceBetween: 40,
                        resistanceRatio: 0.85
                    },
                    1280: {
                        slidesPerView: 5,
                        spaceBetween: 50,
                        resistanceRatio: 0
                    }
                }
            });
            var swiper5 = new Swiper(".mySwiper5", {
                pagination: {
                    el: ".swiper-pagination",
                },
            });
            var swiper6 = new Swiper(".mySwiper6", {
                slidesPerView: "auto",
                spaceBetween: 30,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });

        });
    </script>
    @yield('script')
</body>

</html>