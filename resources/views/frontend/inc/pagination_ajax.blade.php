<ul class="pagination">
    @if ($current_page > 1)
        <li class="page-item">
            <a class="page-link" data-value="{{$current_page - 1}}" rel="prev">Previous</a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($page_arr as $pageItem)
        @if ($pageItem == "...")
            <li class="page-item active">
                <a style="background: #212529;border: none;color: #fff;" class="page-link">{{ $pageItem }} <span class="sr-only">(current)</span></a>
            </li>
        @else
            @if ($pageItem == $current_page)
                <li class="page-item active">
                    <a style="background: #212529;border: none;color: #fff;" class="page-link">{{ $pageItem }} <span class="sr-only">(current)</span></a>
                </li>
            @else
                <li class="page-item">
                    <a data-value="{{$pageItem}}" class="page-link">{{ $pageItem }}</a>
                </li>
            @endif
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($current_page < $page_number)
        <li class="page-item">
            <a data-value="{{$current_page + 1}}" class="page-link" rel="next">Next</a>
        </li>
    @endif
</ul>
