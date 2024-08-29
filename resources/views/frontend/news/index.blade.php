@extends('frontend.layouts.master')
@section('title', isset($cateInfo) ? $cateInfo->title : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('description', isset($cateInfo) ? $cateInfo->description : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('keywords', isset($cateInfo) ? $cateInfo->title : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('meta_keywords', isset($cateInfo) ? $cateInfo->meta_title : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('meta_description', isset($cateInfo) ? $cateInfo->meta_description : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')

@section('content')
    <div class="container" style="overflow: hidden">
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
        <div class="row">
            <div class="col-12">
                <div
                    class="swiper categories-blog swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                    <div class="swiper-wrapper" id="swiper-wrapper-cbf5e7c76710efd8e">
                        @if($cateNewsParent)
                            @foreach($cateNewsParent as $item)
                                <div class="dropdown swiper-slide swiper-slide-prev">
                                    <button class="btn-blog" type="button">
                                        <a href="{{ $item->slug }}"> {{ $item->title }}</a>
                                    </button>
                                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split dr-menu">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    @if (count($item->children))
                                        <ul class="dropdown-menu blog-drop-menu">
                                            @foreach($item->children as $children)
                                                <li>
                                                    <a class="dropdown-item" title="{{ $children->title }}" href="{{ $children->slug }}">
                                                        {{ $children->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="title-header-blog">
                    <a href="javascript:void(0)">
                        <i class="fa-regular fa-file-lines" style="color: #263a7b;"></i>
                        Bài viết nổi bật
                    </a>
                </div>
                <div
                    class="swiper blogHighlightSwiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                    <div class="swiper-wrapper">
                        @if($featured_articles)
                            @foreach($featured_articles as $featured_article)
                                <div class="swiper-slide">
                                    <a href="{{ $featured_article->slug }}">
                                        <img style="border-radius: 10px" class=" ls-is-cached lazyloaded"
                                             src="{{ asset($featured_article->thumbnail) }}"
                                             alt="{{ $featured_article->title }}">
                                        <p class="title-blog">
                                            {{ $featured_article->title }}
                                        </p>
                                        <p class="description">
                                            {{ $featured_article->description }}
                                        </p>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="swiper-button-next custom">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    <div class="swiper-button-prev custom">
                        <i class="fa-solid fa-arrow-left"></i>
                    </div>
                    <span class="swiper-notification"></span>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="title-header-blog">
                    <a href="javascript:void(0)">
                        <i class="fa-regular fa-file-lines" style="color: #263a7b;"></i>
                        Chủ đề đang hot
                    </a>
                </div>
                <div
                    class="swiper blogsSwiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-grid swiper-grid-column swiper-backface-hidden">
                    <div class="swiper-wrapper grid-container">
                        @if($hot_articles)
                            @foreach($hot_articles as $hot_article)
                                <div class="swiper-slide" style="justify-content: start">
                                    <a href="{{ $hot_article->slug }}" class="d-flex">
                                        <img style="border-radius: 10px; margin-bottom: 10px; padding-bottom: 0"
                                             src="{{ asset($hot_article->thumbnail) }}" class="ls-is-cached lazyloaded"
                                             alt="{{ $hot_article->title }}">
                                        <div>
                                            <p class="title-blog">{{ $hot_article->title }}</p>
                                            <p class="description">{{ $hot_article->description }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div
                        class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-lock">
                        <span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                    </div>
                    <span class="swiper-notification"></span>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($cateNewsParent as $key => $val)
                <div class="col-12">
                    <div class="row color-tim cssk ">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="title-header-blog">
                                <a href="#">
                                    <i class="fa-solid fa-wand-magic-sparkles" style="color: #cdb3d6;"></i>
                                    {{ $val->title }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(count($val->articles))
                        <div class="blog-one ">
                            <div class="row">
                                @foreach($val->articles as $index => $article)
                                    @if($index === 0)
                                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                                            <a href="#">
                                                <img src="{{ asset($article->thumbnail) }}" class="lazyload"
                                                     alt="{{ $article->title }}">
                                            </a>
                                        </div>
                                        <div
                                            class="col-lg-4 col-md-4 col-sm-12 col-xs-12 d-flex align-items-center justify-content-center">
                                            <div>
                                                <a href="{{ $article->slug }}" class="title-blog" title="">
                                                    {{ $article->title }}
                                                </a>
                                                <p class="description">
                                                    {{ $article->description }}
                                                </p>
                                                <a href="{{ $article->slug }}" class="view-more-blogs">
                                                    Xem thêm
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
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
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                @if(count($val->articles))
                    <div class="col-12">
                        <div
                            class="swiper blogsFiveItemSwiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                            <div class="swiper-wrapper">
                                @foreach($val->articles as $index => $article)
                                    @if ($index >= 1 )
                                        <div class="swiper-slide">
                                            <a href="{{ $article->slug }}">
                                                <img style="border-radius: 10px" src="{{ asset($article->thumbnail) }}"
                                                     class="lazyload"
                                                     alt="{{ $article->title }}">
                                                <div>
                                                    <div class="d-flex text-second mt-2 date-blog">
                                                        <i class="fa-regular fa-calendar-days"
                                                           style="color: #797979;"></i>
                                                        <span>{{ $article->created_at }}</span>
                                                    </div>
                                                    <p title="" class="title-blog">
                                                        {{ $article->title }}
                                                    </p>
                                                    <p class="description">
                                                        {{ $article->description }}
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="swiper-button-next custom">
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                            <div class="swiper-button-prev custom">
                                <i class="fa-solid fa-arrow-left"></i>
                            </div>
                            <span class="swiper-notification"></span>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
        <div class="row">
            <div class="list-blogs-full">
                <div class="col-12">
                    <div class="title-header-blog">
                        <a href="#" rel="nofollow">
                            <i class="fa-regular fa-file-lines" style="color: #263a7b;"></i>
                            Bài viết mới
                        </a>
                    </div>
                </div>
                <div id="posts-every-day"
                     class="row row-cols-2 row-cols-xs-2 row-cols-sm-2 row-cols-md-4 row-cols-lg-5">
                    @if($newestArticles)
                        @foreach($newestArticles as $newestArticle)
                            <div class="col blog-item">
                                <a href="{{ $newestArticle->slug }}">
                                    <img src="{{ asset($newestArticle->thumbnail) }}" alt="">
                                    <div>
                                        <div class="d-flex text-second mt-2">
                                            <i class="fa-regular fa-calendar-days" style="color: #797979;"></i>
                                            <span>{{ $newestArticle->created_at }}</span>
                                        </div>
                                        <p class="title-blog">{{ $newestArticle->title }}</p>
                                        <p class="description">
                                            {{ $newestArticle->description }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif

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
                $(document).ready(function () {
                    new Swiper('.blogsSwiper', {
                        slidesPerView: 1,
                        grid: {
                            rows: 4,
                        },
                        pagination: {
                            el: ".blogsSwiper .swiper-pagination",
                            clickable: true,
                        },
                    });

                    new Swiper(".blogSwiper", {
                        pagination: {
                            el: ".blogSwiper .swiper-pagination",
                            clickable: true,
                        },
                        loop: true,
                        navigation: {
                            nextEl: ".blogSwiper .swiper-button-next",
                            prevEl: ".blogSwiper .swiper-button-prev",
                        },
                    });

                    new Swiper(".blogHighlightSwiper", {
                        loop: true,
                        navigation: {
                            nextEl: ".blogHighlightSwiper .swiper-button-next",
                            prevEl: ".blogHighlightSwiper .swiper-button-prev",
                        },
                    });

                    new Swiper(".blogsFiveItemSwiper", {
                        slidesPerView: 5,
                        pagination: {
                            el: ".blogsFiveItemSwiper .swiper-pagination",
                            clickable: true,
                        },
                        navigation: {
                            nextEl: ".blogsFiveItemSwiper .swiper-button-next",
                            prevEl: ".blogsFiveItemSwiper .swiper-button-prev",
                        },
                        breakpoints: {
                            // when window width is >= 320px
                            320: {
                                slidesPerView: 1.2
                            },
                            // when window width is >= 480px
                            480: {
                                slidesPerView: 3
                            },
                            // when window width is >= 640px
                            640: {
                                slidesPerView: 3
                            },
                            // when window width is >= 640px
                            769: {
                                slidesPerView: 5
                            }
                        }
                    });

                    new Swiper(".categories-blog", {
                        slidesPerView: "auto",
                        breakpoints: {
                            320: {
                                slidesPerView: 1.5
                            },
                            // when window width is >= 480px
                            480: {
                                slidesPerView: 2.2
                            },
                            640: {
                                slidesPerView: 3,
                                spaceBetween: 20,
                            },
                            768: {
                                slidesPerView: 4,
                                spaceBetween: 20,
                            },
                            1024: {
                                slidesPerView: 5.2,
                                spaceBetween: 20,
                            },
                        },
                    });

                    var swiper40 = new Swiper(".mySwiper40", {
                        loop: true,
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                        pagination: {
                            el: ".swiper-pagination",
                        },
                    });

                });
            </script>
@endsection
