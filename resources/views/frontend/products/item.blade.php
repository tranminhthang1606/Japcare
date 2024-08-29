<div class="wrap">
    <a href="{{ route('product-detail', $prd->slug) }}" title="{{ $prd->title }}">
        <img src="{{ asset($prd->featured_img) }}" alt="{{ $prd->title }}">
    </a>
    <div class="new_product-content w-100 p-2">
        @if(collect($prd->productSizes)->sum('stock') == 0 )
            <span class="new_product-gift sold-out">Hết hàng</span>
        @endif
        <a href="{{ route('product-detail', $prd->slug) }}">{{ $prd->title }}</a>
        <div class="product_rating-sold">
            <div class="product_rating">3.8 ★</div>
            <div class="product_sold">Đã bán {{ $prd->number_sold }}</div>
        </div>
        <div class="product_price">
            @if ($prd->discount)
                <span class="price">{{ number_format($prd->sale_price)  }} đ</span>
                <del class="old-price">{{ number_format($prd->price)  }} đ</del>
                <span class="percent">-{{ number_format($prd->discount)  }} %</span>
            @else
                <span class="price">{{ number_format($prd->price)  }} đ</span>
            @endif
        </div>
    </div>
</div>
