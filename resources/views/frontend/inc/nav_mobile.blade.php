@if ($menuProd->parent_id == null)
    <li class="nav-item">
        <a class="nav-link parent" href="{{route('products_cate', $menuProd->slug)}}">
            {{ $menuProd->title }}
        </a>
    </li>
    @if (count($menuProd->childrenMain) > 0)
        @foreach($menuProd->childrenMain as $menuProd)
            @include('frontend.inc.nav_mobile_children', $menuProd)
        @endforeach
    @endif
@endif
