@extends('admins.layouts.master')
@section('title', 'Danh sách đơn hàng')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Danh sách đơn hàng
                    </h4>
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
                    <div class="find_wap">
                        <form action="{{url('admin/orders/')}}" method="get">
                            @csrf
                            <div class="row" style="margin-bottom: 15px">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="d-inline-flex w-100">
                                            <div style="width: 120px;">
                                                <select class="form-control" name="product_show" style="padding-left: 5px; padding-right: 5px">
                                                    <option value="20" @if(isset($limit) && $limit == 20) selected @endif>
                                                        Hiển thị 20
                                                    </option>
                                                    <option value="50" @if(isset($limit) && $limit == 50) selected @endif>
                                                        Hiển thị 50
                                                    </option>
                                                    <option value="100" @if(isset($limit) && $limit == 100) selected @endif>
                                                        Hiển thị 100
                                                    </option>
                                                    <option value="200" @if(isset($limit) && $limit == 200) selected @endif>
                                                        Hiển thị 200
                                                    </option>
                                                </select>
                                            </div>
                                            <div style="width: calc(100% - 135px); margin-left: 15px">
                                                <input class="form-control" type="search" name="keyword" placeholder="Tìm tên khách hàng"
                                                       value="@if(request('keyword')) {{request('keyword')}} @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="d-inline-flex w-100">
                                            <div style="width: calc(33.33% - 15px); margin-right: 15px">
                                                <select class="form-control" name="payment_method">
                                                    <option value="">Loại thanh toán</option>
                                                    <option value="cod" @if(request('payment_method') == 'cod') selected @endif>COD</option>
                                                    <option value="bacs" @if(request('payment_method') == 'bacs') selected @endif>
                                                        Chuyển khoản
                                                    </option>
                                                </select>
                                            </div>
                                            <div style="width: calc(33.33% - 15px); margin-right: 15px">
                                                <select class="form-control" name="payment_status">
                                                    <option value="">Trạng thái thanh toán</option>
                                                    <option value="1" @if(request('payment_status') == 1) selected @endif>
                                                        {{config('constants.payment_status.1')}}
                                                    </option>
                                                    <option value="2" @if(request('payment_status') == 2) selected @endif>
                                                        {{config('constants.payment_status.2')}}
                                                    </option>
                                                    <option value="3" @if(request('payment_status') == 3) selected @endif>
                                                        {{config('constants.payment_status.3')}}
                                                    </option>
                                                    <option value="4" @if(request('payment_status') == 4) selected @endif>
                                                        {{config('constants.payment_status.4')}}
                                                    </option>
                                                    <option value="5" @if(request('payment_status') == 5) selected @endif>
                                                        {{config('constants.payment_status.5')}}
                                                    </option>
                                                </select>
                                            </div>
                                            <div style="width: calc(33.33%)">
                                                <select class="form-control" name="delivery_status">
                                                    <option value="">Lọc trạng thái giao hàng</option>
                                                    <option value="1" @if(request('delivery_status') == 1) selected @endif>
                                                        {{config('constants.delivery_status.1')}}
                                                    </option>
                                                    <option value="2" @if(request('delivery_status') == 2) selected @endif>
                                                        {{config('constants.delivery_status.2')}}
                                                    </option>
                                                    <option value="3" @if(request('delivery_status') == 3) selected @endif>
                                                        {{config('constants.delivery_status.3')}}
                                                    </option>
                                                    <option value="5" @if(request('delivery_status') == 5) selected @endif>
                                                        {{config('constants.delivery_status.5')}}
                                                    </option>
                                                    <option value="4" @if(request('delivery_status') == 4) selected @endif>
                                                        {{config('constants.delivery_status.4')}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control" name="order_status">
                                            <option value="">Lọc trạng thái đơn</option>
                                            <option value="1" @if(request('order_status') == 1) selected @endif>
                                                {{config('constants.order_status.1')}}
                                            </option>
                                            <option value="2" @if(request('order_status') == 2) selected @endif>
                                                {{config('constants.order_status.2')}}
                                            </option>
                                            <option value="3" @if(request('order_status') == 3) selected @endif>
                                                {{config('constants.order_status.3')}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group pull-right" style="margin-bottom: 15px">
                                        <a href="{{url('admin/orders')}}" class="btn btn-blue-grey">
                                            Hủy lọc
                                        </a>
                                        <button type="submit" class="btn btn-info">Lọc</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-rep-plugin">
                        <div class="table table-bordered table-responsive" data-pattern="priority-columns">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 100px">Mã đơn hàng</th>
                                        <th style="width: 150px">Khách hàng</th>
                                        <th style="width: 150px">Tổng tiền</th>
                                        <th class="text-center" style="width: 150px">Loại thanh toán</th>
                                        <th class="text-center"style="width: 100px">Giao hàng</th>
                                        <th class="text-center" style="width: 150px">Trạng thái thanh toán</th>
                                        <th class="text-center" style="width: 100px">Trạng thái đơn</th>
                                        <th style="width: 120px">Ngày tạo</th>
                                        <th class="text-center" style="width: 100px" >Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($orders) == 0)
                                    <tr>
                                        <td colspan="9" class="dataTables_empty">No data</td>
                                    </tr>
                                @else
                                    @foreach($orders as $key => $order)
                                        <tr>
                                            <td>{{$order->code}}</td>
                                            <td>{{$order->customer_name ?? ''}}</td>
                                            <td>{{number_format($order->grand_total)}} VNĐ</td>
                                            <td class="text-center">
                                                @if($order->payment_method == 1)
                                                    <span class="badge badge-purple">COD</span>
                                                @else
                                                    <span class="badge badge-lime">Chuyển khoản</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @foreach(config('constants.delivery_status') as $key => $val)
                                                    @if($key == $order->delivery_status)
                                                        <span class="badge
                                                            @if($key == 1) badge-warning @elseif($key == 5) badge-success @elseif($key == 4) badge-danger @else badge-primary @endif
                                                        ">
                                                            {{$val}}
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                @foreach(config('constants.payment_status') as $k => $value)
                                                    @if($k == $order->payment_status)
                                                        <span class="badge
                                                            @if($k == 1) badge-warning @elseif($k == 3) badge-success @elseif($k == 4) badge-danger @else badge-primary @endif
                                                        ">
                                                            {{$value}}
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                @foreach(config('constants.order_status') as $ky => $item)
                                                    @if($ky == $order->status)
                                                        <span class="badge
                                                            @if($ky == 1) badge-warning @elseif($ky == 2) badge-success @else badge-danger @endif
                                                        ">
                                                            {{$item}}
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$order->created_at}}</td>
                                            <td class="text-center">
                                                <a href="{{ route('orders.show', $order->id) }}">
                                                    <span class="badge badge-brown"><i class="fa fa-eye"></i></span>
                                                </a> &nbsp;
                                                <a onclick="confirm_modal('{{route('order.delete_order', $order->id)}}');">
                                                    <span class="badge badge-danger delete_item"><i class="dripicons-cross"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info">
                                Tổng {{$orders->total()}} đơn hàng
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="pull-right">
                                @if(count($orders) > 0)
                                    {{ $orders->appends(request()->query())->render('admins.inc.pagination') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- Page content Wrapper -->
@endsection

