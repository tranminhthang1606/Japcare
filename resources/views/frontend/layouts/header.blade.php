@php
$infoLogin= null;
if(\Illuminate\Support\Facades\Auth::guard('customer')->check()){
$infoLogin = Auth::guard('customer')->user();
}
@endphp
<!--Header PC-->
<header id="header" class="header block-header header-v2">
    <div class="header-top">
        <div class="container">
            <div class="header-wrap">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset($generalsetting->st_logo)}}" alt="{{$generalsetting->st_name_site}}">
                    </a>
                </div>
                <div class="search">
                    <form role="search" method="get" id="formSearch" class="home-search accessory-product-search"
                        action="{{ route('home.search') }}">
                        <div class="input-group-icon w-100">
                            <input name="keyword" class="form-control header-search" type="search" id="search"
                                placeholder="Nhập từ khóa tìm kiếm" autocomplete="off"
                                onchange="searchingItem()">
                            <button class="btn-search-header" type="submit" style="border: none;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="text-right">
                    <div class="d-flex align-items-center menu-right-header">
                        <a href="{{ route('cart') }}" class="cart-icon">
                            <i class="fas fa-shopping-bag" style="color: #00558d;"></i>
                            Giỏ hàng (<span class="count-cart count-cart-desktop" style="color: #00558d;">0</span>)
                        </a>
                        @if($infoLogin != null)
                        <div class="dropdown after-login ms-md-3">
                            <p>
                                <a href="{{ route('customer.info') }}">
                                    <i class="fa-regular fa-user" style="color: #1b499c;"></i>
                                    Xin chào,
                                    <span>{{$infoLogin->full_name}}</span>
                                </a>
                            </p>
                            <div class="dropdown-menu dropdown-menu-header-after">
                                <a class="dropdown-item" href="{{ route('customer.info') }}">Thông tin chung</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a>
                            </div>
                        </div>
                        @else
                        <div class="dropdown before-login ms-md-3">
                            <a href="#" class="btn-go-to-login">
                                <i class="fas fa-user" style="color: #a8b0ca;"></i>
                                Đăng nhập/Đăng ký
                            </a>
                            <div class="dropdown-menu dropdown-menu-header-before">
                                <a class="dropdown-item" href="{{ route('login') }}">Đăng Nhập</a>
                                <a class="dropdown-item" href="{{ route('register') }}">Đăng Ký</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-categories-header">
        <div class="container nav-menu">
            <div class="row">
                <ul class="parents dropdown">
                    @each('frontend.inc.nav', $menuProdList, 'menuProd')
                    @if(count($brands))
                    <li class="dropbtn">
                        <a href="javascript:void(0)" class="nav-link">THƯƠNG HIỆU</a>
                        <div class="dropdown-content">
                            @foreach($brands as $brand)
                            <a href="#">{{$brand->title}}</a>
                            @endforeach
                        </div>
                    </li>
                    @endif
                    <li class="txt-parent">
                        <a class="nav-link" href="{{ route('aboutus') }}">VỀ CHÚNG TÔI</a>
                    </li>
                    <li class="txt-parent">
                        <a class="nav-link" href="{{ route('allBlog') }}">BÀI VIẾT</a>
                    </li>
                    <li class="txt-parent">
                        <a class="nav-link" href="{{ route('contactus') }}">LIÊN HỆ</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>