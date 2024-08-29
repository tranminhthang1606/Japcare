<nav class="breadcrumb-shop" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a
                href="{{route('products', $product->category->slug)}}">{{$product->category->title}}</a></li>

        @if($product->is_new == 1)
            <li class="breadcrumb-item">
                <a href="{{route('products_collections', 'san-pham-moi')}}">
                    Sản phẩm mới
                </a>
            </li>
        @endif
        @if($product->is_favourite == 1)
            <li class="breadcrumb-item">
                <a href="{{route('products_collections', 'yeu-thich-nhat')}}">
                    Yêu thích nhất
                </a>
            </li>
        @endif
        <li class="breadcrumb-item">
            <a href="{{route('brand.detail', $product->brand->slug)}}">
                {{$product->brand->title}}
            </a>
        </li>
        <li class="breadcrumb-item">
            <span class="last" style="font-weight: 600">{{$product->title}}</span>
        </li>
    </ol>
</nav>
