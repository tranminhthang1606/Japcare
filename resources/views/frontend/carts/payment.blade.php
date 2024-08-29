@extends('frontend.layouts.master')
@section('title', 'Thanh toán')

@section('content')
    <div class="main-pay">
        <div class="about payment-page">
            <div class="container">
                @if ($errors->any())
                    <ul class="alert alert-error" style="list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd5 x">
                        <h1 class="title_about">Thanh toán đơn hàng</h1>
                        <form class="checkout" method="post" action="{{ route('checkout') }}">
                            @csrf
                            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 pd5 x payment">
                                <div class="customer_checkout">
                                    <h3>Thông tin thanh toán</h3>
                                    <div class="form-group">
                                        <label>Họ và tên&nbsp; <i class="txt_req">*</i></label>
                                        <input type="text" name="billing_name" @if(isset($dataAddress->client_name)) value="{{$dataAddress->client_name}}" @endif
                                               placeholder="Nhập đầy đủ họ và tên của bạn" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại&nbsp;<i class="txt_req">*</i></label>
                                        <input id="billing_phone" type="tel" name="billing_phone" @if(isset($dataAddress->client_phone)) value="{{$dataAddress->client_phone}}" @endif
                                               placeholder="Số điện thoại" onchange="inputPhoneTyping()" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ email&nbsp;</label>
                                        <input id="billing_email" type="email" class="input-text" name="billing_email" onchange="inputEmailTyping()" placeholder="Mail"
                                                @if(isset($infoCustomer->email)) value="{{$infoCustomer->email}}" @endif>
                                    </div>
                                    <div class="row row5">
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <label for="provinces">
                                                Chọn tỉnh/thành phố <i class="txt_req">*</i>
                                            </label>
                                            <select class="form-control" name="bill_province">
                                                <option value="" selected>Chọn tỉnh/thành phố</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{$province->matp}}" {{isset($dataAddress->province_id) ? ($dataAddress->province_id == $province->matp ? 'selected' : '') : ''}}>{{$province->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <label for="district">
                                                Chọn quận/huyện <i class="txt_req">*</i>
                                            </label>
                                            <select class="form-control" name="bill_district">
                                                <option value="" selected>Chọn quận/huyện</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <label for="wards"> Chọn xã/phường <i class="txt_req">*</i>
                                            </label>
                                            <select class="form-control" name="bill_wards">
                                                <option value="" selected>Chọn xã/phường</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row-wide form-group">
                                        <label>Địa chỉ&nbsp;<i class="txt_req">*</i></label>
                                        <input type="text" name="billing_address" placeholder="Địa chỉ" @if(isset($dataAddress->address)) value="{{$dataAddress->address}}" @endif required>
                                    </div>
                                    <div class="clear form-group">
                                        <div class="form-row notes">
                                            <label>Ghi chú đơn hàng</label>
                                            <textarea class="form-control" name="order_comments" placeholder="Ghi chú." rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 pd5 x cart-wrap">
                                <div class="col-inner has-border">
                                    <h3 id="order_review_heading">Đơn hàng của bạn</h3>
                                    <div class="order_review">
                                        @if(Session::get('cart'))
                                            @php
                                                $totalPrice = 0;
                                            @endphp
                                            <table class="shop_table">
                                                <thead>
                                                <tr>
                                                    <th style="width: 80%" class="product-name">Sản phẩm</th>
                                                    <th style="width: 20%" class="product-total">Tạm tính</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach (Session::get('cart') as $key => $cartItem)
                                                    @php
                                                        $totalPrice += $cartItem['price']*$cartItem['product_qty'];
                                                    @endphp
                                                    <tr class="cart_item">
                                                        <td class="product-name">
                                                            {{$cartItem['title']}}&nbsp; - <span>/</span> <span>{{$cartItem['title_size']}}</span>
                                                            <strong class="product-quantity">×&nbsp;{{$cartItem['product_qty']}}</strong>
                                                        </td>
                                                        <td class="product-total">
                                                            <span class="amount">{{number_format($cartItem['price']*$cartItem['product_qty'])}} đ</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr class="ship_fee">
                                                        <th>Phí ship</th>
                                                        <td>
                                                            <strong>
                                                                <span class="fee">0</span>
                                                                <input type="hidden" name="ship_fee" />
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Tổng</th>
                                                        <td>
                                                            <strong>
                                                                <span class="amount">{{number_format($totalPrice)}} đ</span>
                                                                <input type="hidden" name="order-total" value="{{$totalPrice}}" />
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        @else
                                            <h3 id="order_review_heading">Giỏ hàng rỗng</h3>
                                        @endif
                                        <div id="payment">
                                            <ul>
                                                <li>
                                                    <input type="radio" class="input-radio" name="payment_method" value="cod" checked="checked">
                                                    <label> Trả tiền mặt khi nhận hàng </label>
                                                </li>
                                                <li>
                                                    <input type="radio" class="input-radio" name="payment_method" value="bacs">
                                                    <label> Chuyển khoản ngân hàng </label>
                                                    <div class="bank_info" style="display: none">
                                                        @if($generalsetting->bank_transfer_guide)
                                                            {!! $generalsetting->bank_transfer_guide !!}
                                                        @endif
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="form-row place-order">
                                                <button type="submit" class="button" id="place_order">Đặt hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        Thông tin cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng, tăng trải nghiệm sử
                                        dụng website, và cho các mục đích cụ thể khác đã được mô tả trong "Chính sách bảo mật"
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready( function (){
            $(`select[name="bill_province"]`).on("change", function () {
                //get districts
                const matp = $(this).val();
                //total
                let total = Number($(`input[name="order-total"]`).val()) - Number($(`input[name="ship_fee"]`).val());
                if (matp) {
                    $.get("{{route('cart.getDistrictsByProvince')}}", {matp}, function (res) {
                        if (res.code == 200) {
                            let html = `<option value="" selected>Chọn quận/huyện</option>`;
                            for (let i = 0; i < res.data.length; i++) {
                                html += `<option value="${res.data[i].maqh}">${res.data[i].name}</option>`
                            }
                            $(`select[name="bill_district"]`).html(html)
                            $(`select[name="bill_wards"]`).html(`<option value="" selected>Chọn xã/phường</option>`);
                        } else {
                            $(`select[name="bill_district"]`).html(`<option value="" selected>Chọn quận/huyện</option>`);
                            $(`select[name="bill_wards"]`).html(`<option value="" selected>Chọn xã/phường</option>`);
                        }
                    });

                    //ship fee
                    $.get("{{route('cart.getShipFeeByProvince')}}", {matp}, function (res) {
                        if (res.code == 200) {
                            $(`input[name="ship_fee"]`).val(res.data.fee)
                            const feeFormat = new Intl.NumberFormat('en-US', {style: 'decimal'}).format(res.data.fee);
                            $('.ship_fee .fee').text(feeFormat + ' đ')
                            total += Number(res.data.fee);
                        } else {
                            $(`input[name="ship_fee"]`).val(0)
                            $('.ship_fee .fee').text(0)
                        }
                        $(`input[name="order-total"]`).val(total);
                        const totalFormat = new Intl.NumberFormat('en-US', {style: 'decimal'}).format(total);
                        $(`.order-total .amount`).text(totalFormat + ' đ');
                    });
                } else {
                    $(`select[name="bill_district"]`).html(`<option value="" selected>Chọn quận/huyện</option>`);
                    $(`select[name="bill_wards"]`).html(`<option value="" selected>Chọn xã/phường</option>`);
                    $(`input[name="ship_fee"]`).val(0)
                    $('.ship_fee .fee').text(0)

                    $(`input[name="order-total"]`).val(total);
                    const totalFormat = new Intl.NumberFormat('en-US', {style: 'decimal'}).format(total);
                    $(`.order-total .amount`).text(totalFormat);
                }
            })

            $(`select[name="bill_district"]`).on("change", function () {
                //get districts
                const maqh = $(this).val();
                if (maqh) {
                    $.get("{{route('cart.getWardsByProvince')}}", {maqh}, function (res) {
                        if (res.code == 200) {
                            let html = `<option value="" selected>Chọn xã/phường</option>`;
                            for (let i = 0; i < res.data.length; i++) {
                                html += `<option value="${res.data[i].xaid}">${res.data[i].name}</option>`
                            }
                            $(`select[name="bill_wards"]`).html(html)
                        } else {
                            $(`select[name="bill_wards"]`).html(`<option value="" selected>Chọn xã/phường</option>`);
                        }
                    });
                } else {
                    $(`select[name="bill_wards"]`).html(`<option value="" selected>Chọn xã/phường</option>`);
                }
            });
            //payment
            $('.input-radio').on('click', function () {
                let radioVal = $(this).val();
                if(radioVal == 'bacs'){
                    $('.bank_info').show('slow');
                }else{
                    $('.bank_info').hide('slow');
                }
            });
        });

        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        function inputEmailTyping() {
            let email = jQuery('#billing_email').val();
            if(!email || !validateEmail(email)) {
                $('#place_order').prop('disabled', true);
                $('#billing_email').css('border', '1px solid red');
            }else{
                $('#place_order').prop('disabled', false);
                $('#billing_email').css('border', '1px solid #ccc');
            }
        }

        function is_phonenumber(phonenumber) {
            var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
            if (phonenumber.match(phoneno)) {
                return true;
            } else {
                return false;
            }
        }
        function inputPhoneTyping() {
            let phoneTxt = jQuery('#billing_phone').val();
            let first_character = parseInt(phoneTxt.charAt(0));
            let flag = 1;
            if(first_character != 0){
                flag = 0;
            }else{
                flag = 1;
            }
            if(!phoneTxt || !is_phonenumber(phoneTxt) || phoneTxt == '0123456789') {
                $('#place_order').prop('disabled', true);
                $('#billing_phone').css('border', '1px solid red');
            }else{
                if(flag == 1){
                    $('#place_order').prop('disabled', false);
                    $('#billing_phone').css('border', '1px solid #ccc');
                }
            }
        }
    </script>
@endsection
