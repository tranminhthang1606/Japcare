@extends('frontend.layouts.master')
@section('title', 'Giỏ hàng')

@section('content')
<div class="cart-main">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb new cart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">Trang chủ</a>
                </li>
                <li class="breadcrumb-item">Giỏ hàng</li>
            </ol>
        </nav>
    </div>
    <!--Khi không có sản phẩm-->


    <!--Khi có sản phẩm-->
    <div class="container pay-main">
        <form action="{{route('checkout')}}" method="POST" id="my-order" class="bv-form">
            @csrf
            <div class="main-content row" id="main-content">

                @if (count($data) > 0)
                <div class="col-sm-6 order-mobile-1">
                    <div class="address_form_setting payment-info mb-3">
                        <div class="pay-img-line form-payment position-relative">
                            <img class="line" src="{{ asset('frontend/images/') }}/pay-line.png" alt="">
                            <div class="d-flex address-header">
                                <h5>Thông tin giao hàng</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6 customer-name">
                                    <div class="form-group custom mb-3">
                                        <div class="input-item">
                                            <input type="text" name="billing_name" placeholder="Họ và Tên" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 customer-phone">
                                    <div class="form-group custom mb-3">
                                        <div class="input-item">
                                            <input type="text" name="billing_phone" placeholder="Số điện thoại"
                                                maxlength="15" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-12 mb-3">
                                    <select id="selectProvince" name="billing_province"
                                        class="form-select js-example-basic-single">
                                        <option value="" selected>Tỉnh / Thành Phố</option>
                                        @foreach ($provinces as $item)
                                        <option value="{{$item->matp}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 col-sm-12 mb-3">
                                    <select class="form-select js-example-basic-single" name="billing_district" disabled
                                        id="selectDistrict">
                                        <option value="" selected>Quận / Huyện</option>

                                    </select>
                                </div>
                                <div class="col-lg-4 col-sm-12 mb-3">
                                    <select class="form-select js-example-basic-single" name="billing_wards" disabled
                                        id="selectWard">
                                        <option value="" selected>Phường / Xã</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-s mb-3">
                                    <div class="form-group custom mb-0">
                                        <div class="input-item full">
                                            <input type="email" id="address" name="billing_email" required
                                                placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-s address-full">
                                    <div class="form-group custom mb-0">
                                        <div class="input-item full">
                                            <input type="text" id="address" maxlength="50" name="billing_address"
                                                placeholder="Địa chỉ cụ thể">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="payment-info mb-3" id="payment-trigger">
                        <h5>Phương thức thanh toán</h5>
                        <div class="form-radio">
                            <div class="box-radio">
                                <label class="custom-check">
                                    <input class="input" type="radio" value="1" name="payment_method" checked>
                                    <span>Thanh toán khi nhận hàng (COD)</span>
                                </label>
                            </div>
                            <div class="box-radio">
                                <label class="custom-check">
                                    <input class="input" type="radio" value="2" name="payment_method">
                                    <span>Thanh toán chuyển khoản ngân hàng</span>
                                </label>
                                <p class="payment-atm-info">Ưu đãi dành cho khách hàng chuyển khoản trước qua ATM,
                                    Internet banking, ngân hàng, ví điện tử.<br>
                                    – Miễn phí vận chuyển toàn quốc với đơn hàng &gt; 500.000d<br>
                                    (Vận chuyển hàng qua đối tác GHN-Giao hàng nhanh)<br>
                                    …………………………………………..<br>
                                    Một số tài khoản Adtclothing.com<br>
                                    …………………………………………..<br>
                                    Ngân hàng ngoại thương Vietcombank<br>
                                    Chủ TK: Nguyễn A<br>
                                    Số TK: 00110xxxxx<br>
                                    Chi nhánh Hà Nội<br>
                                    …………………………………………..<br>
                                    Ngân hàng kỹ thương Techcombank<br>
                                    Chủ TK: Nguyễn A<br>
                                    Số TK: 19024xxxxx<br>
                                    Chi nhánh Hà Nội</p>
                            </div>
                        </div>
                    </div>
                    <div class="payment-info mb-3 ptvc">
                        <h5 class="title">Phương thức vận chuyển</h5>
                        <div class="form-radio">
                            <div id="delivery_methods">
                                <div class="box-radio delivery_methods position-relative">
                                    <div class="payment-title-ship">
                                        <label class="custom-check">
                                            <input checked class="input payment_trans_Giao hàng tiêu chuẩn" value="0"
                                                type="radio" name="payment_trans">
                                            <span>Giao hàng tiêu chuẩn</span> <span class="checkmark"></span>
                                        </label>
                                        <span class="custom-payment payment_trans_fee_-1">0đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-item">
                            <textarea class="form-control mt-3" name="order_note" rows="2"
                                placeholder="Thêm ghi chú về đơn hàng"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-mobile-2">
                    <div class="cart-listing">
                        <div class="box-cart-result pay-box-product">
                            <div class="cart-table table-custom table-order-new">
                                <div class="table-header-cart" style="border: none;">
                                    <div class="col-12">
                                        <div class="cart-product">
                                            <div class="col-item w-3">
                                                <span class="count-cart-new">Giỏ hàng ({{count($data)}} sản phẩm)</span>
                                            </div>
                                            <div class="col-item">
                                                <span>Đơn giá</span>
                                            </div>
                                            <div class="col-item justify-content-center">
                                                <span>Số lượng</span>
                                            </div>
                                            <div class="col-item">
                                                <span>Thành tiền</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-body-cart">
                                    @foreach ($data as $index =>$item)
                                    <div class="cart-product-choose" id="cart-product-{{$item['product_size_id']}}">
                                        <div class="col-item w-3 d-flex">
                                            <a href="#" class="title-orders product-img"
                                                title="Kem chống nắng nâng tông và bảo vệ da Ciracle Radiance White Tone-up &amp; UV Protection (30ml)">
                                                <img class="img-cart" src="{{ asset($item['product_image']) }}"
                                                    alt="Kem chống nắng nâng tông và bảo vệ da Ciracle Radiance White Tone-up &amp; UV Protection (30ml)"
                                                    width="75">
                                            </a>
                                            <div>
                                                <a href="#" class="title-orders product-img"
                                                    title="Kem chống nắng nâng tông và bảo vệ da Ciracle Radiance White Tone-up &amp; UV Protection (30ml)">
                                                    <span>
                                                        {{Str::limit($item['title'], 50)}} ({{$item['title_size']}})
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-item">
                                            <span class="price">

                                                @if ($item['price']>$item['sale_price'])
                                                <del>{{number_format($item['price'],0,'.','.')}}đ</del>
                                                @endif
                                                <input type="hidden" id="old_item_price_{{$item['product_size_id']}}"
                                                    value="{{$item['price']}}">
                                                <span
                                                    id="discount_item_price_{{$item['product_size_id']}}">{{number_format($item['sale_price'],0,'.','.')}}đ</span>
                                            </span>
                                        </div>
                                        <div class="col-item buy-total justify-content-center">
                                            <div class="number-quantity cart">
                                                <span class="minus" data-id={{$item['product_size_id']}}>-</span>
                                                <input type="text" class="quantity_item"
                                                    id="quantity_{{$item['product_size_id']}}"
                                                    data-id={{$item['product_size_id']}} max="{{$item['stock']}}"
                                                    value="{{$item['product_qty']}}" min="1" />
                                                <span class="plus" data-stock={{$item['stock']}}
                                                    data-id={{$item['product_size_id']}}>+</span>
                                                {{-- data-stock={{$item['stock']}} --}}
                                            </div>
                                        </div>
                                        <div class="col-item">
                                            <div>
                                                <input class="total_old_price"
                                                    id="total_old_price_{{$item['product_size_id']}}" type="hidden"
                                                    value="{{number_format($item['price']*$item['product_qty'],0,'.','.')}}">
                                                <span id="total_discount_price_{{$item['product_size_id']}}"
                                                    class="total-price total-product-price fw-500">{{number_format($item['sale_price']?$item['sale_price']*$item['product_qty']:$item['price']*$item['product_qty'],0,'.','.')}}đ</span>
                                                <span class="cart-remove-item"
                                                    onclick="removeFromCart({{$item['product_size_id']}});">
                                                    <i class="fa-solid fa-trash-can"></i> Xóa
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach

                                </div>
                                <div class="detail-info-payment">
                                    <div class="block-cart-total">
                                        <div class="item-group">
                                            <p class="title-price mb-2">Tạm tính</p>
                                            <span id="price_product_only"
                                                class="price price_product_only">270.000đ</span>
                                        </div>
                                        <div class="item-group">
                                            <p class="title-price mb-2"> Phí vận chuyển</p>
                                            <span class="price price_trans_only">0đ</span>
                                        </div>
                                        <div class="item-group">
                                            <p class="title-price mb-2">Giảm giá sản phẩm</p>
                                            <span id="product-discounts" class="product-discounts">-110.000đ</span>
                                        </div>
                                        <div class="item-group">
                                            <p class="title-price mb-0">Voucher</p>
                                            <span class="voucher-discount-price-format">0đ</span>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                    <div class="total-price mb-2">
                                        <span>Tổng cộng</span>
                                        <strong id="price_total_after_discount"
                                            class="price_total_after_discount">160.000đ</strong>
                                    </div>
                                    <div class="btn-payment-pc">
                                        <button type="submit" class="btn">Thanh toán</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="container cart-main" id="no-results-cart">
                    <div class="no-results">
                        <img src="{{ asset('frontend/images/') }}/cart.png" alt="icon">
                        <p>Bạn chưa có sản phẩm trong giỏ hàng</p>
                        <a class="btn go-to-shop" href="{{route('products')}}">
                            <i class="fas fa-search"></i>
                            Khám phá sản phẩm
                        </a>
                    </div>
                </div>
                @endif
                {{-- <div class="col-lg-12 col-12 fixed-block-payment order-mobile-3" id="block-payment">--}}
                    {{-- <div class="block-payment-cart payment-info text-center">--}}
                        {{-- <div class="wrap-box">--}}
                            {{-- <div class="block-payment-cart-info">--}}
                                {{-- <div class="show-detail-product">--}}
                                    {{-- <p class="total-payment-count-product mb-2">--}}
                                        {{-- Tổng cộng <span class="count-product-in-cart">(2 sản phẩm)</span>--}}
                                        {{-- <span class="cart-show-detail">--}}
                                            {{-- <i class="fa-solid fa-angle-up"></i>--}}
                                            {{-- <span class="view-detail-info-payment">Xem chi tiết</span>--}}
                                            {{-- </span>--}}
                                        {{-- </p>--}}
                                    {{-- <p class="total-payment-price price_total_after_discount mb-2">160.000đ</p>--}}
                                    {{-- --}}
                                    {{-- </div>--}}
                                {{-- <input type="hidden" id="shipping_fee" name="shipping_fee">--}}
                                {{-- <input type="hidden" id="price_total_un_format">--}}
                                {{-- <input type="hidden" id="total_has_transport">--}}
                                {{-- <input type="hidden" name="tracking_utm" id="tracking_utm">--}}
                                {{-- <input type="hidden" name="tracking_referral_affiliate"
                                    id="tracking_referral_affiliate">--}}
                                {{-- </div>--}}
                            {{-- </div>--}}
                        {{-- <div class="cart-action pay-submit">--}}
                            {{-- <button id="button-submit-my-order" type="submit" class="btn btn-payment-success" --}}
                                {{-->Thanh toán--}}
                                {{-- </button>--}}
                            {{-- </div>--}}
                        {{-- </div>--}}
                    {{-- </div>--}}
            </div>
        </form>
    </div>

</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {   
        function resetPrice(){
            let total_price=0;        
        let old_price=0;
            $('.total-product-price').map(function(){           
            total_price += parseInt($(this).text().replace(/[^\d]/g, ''));           
        })
        $('.total_old_price').map(function(){           
            old_price += parseInt($(this).val().replace(/[^\d]/g, ''));           
        })

        
        $('#price_product_only').html(new Intl.NumberFormat('vi-VN').format(old_price) + 'đ');
        $('#price_total_after_discount').html(new Intl.NumberFormat('vi-VN').format(total_price) + 'đ');
        $('#product-discounts').html(new Intl.NumberFormat('vi-VN').format(old_price-total_price) + 'đ');
        }
        resetPrice();
       
        
        $('.js-example-basic-single').select2();
           
            $('.minus').on('click', function () {
                let key = $(this).attr("data-id");
                console.log(key);
                let qty = $('#quantity_' + key).val();
                if (qty > 1) {
                    $('#quantity_' + key).val(parseInt(qty) - 1);
                
                    updateQuantity(key, parseInt(qty) - 1, 'm');
                }
            });

            $('.plus').on('click', function () {
                let key = $(this).attr("data-id");
                let stock = $(this).attr("data-stock");
                
                let qtyPlus = $('#quantity_' + key).val();
                if (qtyPlus < stock) {
                    $('#quantity_' + key).val(parseInt(qtyPlus) + 1);
                    updateQuantity(key, parseInt(qtyPlus) + 1, 'p');
                }
            });
            //
            $('.view-detail-info-payment').on('click', function() {
                if($(this).text() == 'Xem chi tiết'){
                    $(this).text('Thu gọn');
                    $('.cart-down').show();
                    $('.cart-up').hide();
                }else{
                    $(this).text('Xem chi tiết');
                    $('.cart-down').hide();
                    $('.cart-up').show();
                }
                $('.detail-info-payment').toggleClass('active');
            });
            $('.box-radio .custom-check input').on('click', function() {
                if($(this).val() == 2){
                    $('.payment-atm-info').show(    );
                }else{
                    $('.payment-atm-info').hide();
                }
            })

            let fixmeTop = $('.main-footer').offset().top;
            $(window).scroll(function() {
                let currentScroll = $(window).scrollTop() + 1000;
                let a = currentScroll + 100;
                if (currentScroll  < fixmeTop) {
                    $('.fixed-block-payment').removeClass('clear-fixed')
                } else {
                    $('.fixed-block-payment').addClass('clear-fixed');
                }
            });

        });

        function removeFromCart(key) {
           
            var price = parseInt($('#discount_item_price_' + key).text().replace(/[^\d]/g, '')) * parseInt($('#quantity_' + key).val());
            var oldPrice = parseInt($('#old_item_price_' + key).val() * parseInt($('#quantity_' + key).val()));
            
            var total_price = parseInt($('#price_total_after_discount').text().replace(/[^\d]/g, '')) - price;
            
            var total_old_price = parseInt($('#price_product_only').text().replace(/[^\d]/g, '')) - oldPrice;
    
            $('#price_total_after_discount').html(new Intl.NumberFormat('vi-VN').format(total_price) + 'đ');
            $('#price_product_only').html(new Intl.NumberFormat('vi-VN').format(total_old_price) + 'đ');
            $('#product-discounts').html(new Intl.NumberFormat('vi-VN').format(total_old_price-total_price) + 'đ');

            $.post('{{route('cart.removeFromCart')}}',{
                _token: '{{ csrf_token() }}',
                key: key,
            },function(){
                $('#cart-product-' + key).remove();
            var rowCount = $('.table-body-cart').html();
            if (rowCount == 0) {
                $('#main-content').empty();
                var no_result_html =`
                <div class="container cart-main" id="no-results-cart">
                    <div class="no-results">
                        <img src="{{ asset('frontend/images/') }}/cart.png" alt="icon">
                        <p>Bạn chưa có sản phẩm trong giỏ hàng</p>
                        <a class="btn go-to-shop" href="{{route('products')}}">
                            <i class="fas fa-search"></i>
                            Khám phá sản phẩm
                        </a>
                    </div>
                </div>`;
                $('#main-content').append(no_result_html);
            }
            })
            
        }
               
        $('#selectProvince').on('change',function(){
            $.get('{{route('cart.getDistrictsByProvince')}}',{
                _token: '{{ csrf_token() }}',
                matp: $(this).val(),
            },function(data){
                console.log(data);                                
                $('#selectDistrict').empty();                          
                $('#selectWard').empty();                    
                var list_html='<option value="" selected>Quận / Huyện</option>';
                $('#selectDistrict').removeAttr('disabled'); 
                $('#selectWard').attr('disabled',true);
                data.data.forEach(item => {
                    console.log(item);
                    list_html+=' <option value="'+item.maqh+'">'+item.name+'</option>';
                });
                $('#selectDistrict').append(list_html);
                             
            })
        })

        $('#selectDistrict').on('change',function(){
            $.get('{{route('cart.getWardsByProvince')}}',{
                _token: '{{ csrf_token() }}',
                maqh: $(this).val(),
            },function(data){
                console.log(data);
                $('#selectWard').empty();
                
                var list_html='<option value="" selected>Phường / Xã</option>';  
                $('#selectWard').removeAttr('disabled');      
                data.data.forEach(item => {
                    console.log(item);
                    list_html+=' <option value="'+item.xaid+'">'+item.name+'</option>';
                });
                $('#selectWard').append(list_html);
                              
            })
        })

        // function validateNumberInput(event) {
        //     const input = event.target;
        //     const value = input.value;
        //     console.log(input.max);
        //     if (isNaN(value)) {
        //         alert("Vui lòng nhập số.");
        //         input.value = 1; // Clear the input if it's not a valid number
        //     }
        //     if(value<0){
        //         alert("Vui lòng nhập một số dương hợp lệ.");
        //         input.value = 1;
        //     }
        //     if(value>input.max){
        //         console.log(value);
        //         alert("Quá số lượng hàng còn lại.");
        //         input.value = input.max;
        //     }
        // }

        $('.quantity_item').on('keyup',function(){
            var key = $(this).attr("data-id");
            var value = $(this).val();
            var max = $(this).attr('max');
            console.log(max);
            if(isNaN(value)){
                $(this).val(1);
                updateQuantity(key,1,'m');
                return
            }
            if(value <0){
                $(this).val(1);
                updateQuantity(key,1,'m');
                return;
            }
            if(value>max){
                $(this).val(max);
                updateQuantity(key,max,'p');
                return;
            }   
            updateQuantity(key,value,'m');
            
        })
               
        

        function updateQuantity(key, qty, str) {
            $.post('{{ route('cart.updateQuantity') }}', {
                _token: '{{ csrf_token() }}',
                key: key,
                product_qty: qty
            }, function (data) {
                if (data == 1) {
                    var price = parseInt($('#discount_item_price_' + key).text().replace(/[^\d]/g, '')) * qty;
                    var oldPrice = parseInt($('#old_item_price_' + key).val() * qty);
                    var priceChange = new Intl.NumberFormat('vi-VN').format(price);
                    var oldPriceChange  = new Intl.NumberFormat('vi-VN').format(oldPrice);
                    console.log(priceChange,oldPrice);
                    $('#total_discount_price_' + key).html(priceChange + 'đ');
                    $('#total_old_price_'+key).val(oldPriceChange);

                    var total_price=0;        
                    var old_price=0;
                    $('.total-product-price').map(function(){           
                    total_price += parseInt($(this).text().replace(/[^\d]/g, ''));           
                    })
                    $('.total_old_price').map(function(){           
                        old_price += parseInt($(this).val().replace(/[^\d]/g, ''));           
                    })

                    $('#price_product_only').html(new Intl.NumberFormat('vi-VN').format(old_price) + 'đ');
                    $('#price_total_after_discount').html(new Intl.NumberFormat('vi-VN').format(total_price) + 'đ');
                    $('#product-discounts').html(new Intl.NumberFormat('vi-VN').format(old_price-total_price) + 'đ');
                }
            });
        }
</script>
@endsection