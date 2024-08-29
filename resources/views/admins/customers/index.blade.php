@extends('admins.layouts.master')
@section('title', 'Danh sách khách hàng')

<!-- Basic Data Tables -->
@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Danh sách khách hàng
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
                        <form action="{{ route('customers.index') }}" method="get">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="d-inline-flex w-100">
                                        <div style="width: 80px">
                                            <select class="form-control" name="num_show">
                                                <option value="20" @if(isset($limit) && $limit == 20) selected @endif>
                                                    20
                                                </option>
                                                <option value="50" @if(isset($limit) && $limit == 50) selected @endif>
                                                    50
                                                </option>
                                                <option value="100" @if(isset($limit) && $limit == 100) selected @endif>
                                                    100
                                                </option>
                                                <option value="200" @if(isset($limit) && $limit == 200) selected @endif>
                                                    200
                                                </option>
                                            </select>
                                        </div>
                                        <div style="margin-left: 20px; width: calc(100% - 100px);">
                                            <input class="form-control" type="search" name="keyword"
                                                   placeholder="Tìm tên, số điện thoại, email"
                                                   value="{{request('keyword') ?: ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="form-group pull-right">
                                        <a href="{{ route('customers.index') }}" class="btn btn-blue-grey mr-2">
                                            Hủy lọc
                                        </a>
                                        <button type="submit" class="btn btn-primary"> Lọc</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-rep-plugin">
                        <div class="table table-bordered table-responsive" data-pattern="priority-columns">
                            <table class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="50px">ID</th>
                                        <th width="180px">Họ tên khách hàng</th>
                                        <th width="130px">Điện thoại</th>
                                        <th width="150px">Email</th>
                                        <th>Địa chỉ</th>
                                        <th width="100px">SP đã xem</th>
                                        <th width="100px">SP đã mua</th>
                                        <th width="100px">Đơn hàng</th>
                                        <th width="120px">Tuỳ chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($customers) == 0)
                                    <tr>
                                        <td colspan="9" class="dataTables_empty">No data</td>
                                    </tr>
                                @endif
                                @foreach($customers as $key => $customer)
                                    <tr>
                                        <td>{{$customer->id}}</td>
                                        <td>
                                            <p>{{$customer->full_name}}</p>
                                            <p>{{$customer->user_name}}</p>
                                        </td>
                                        <td>{{$customer->phone}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>
                                            @if(isset($customer->customersAddress))
                                                @foreach($customer->customersAddress as $address )
                                                    {{$address->address}}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.customers.viewed_products', $customer->id)}}">
                                                {{count($customer->viewed)}}
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.customers.bought_products', $customer->id)}}">
                                                {{count($customer->bought)}}
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.customers.orders', $customer->id)}}">
                                                {{count($customer->orders)}}
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a onclick="confirm_modal('{{route('customers.destroy', $customer->id)}}');">
                                                <span class="badge badge-danger delete_item"><i class="dripicons-cross"></i></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info">
                                Tổng {{$customers->total()}} khách hàng
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="pull-right">
                                @if(count($customers) > 0)
                                    {{ $customers->appends(request()->query())->render('admins.inc.pagination') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection

