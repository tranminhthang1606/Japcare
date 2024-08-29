@if($slider_home)
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-left">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach($slider_home as $slide)
                                <div class="swiper-slide">
                                    <a href="{{$slide->link ?? 'javascript:void(0)'}}">
                                        <img class="slider-banner" src="{{asset($slide->photo)}}" alt="{{$slide->title}}" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next white"></div>
                        <div class="swiper-button-prev white"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- new product -->
<div class="container">
    <div class="new_product">
        <div class="new_product-title">
            <h2 class="title">
                <a href="#">Sản phẩm mới về</a>
            </h2>
            <a href="#">
                <span class="view-all">Xem tất cả</span>
                <span><i class="fa-solid fa-angle-right"></i></span>
            </a>
        </div>
        @if($prod_new)
            <div class="swiper mySwiper3">
                <div class="new_product-list swiper-wrapper">
                    @foreach($prod_new as $new)
                        <div class="new_product-card swiper-slide">
                            @include('frontend.products.item', ['prd' => $new])
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next custom">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div class="swiper-button-prev custom">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- favourite -->
<div class="container">
    <div class="favourite">
        <h2 class="title">
            <a href="#">Được yêu thích nhất</a>
        </h2>
        @if($brandsData)
            <div class="tabs">
                <a class="tab-content active" href="#product-tab-0">{{$brandsData[0]->title}}</a>
                @if(isset($brandsData[1]))
                    <a class="tab-content" href="#product-tab-1">{{$brandsData[1]->title}}</a>
                @endif
                @if(isset($brandsData[2]))
                    <a class="tab-content" href="#product-tab-2">{{$brandsData[2]->title}}</a>
                @endif
            </div>
            @foreach($brandsData as $item => $brand)
                <div id="product-tab-{{$item}}" class="tab-pane{{$item < 1 ? ' show' : ''}}">
                    <div class="collection_product">
                        <div class="banner_favourite">
                            <a href="#">
                                <img src="{{ asset($brand->logo) }}" alt="{{$brand->title}}">
                            </a>
                        </div>
                        @if($brand->productsList(8))
                            @foreach($brand->productsList(8) as $prd)
                                <div class="new_product-card col-custom">
                                    @include('frontend.products.item', ['prd' => $prd])
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        @endif

        <!-- start banner favourite bottom -->
        @if($bannerBody)
            <div class="banner_favourite-bottom-mobile">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($bannerBody as $banner)
                            <div class="swiper-slide">
                                <a href="{{ $banner->link ?? 'javascript:void(0)' }}">
                                    <img class="slider-banner" src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next white"></div>
                    <div class="swiper-button-prev white"></div>
                </div>
            </div>
        @endif
        <!-- end banner favourite bottom -->
    </div>
</div>
<!-- end favourite -->
<!-- start product -->
@if($categories_main)
    <div class="container">
        @foreach($categories_main as $cate_main)
            <div class="new_product">
                <div class="new_product-title">
                    <h2 class="title">
                        <a href="#">{{$cate_main->title}}</a>
                    </h2>
                    <a href="#">
                        <span class="view-all">Xem tất cả</span>
                        <span><i class="fa-solid fa-angle-right"></i></span>
                    </a>
                </div>
                <div class="swiper mySwiper3">
                    <div class="new_product-list swiper-wrapper">
                        @if(count($cate_main->childrenMain) > 0 )
                            @if($cate_main->allproducts())
                                @foreach($cate_main->allproducts(8) as $key => $prd)
                                    <div class="new_product-card swiper-slide">
                                        @include('frontend.products.item', ['prd' => $prd])
                                    </div>
                                @endforeach
                            @endif
                        @else
                            @foreach($cate_main->products(8) as $prd)
                                <div class="new_product-card swiper-slide">
                                    @include('frontend.products.item', ['prd' => $prd])
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
                </div>
            </div>
        @endforeach
    </div>
@endif
<!-- end product -->
<div class="hot_new-mobile">
    <div class="container">
        <div class="new_product-title">
            <h2 class="title">
                <a href="#">Bài viết nổi bật</a>
            </h2>
            <a href="#">
                <span class="view-all">Xem thêm</span>
                <span>
                    <i class="fa-solid fa-angle-right"></i>
                </span>
            </a>
        </div>
        <div class="swiper mySwiper5">
            <div class="swiper-wrapper">
                @foreach($articles_newest as $itemF)
                    <div class="swiper-slide">
                        <div class="content_left">
                            <div>
                                <div class="content_left-img">
                                    <a href="#">
                                        <img src="{{ asset($itemF->thumbnail) }}" alt="{{ $itemF->title }}">
                                    </a>
                                </div>
                                <p class="hot_new-date">
                                    <i class="fa-regular fa-calendar-days" style="color: #8c8c8c;"></i>
                                    <span>{{ $itemF->created_at }}</span>
                                </p>
                                <div class="new_content-info">
                                    <a href="#">{{ $itemF->title }}</a>
                                    <p>{{ $itemF->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- end hot_new-mobile -->
<div class="content-custom-mobile">
    <div class="row">
        @if($generalsetting->customer_service)
            @foreach(json_decode($generalsetting->customer_service) as $key => $customer_service)
                <div class="content_custom-mobile-wrap col-md-12 d-flex">
                    @if(isset($customer_service->service_img))
                        <img src="{{ asset($customer_service->service_img) }}" alt="{{ $customer_service->service_title ?? '' }}">
                    @endif
                    <div>
                        <span class="content_custom-title">{{ $customer_service->service_title ?? '' }}</span>
                        <p class="content_custom-desc">{{ $customer_service->service_content ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

