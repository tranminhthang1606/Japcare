@php
    $infoLogin= null;
    if(\Illuminate\Support\Facades\Auth::guard('customer')->check()){
        $infoLogin =  Auth::guard('customer')->user();
    }
@endphp
<!--Header Mobile-->
<header class="header-mobile">
    <div class="d-flex">
        <div>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarMainMenu" aria-controls="navbarMainMenu" aria-expanded="false">
                <img src="{{ asset('frontend/images/header-menu.svg') }}" alt="">
            </button>
        </div>
        <div class="logo-mobile">
            <a href="{{ route('home') }}">
                <img src="{{ asset($generalsetting->st_logo)}}" alt="{{$generalsetting->st_name_site}}">
            </a>
        </div>
        <div>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarMainMenu" aria-controls="navbarMainMenu" aria-expanded="false">
                <img src="{{ asset('frontend/images/header-search-menu-mobile.svg') }}" alt=""/>
            </button>
        </div>
        @if($infoLogin != null)
            <div class="mobile-account-login">
                <a href="{{route('customer.info')}}">
                    @if($customer->avatar)
                        <img src="{{asset($customer->avatar)}}" alt="avatar">
                    @else
                        <i class="fa-solid fa-user-check" style="color: #00558d;"></i>
                    @endif
                </a>
            </div>
        @else
            <div class="icon-account" style="margin-right: 10px">
                <a href="{{ route('login') }}">
                    <img src="{{ asset('frontend/images/header-user.svg') }}"/>
                </a>
            </div>
        @endif
        <div>
            <a class="position-relative" href="{{ route('cart') }}">
                <img src="{{ asset('frontend/images/header-bag.svg') }}"/>
                <span class="count-cart count-cart-mobile"> 0 </span>
            </a>
        </div>
    </div>
    <nav class="navbar navbar-light p-0">
        <div class="navbar-collapse collapse" id="navbarMainMenu">
            @if($infoLogin != null)
                <p class="header-mobile-account-name">
                    Xin chào, <span>{{ $customer->full_name }}</span>
                </p>
            @endif
            <div class="d-flex title-collapse">
                <span>Menu</span>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarMainMenu" aria-controls="navbarMainMenu" aria-expanded="false">
                    <img src="{{ asset('frontend/images/header-close.svg') }}" alt=""/>
                </button>
            </div>
            <form class="elastic-search home-search" action="{{ route('home.search') }}" method="get">
                <div class="search-header">
                    <input type="text" name="" placeholder="Tìm kiếm sản phẩm" />
                    <button>
                        <i class="fa-solid fa-magnifying-glass" style="color: #1f3251;"></i>
                    </button>
                </div>
            </form>
            <div class="nav-wrap-header-mobile">
            <ul class="nav navbar-nav wrap-header-mobile">
                <li class="nav-item cat-menu-block">
                    <ul class="nav child-nav cat-menu cat-menu-mobile">
                        @each('frontend.inc.nav_mobile', $menuProdList, 'menuProd')
                    </ul>
                </li>
                @if(count($brands))
                    <li class="nav-item cat-menu-block">
                        <ul class="nav child-nav cat-menu cat-menu-mobile">
                            <li class="nav-item has-child">
                                <a href="javascript:void(0);" class="nav-link parent">Thương hiệu</a>
                                <span class="toggle"></span>
                                <ul class="nav child-nav">
                                    @foreach($brands as $brand)
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">{{$brand->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item nav-item-wrap">
                    <a class="nav-link weight6" href="{{ route('aboutus') }}">
                        Về chúng tôi
                    </a>
                </li>
                <li class="nav-item nav-item-wrap">
                    <a class="nav-link weight6" href="{{ route('allBlog') }}">Bài viết</a>
                </li>
                <li class="nav-item nav-item-wrap">
                    <a class="nav-link weight6" href="{{ route('contactus') }}">Liên hệ</a>
                </li>
                @if($infoLogin != null)
                    <li class="nav-item nav-item-wrap">
                        <a class="nav-link weight6" href="{{ route('customer.info') }}">Thông tin chung</a>
                    </li>
                    <li class="nav-item nav-item-wrap">
                        <a class="nav-link weight6" href="{{ route('profile') }}">Cập nhật hồ sơ</a>
                    </li>
                    <li class="nav-item nav-item-wrap">
                        <a class="nav-link weight6" href="{{ route('logout') }}">Đăng xuất</a>
                    </li>
                @else
                    <li class="nav-item nav-item-wrap">
                        <a class="nav-link weight6" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                @endif
            </ul>
            </div>
        </div>
    </nav>
</header>
