@extends('admins.layouts.master')
@section('title', 'Chi tiết đơn hàng')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="invoice-masthead">
                                <div class="invoice-text">
                                    <h3 class="text-thin text-primary mt-0">Chi tiết đơn hàng</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <strong class="text-main">Tổng tiền của đơn hàng</strong>
                                    <p>
                                        <strong class="text-main" style="font-size: 16px; color: #0f6674">
                                            {{ number_format($order->grand_total) }} VNĐ
                                        </strong>
                                    </p>
                                </div>
                                <div class="col-lg-3">
                                    <label for=update_payment_status">Trạng thái thanh toán</label>
                                    <select name="payment_status" class="form-control" id="update_payment_status">
                                        @foreach(config('constants.payment_status') as $value => $name)
                                            <option value="{{ $value }}" {{ $order->payment_status == $value ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for=update_delivery_status">Trạng thái giao hàng</label>
                                    <select name="delivery_status" class="form-control" id="update_delivery_status">
                                        @foreach(config('constants.delivery_status') as $key => $val)
                                            <option value="{{ $key }}" {{ $order->delivery_status == $key ? 'selected' : '' }} @if($key == 1) disabled @endif >
                                                {{ $val }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for=update_order_status">Trạng thái đơn hàng</label>
                                    <select name="status" class="form-control" id="update_order_status">
                                        @foreach(config('constants.order_status') as $k => $value)
                                            <option value="{{ $k }}" {{ $order->status == $k ? 'selected' : '' }} @if($k == 1) disabled @endif >
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="invoice-bill row">
                                <div class="col-sm-6 text-xs-center">
                                    <address>
                                        <strong class="text-main">Họ tên: {{ $shipping_address->name }}</strong><br>
                                        Số điện thoại: {{ $shipping_address->phone }}<br>
                                        Email: {{ isset($shipping_address->email) ? $shipping_address->email : '' }}<br>
                                        Đại chỉ: {{ $shipping_address->address }}<br>
                                        <strong class="text-main">Ghi chú đơn hàng: </strong>{{ $order->order_note }}
                                    </address>
                                </div>
                                <div class="col-sm-6 text-xs-center">
                                    <table class="invoice-details">
                                        <tbody>
                                            <tr>
                                                <td class="text-main text-bold">
                                                    Mã đơn
                                                </td>
                                                <td class="text-right text-info text-bold">
                                                    {{ $order->code }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-main text-bold">
                                                    Giao hàng
                                                </td>
                                                <td class="text-right">
                                                    @if($order->status == 1)
                                                        <span class="badge badge-warning">
                                                            {{config('constants.order_status.'.$order->status)}}
                                                        </span>
                                                    @elseif($order->status == 2)
                                                        <span class="badge badge-success">
                                                            {{config('constants.order_status.'.$order->status)}}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">{{config('constants.order_status.'.$order->status)}}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-main text-bold">
                                                    Ngày tạo đơn
                                                </td>
                                                <td class="text-right">
                                                    {{ date('d-m-Y h:i A', $order->order_at) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-main text-bold">
                                                    Tổng tiền
                                                </td>
                                                <td class="text-right">
                                                    {{ number_format($order->grand_total) }} VNĐ
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-main text-bold">
                                                    Loại thanh toán
                                                </td>
                                                <td class="text-right">
                                                    @if ($order->payment_method == 2)
                                                        Chuyển khoản
                                                    @else
                                                        COD
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr class="new-section-sm bord-no">
                            <div class="table-rep-plugin">
                                <div class="table table-bordered table-responsive" data-pattern="priority-columns">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr class="bg-trans-dark">
                                            <th class="min-col">STT</th>
                                            <th class="text-uppercase">
                                                Tên sản phẩm
                                            </th>
                                            <th class="min-col text-center text-uppercase">
                                                {{__('Số lượng')}}
                                            </th>
                                            <th class="min-col text-center text-uppercase">
                                                {{__('Giá tiền')}}
                                            </th>
                                            <th class="min-col text-center text-uppercase">
                                                {{__('Tổng tiền')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($order->orderDetails->where('order_id', $order->id) as $key => $orderDetail)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>
                                                    <strong><a href="{{ route('product-detail', $orderDetail->product->slug ?? '') }}" target="_blank">{{ $orderDetail->product->title ?? '' }}</a></strong>
                                                    <p>
                                                        Size: {{ $orderDetail->title_size }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $orderDetail->quantity }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($orderDetail->price/$orderDetail->quantity) }} VNĐ
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($orderDetail->price) }} VNĐ
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 offset-8">
                                    <ul class="list-group list-group-flush rounded-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Tổng tiền:<strong>{{ number_format($order->grand_total - $order->shipping_fee) }} đ</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Phí vận chuyển:<span style="color: #1c7430">
                                            {{number_format($order->shipping_fee)}} đ
                                        </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Tổng thanh toán:</span>
                                            <strong style="color: #1c7430">
                                                {{number_format($order->grand_total)}} đ
                                            </strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- End panel-body -->
                    </div> <!--end panel -->
                </div><!-- end card body -->
            </div><!-- end card -->
        </div> <!-- end container-fluid -->
    </div> <!-- Page content Wrapper -->
@endsection

@section('bottom_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#update_delivery_status').on('change', function(){
                let order_id = {{ $order->id }};
                let delivery_status = $('#update_delivery_status').val();

                if(order_id && delivery_status){
                    $.ajax({
                        type: "POST",
                        dataType: 'JSON',
                        data: {_token:'{{ csrf_token() }}', 'order_id':order_id,'delivery_status':delivery_status},
                        url: '{{ route('orders.update_delivery_status') }}',
                        success: function (result) {
                            if (result.code == 1) {
                                showResultAlert('success', result.message);
                            }else{
                                showResultAlert('error', result.message);
                            }
                        },
                        error: function (error) {
                            showResultAlert('error', '500 Internal Server Error');
                            $this.attr("disabled", false);
                        }
                    });
                }
            });

            $('#update_payment_status').on('change', function(){
                let order_id = {{ $order->id }};
                let payment_status = $('#update_payment_status').val();
                if(order_id && payment_status){
                    $.ajax({
                        type: "POST",
                        dataType: 'JSON',
                        data: {_token:'{{ csrf_token() }}', 'order_id':order_id,'payment_status': payment_status},
                        url: '{{ route('orders.update_payment_status') }}',
                        success: function (result) {
                            if (result.code == 1) {
                                showResultAlert('success', result.message);
                            }else{
                                showResultAlert('error', result.message);
                            }
                        },
                        error: function (error) {
                            showResultAlert('error', '500 Internal Server Error');
                            $this.attr("disabled", false);
                        }
                    });
                }
            });

            $('#update_order_status').on('change', function(){
                let order_id = {{ $order->id }};
                let status = $('#update_order_status').val();
                if(order_id && status){
                    $.ajax({
                        type: "POST",
                        dataType: 'JSON',
                        data: {_token:'{{ csrf_token() }}', 'order_id':order_id,'status':status},
                        url: '{{ route('orders.update_order_status') }}',
                        success: function (result) {
                            if (result.code == 1) {
                                showResultAlert('success', result.message);
                                location.reload();
                            }else{
                                showResultAlert('error', result.message);
                            }
                        },
                        error: function (error) {
                            showResultAlert('error', '500 Internal Server Error');
                            $this.attr("disabled", false);
                        }
                    });
                }
            });

        });
    </script>
@endsection
