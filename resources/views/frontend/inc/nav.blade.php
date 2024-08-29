@if ($menuProd->parent_id == null && (count($menuProd->childrenMain) > 0))
    <li class="txt-parent">
{{--        <a class="dropdown-item" href="{{route('products_cate', $menuProd->slug)}}">--}}
{{--            {{ $menuProd->title }}--}}
{{--        </a>--}}
        <a class="nav-link a-parent" href="{{ route('products') }}">
            {{ $menuProd->title }}
        </a>
@else
    <li class="txt-parent">
{{--        <a class="dropdown-item" href="{{route('products_cate', $menuProd->slug)}}">--}}
{{--            {{ $menuProd->title }}--}}
{{--        </a>--}}
        <a class="nav-link a-parent" href="{{ route('products') }}">
            {{ $menuProd->title }}
        </a>
@endif
    @if (count($menuProd->childrenMain) > 0)
        <div class="child-lv2">
            <ul>
                @foreach($menuProd->childrenMain as $menuProd)
                    @include('frontend.inc.nav_children', $menuProd)
                @endforeach
            </ul>
        </div>
    @endif
</li>
