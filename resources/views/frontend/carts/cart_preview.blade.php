<div class="items_cart">
    @php
        $totalPrice = 0;
    @endphp
    @if(count(Session::get('cart', [])) > 0)
        @foreach(Session::get('cart', []) as $key => $item_cart)
            <div class="item_cart-show">
                <div class="item-show">
                    <div class="item-show-img">
                        <a href="{{ route('product-detail', $item_cart['slug']) }}" title="{{$item_cart['title']}}">
                            <img src="{{asset($item_cart['product_image'])}}" alt="{{$item_cart['title']}}">
                        </a>
                    </div>
                    <div class="item-show-title">
                        <a href="{{ route('product-detail', $item_cart['slug']) }}">
                            <h4>{{$item_cart['title']}}</h4>
                        </a>
                        <h5><span>{{$item_cart['color']}}</span> / <span>{{$item_cart['title_size']}}</span></h5>
                        <div class="show-qp">
                            <p class="qp-quantity">{{number_format($item_cart['product_qty'])}}</p>
                            <p>{{number_format($item_cart['price'])}}</p>
                        </div>
                    </div>
                    <div class="item-show-icon" onclick="removeFromCart('{{$key}}')">
                        <i class="fa-regular fa-circle-xmark"></i>
                    </div>
                </div>
            </div>
            @php
                $totalPrice += $item_cart['price']*$item_cart['product_qty']
            @endphp
        @endforeach
    @else
        <div class="item_cart-empty">
            <i class="fa-solid fa-cart-shopping"></i>
            <p>Hiện chưa có sản phẩm</p>
        </div>
    @endif
</div>
@if(count(Session::get('cart', [])) > 0)
    <div class="cart_sum-price">
        <span class="sum-price-title">Tổng tiền:</span>
        <span class="sum-price">{{number_format($totalPrice)}}đ</span>
    </div>
    <div class="cart_pay-view">
        <a class="cart-view" href="{{ route('cart') }}">Xem giỏ hàng</a>
        <a class="pay-view" href="{{ route('payment') }}">Thanh toán</a>
    </div>
@endif

