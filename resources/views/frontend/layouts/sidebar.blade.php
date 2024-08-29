@if(request()->route()->getName() == 'home')
    <div class="rt_mega_menu rt-custom-cat">
        <div id="vertical-mega-menu" class="menu-vertical-mega-menu-container">
            <ul class="menu">
                @each('frontend.inc.nav', $menuProdList, 'menuProd')
            </ul>
        </div>
    </div>
@endif

<div class="widget support-online-widget">
    <h3 class="widget-title">Hỗ trợ trực tuyến</h3>
    <img class="support-img" src="{{asset('frontend/img/img-support.png')}}" alt=""/>
    <div id="supporter-info" class="gd_support_4">
        <div id="support-1" class="supporter">
            <div class="info">
                <div class="support-rt">
                    <span class="name-support">Tư vấn bán hàng</span>
                    <span class="phone-support phone-support_2 phone_support_3">
                        <a href="tel:{{$generalsetting->hotline}}">
                            <i class="fa fa-phone-square" aria-hidden="true"></i>
                            {{$generalsetting->hotline}}
                        </a>
                    </span>
                </div>
                <span class="mail-support">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    {{$generalsetting->email}}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="widget rt-widget rt-product-category">
    <h3 class="widget-title">Sản phẩm bán chạy</h3>
    <div class="product-widget has-slide">
        <ul class="products-2">
            @foreach($sellingPro as $prd)
                <li>
                    @include('frontend.products.item', $prd)
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="widget img-qc">
    <h3 class="widget-title">Sản phẩm mới</h3>
    <div class="image-adv">
        @foreach($newSidebarPro as $prodNew)
            <div class="image-item">
                <a href="{{ route('product-detail', $prodNew->slug) }}" rel="" title="{{$prodNew->title}}">
                    <img src="{{ asset($prodNew->featured_img) }}" alt="">
                </a>
            </div>
        @endforeach
    </div>
</div>
<div class="widget img-qc">
    <h3 class="widget-title">Sản phẩm Hot</h3>
    <div class="image-adv">
        @foreach($hotSidebarPro as $prodHot)
            <div class="image-item">
                <a href="{{ route('product-detail', $prodHot->slug) }}" rel="" title="{{$prodHot->title}}">
                    <img src="{{ asset($prodHot->featured_img) }}" alt="">
                </a>
            </div>
        @endforeach
    </div>
</div>

<div class="widget rt-widget rt-post-category">
    <h3 class="widget-title">Tin tức mới</h3>
    <div class="news-widget-1 no-slide">
        @foreach($articleNew as $article)
            <div class="featured-post">
                <div class="align-left">
                    <img src="{{asset($article->thumbnail)}}" alt="news img">
                </div>
                <a class="news-title" href="{{ route('news-detail', $article->slug) }}">
                    {{ $article->title }}
                </a>
            </div>
        @endforeach
    </div>
</div>
