@extends('frontend.layouts.master')
@section('title', 'Giỏ hàng')

@section('content')
    <div class="main-content">
        <div class="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 pd5">
                        <div class="content_about">
                            <h1 class="title_about">Giỏ hàng của bạn</h1>
                            @if(Session::has('cart') && count($cart = Session::get('cart')) > 0)
                                <div class="list_product_cart">
                                    <div class="list_title">
                                        <div class="title_image">Ảnh sản phẩm</div>
                                        <div class="title_name">Sản phẩm</div>
                                        <div class="title_price">Giá</div>
                                        <div class="title_number">Số lượng</div>
                                        <div class="title_total">Tổng tiền</div>
                                    </div>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach(Session::get('cart') as $key => $cartItem)
                                        @php
                                            $total = $total + $cartItem['price']*$cartItem['product_qty'];
                                        @endphp
                                        <div class="item_cart item_cart_{{$key}}">
                                            <div class="image">
                                                <a href="{{route('product-detail', $cartItem['slug'])}}" title="{{$cartItem['title']}}">
                                                    <img style="max-width: 100px" src="{{asset($cartItem['product_image'])}}" alt="{{$cartItem['title']}}">
                                                </a>
                                            </div>
                                            <div class="item_cart-wrap">
                                                <div class="name">
                                                    <h2>
                                                        <a href="{{route('product-detail', $cartItem['slug'])}}" title="{{$cartItem['title']}}">
                                                            {{$cartItem['title']}}
                                                        </a>
                                                    </h2>
                                                    <h5><span>{{$cartItem['color']}}</span> / <span>{{$cartItem['title_size']}}</span></h5>
                                                    <p>
                                                        <a href="javascript:void(0);"
                                                           onclick="removeFromCartView(event, {{ $key }})" title="xóa">
                                                            <i class="fa-regular fa-trash-can"></i> Xóa
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="price">
                                                    <span class="amount">{{number_format($cartItem['price'])}}</span>
                                                    <input type="hidden" value="{{$cartItem['price']}}" name="price_hid" id="price_hi_{{ $key }}">
                                                </div>
                                                <div class="quantity-pm">
                                                    <button type="button" class="minus qty-minus" data-key="{{ $key }}">-</button>
                                                    <input id="quantity_{{ $key }}" type="number" value="{{$cartItem['product_qty']}}" class="qty" disabled />
                                                    <button type="button" data-key="{{ $key }}" class="plus qty-plus">+</button>
                                                </div>
                                                <div class="total_price">
                                                    <span class="amount">
                                                        {{number_format($cartItem['price']*$cartItem['product_qty'])}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="right_cart">
                                        <div class="total">
                                            <button class="btn_thanhtoan" type="button" onclick="window.location.href = `{{route('payment')}}`">
                                                Thanh toán
                                            </button>
                                        </div>
                                        <div class="mob_show">
                                            <p>{{number_format($total)}}</p>
                                            <input type="hidden" name="total_hide" id="total_hide" value="{{$total}}" />
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="null_style">
                                    <h3 style="text-align: center;">Chưa có sản phẩm nào trong giỏ hàng!</h3>
                                    <h4 style="text-align: center;">Xin quý khách vui lòng chọn sản phẩm.</h4>
                                </div>
                            @endif
                            <div id="cart_move_null" class="null_style" style="display: none;">
                                <h3 style="text-align: center;">Chưa có sản phẩm nào trong giỏ hàng!</h3>
                                <h4 style="text-align: center;">Xin quý khách vui lòng chọn sản phẩm.</h4>
                            </div>
                            <div class="product_relate">
                                <div class="title-section">
                                    <div class="cate_style">
                                        <h3>Sản phẩm đã xem</h3>
                                        <div class="swiper cartSwiper">
                                            <div class="swiper-wrapper">
                                                @foreach($data as $item)
                                                    <div class="swiper-slide">
                                                        <div class="card swiper-card" style="width: 100%;">
                                                            <div class="card_np">
                                                                <div class="new_product-img">
                                                                    <div class="image-default">
                                                                        <img src="{{ asset($item->featured_img) }}" alt="{{ $item->title }}">
                                                                        <div class="image-hover">
                                                                            @if($prodColor = collect($item->productColors)->first())
                                                                                @if($prodColor)
                                                                                    @if($imgProdColor = json_decode($prodColor->photo_color)[0])
                                                                                        <img src="{{asset($imgProdColor)}}">
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    @if ($item->is_sale == 1)
                                                                        <div class="sale_percent">
                                                                            sale
                                                                        </div>
                                                                    @endif
                                                                    @if(isset($item->productColors->stock) && $item->productColors->stock == 0)
                                                                        <div class="sold_out"> Hết hàng</div>
                                                                    @endif
                                                                    <div class="product_detail">
                                                                        <a href="{{ route('product-detail', $item->slug) }}" title="{{ $item->title }}">
                                                                            {{ $item->title }}
                                                                        </a>
                                                                        <p class="product_price">
                                                                            @if ($item->sale_price)
                                                                                <span class="price_highlight sale">{{ number_format($item->sale_price)  }} đ</span>
                                                                                <span class="price_del"><del>{{ number_format($item->price)  }} đ</del></span>
                                                                            @else
                                                                                <span class="price_del"><del>{{ number_format($item->price)  }} đ</del></span>
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 pd5">
                        <h2 class="title_news_tuetam">Bài viết mới nhất</h2>
                        <ul class="list_news_tuetam">
                            @foreach($articles as $item)
                                <li>
                                    <div class="row">
                                        <div class="col-md-4 col-xs-4">
                                            <a class="news_detail_title"
                                               title="{{$item->title}}">
                                                <img src="{{asset($item->thumbnail)}}" alt="Thumbnail bài viết">
                                            </a>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <a class="news_detail_title" href="{{route('news-detail', $item->slug)}}">
                                                {{$item->title}}
                                            </a>
                                            <div>
                                                <small><i class="fa fa-calendar" aria-hidden="true"></i></small>
                                                <small>{{$item->updated_at}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var swiperWidth = $('body').width();
        var swiper = new Swiper(".cartSwiper", {
            slidesPerView: swiperWidth < 1024 ? 2 : 4,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            //
            $('.qty-minus').on('click', function () {
                let key = $(this).attr("data-key");
                let qty = $('#quantity_' + key).val();
                if (qty > 1) {
                    $('#quantity_' + key).val(parseInt(qty) - 1);
                    updateQuantity(key, parseInt(qty) - 1, 'm');
                }
            });

            $('.qty-plus').on('click', function () {
                let key = $(this).attr("data-key");
                let qtyPlus = $('#quantity_' + key).val();
                if (qtyPlus < 100) {
                    $('#quantity_' + key).val(parseInt(qtyPlus) + 1);
                    updateQuantity(key, parseInt(qtyPlus) + 1, 'p');
                }
            });
        });

        function removeFromCartView(e, key) {
            e.preventDefault();
            removeFromCart(key);
            //
            let price = parseInt($('#price_hi_' + key).val()) * parseInt($('#quantity_' + key).val());
            let total_price = parseInt($('#total_hide').val()) - price;
            let totalChange = new Intl.NumberFormat('en-US', {style: 'decimal'}).format(total_price);

            $('.right_cart .mob_show p').html(totalChange + 'đ');
            $('#total_hide').val(total_price);
            //
            $('.item_cart_' + key).remove();
            let rowCount = $('.list_product_cart .item_cart').length;
            if (rowCount == 0) {
                $('.list_product_cart').remove();
                $('#cart_move_null').show();
            }
        }

        function updateQuantity(key, qty, str) {
            $.post('{{ route('cart.updateQuantity') }}', {
                _token: '{{ csrf_token() }}',
                key: key,
                product_qty: qty
            }, function (data) {
                if (data == 1) {
                    let price = parseInt($('#price_hi_' + key).val()) * qty;
                    let priceChange = new Intl.NumberFormat('en-US', {style: 'decimal'}).format(price);
                    let total_price = 0;
                    if (str === 'p') {
                        total_price = parseInt($('#total_hide').val()) + parseInt($('#price_hi_' + key).val());
                    } else {
                        total_price = parseInt($('#total_hide').val()) - parseInt($('#price_hi_' + key).val());
                    }
                    let totalChange = new Intl.NumberFormat('en-US', {style: 'decimal'}).format(total_price);

                    $('.item_cart_' + key + ' .amount').html(priceChange + 'đ');

                    $('.right_cart .mob_show p').html(totalChange + 'đ');
                    $('#total_hide').val(total_price);
                }
            });
        }
    </script>
@endsection
