@if ($menu->parent_id == 0)
    <li>
        <a href="{{route('news-category', $menu->slug)}}">{{ $menu->title }}</a>
    </li>
@endif
