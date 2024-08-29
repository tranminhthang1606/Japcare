<div class="panel">
    <h5 class="text-center category-info">Sắp xếp danh mục sản phẩm</h5>
    <ul id="tree1">
        @foreach($menus as $index => $menu)
            <li>
                {{ $menu->title }}
                <i style="display: {{$index == 0 ? 'none' : ''}}" class="fa fa-arrow-up" onclick="updateSortOrder('{{$menu->id}}', '{{$menu->parent_id}}', 'up')"></i>
                <i style="display: {{$index == (count($menus) - 1) ? 'none' : ''}}" class="fa fa-arrow-down" onclick="updateSortOrder('{{$menu->id}}', '{{$menu->parent_id}}', 'down')"></i>
                @if(count($menu->children))
                    @include('admins.categories.manageChild',['children' => $menu->children])
                @endif
            </li>
        @endforeach
    </ul>
</div>
