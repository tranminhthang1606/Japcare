<li class="text-child-lv2">
    <a href="{{ route('products') }}">
        {{ $menuProd->title }}
    </a>
    @if (count($menuProd->childrenMain) > 0)
        <ul>
            @foreach($menuProd->childrenMain as $item)
                <li class="child-lv3">
                    <a href="{{ route('products') }}">
                        {{ $item->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>
