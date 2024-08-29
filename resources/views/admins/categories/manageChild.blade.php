<ul >
    @foreach($children as $index => $child)
        <li>
            {{ $child->title }} <i style="display: {{$index == 0 ? 'none' : ''}}" class="fa fa-arrow-up" onclick="updateSortOrder('{{$child->id}}', '{{$child->parent_id}}', 'up')"></i> <i style="display: {{$index == (count($children) - 1) ? 'none' : ''}}" class="fa fa-arrow-down" onclick="updateSortOrder('{{$child->id}}', '{{$child->parent_id}}', 'down')"></i>
            @if(count($child->children))
                @include('admins.categories/manageChild',['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
