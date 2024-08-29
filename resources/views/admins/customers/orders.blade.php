@extends('admins.layouts.master')
@section('title', 'Danh sách đơn hàng')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Tên khách hàng: </label>
                                <span>{{$customer->full_name}}</span>
                            </div>
                            <div class="col-sm-4">
                                <label>Số điện thoại: </label>
                                <span>{{$customer->phone ?? ''}}</span>
                            </div>
                            <div class="col-sm-4">
                                <label>Email: </label>
                                <span>{{$customer->email ?? ''}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Địa chỉ: </label>
                                @foreach($customer->customersAddress as $addr)
                                    @if($addr->is_default == 1)
                                        <span>{{$addr->address}}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <table id="orders_table" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="100px">Mã đơn hàng</th>
                                    <th width="150px">Tổng tiền</th>
                                    <th width="150px">Loại thanh toán</th>
                                    <th width="100px">Giao hàng</th>
                                    <th width="150px">Trạng thái thanh toán</th>
                                    <th width="100px">Trạng thái đơn</th>
                                    <th style="width: 120px">Ngày tạo</th>
                                    <th width="100px">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data) == 0)
                                <tr>
                                    <td colspan="8" class="dataTables_empty">No data</td>
                                </tr>
                            @endif
                            @foreach($data as $key => $order)
                                <tr>
                                    <td>{{$order->code}}</td>
                                    <td>{{number_format($order->grand_total)}} VNĐ</td>
                                    <td>
                                        @if($order->payment_method == 'cod')
                                            <span>COD</span>
                                        @else
                                            <span>Chuyển khoản</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->delivery_status == 1)
                                            <span>Đã giao hàng</span>
                                        @else
                                            <span>Đơn mới</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->payment_status == 1)
                                            <span>Đã thanh toán</span>
                                        @else
                                            <span>Chưa thanh toán</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->status == 2)
                                            <span>Hoàn thành</span>
                                        @else
                                            <span>Đơn mới</span>
                                        @endif
                                    </td>
                                    <td>{{$order->created_at}}</td>
                                    <td>
                                        <a href="{{"/admin/orders/show/$order->id"}}" >
                                            <span class="badge badge-brown">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div><!-- end row -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#orders_table').DataTable({
                "order": [[ 20, "desc" ]]
            });
        });
    </script>
@endsection
