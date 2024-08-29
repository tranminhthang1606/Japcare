@if ($menu->parent_id == 0 && (count($menu->children) > 0))
    <li class="menu-item-has-children">
        <a href="{{route('news-category', $menu->slug)}}">
            {{ $menu->title }}
        </a>
@elseif($menu->parent_id != 0 && (count($menu->children) > 0))
    <li class="menu-item-has-children">
        <a href="{{route('news-category', $menu->slug)}}">
            {{ $menu->title }}
        </a>
@else
    <li>
        <a href="{{route('news-category', $menu->slug)}}">
            {{ $menu->title }}
        </a>
@endif
        @if (count($menu->children) > 0)
            <ul class="sub-menu">
                @foreach($menu->children as $menu)
                    @include('frontend.inc.news_menu_mobile', $menu)
                @endforeach
            </ul>
        @endif
</li>
