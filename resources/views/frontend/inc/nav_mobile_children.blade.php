<li class="nav-item has-child">
    <a href="{{route('products_cate', $menuProd->slug)}}" class="nav-link">
        {{ $menuProd->title }}
    </a>
    @if (count($menuProd->childrenMain) > 0)
        <span class="toggle"></span>
        <ul class="nav child-nav">
            @foreach($menuProd->childrenMain as $menuProd)
                @include('frontend.inc.nav_mobile_children', $menuProd)
            @endforeach
        </ul>
    @endif
</li>
