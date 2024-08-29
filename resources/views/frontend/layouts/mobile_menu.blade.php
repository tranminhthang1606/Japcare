<div class="mobile-menu-container">
    <div class="close-menu">
        Đóng menu <i class="fa fa-times" aria-hidden="true"></i>
    </div>
    <ul class="mobile-menu">
        <li>
            <a href="{{ route('home') }}">Trang chủ</a>
        </li>
        <li>
            <a href="{{route('aboutus')}}">Giới thiệu</a>
        </li>
        <li>
            <a href="{{ route('products') }}">Sản phẩm</a>
        </li>
        @each('frontend.inc.nav_mobile', $menuProdList, 'menuProd')
        @each('frontend.inc.news_menu_mobile', $menuList, 'menu')
        <li><a href="{{ route('contactus') }}">Liên hệ</a></li>
    </ul>
</div>
