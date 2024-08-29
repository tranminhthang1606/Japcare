@extends('admins.layouts.master')
@section('title', 'Danh sách phí vận chuyển')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class=" header-title mb-2 border_b" style="display: table; width: 100%;">
                        <span>Danh sách phí vận chuyển</span>
                        <a href="{{ url('admin/delivery_fees/create') }}" class="btn btn-rounded btn-info pull-right">
                            Thêm phí vận chuyển
                        </a>
                    </h4>

                    <div class="find_wap">
                        <form action="{{url('admin/delivery_fees')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-bottom: 15px">
                                        <select class="form-control" name="num_show">
                                            <option value="20"
                                                    @if(isset($limit) && $limit == 20) selected @endif>
                                                Hiển thị 20
                                            </option>
                                            <option value="50"
                                                    @if(isset($limit) && $limit == 50) selected @endif>
                                                Hiển thị 50
                                            </option>
                                            <option value="100"
                                                    @if(isset($limit) && $limit == 100) selected @endif>
                                                Hiển thị 100
                                            </option>
                                            <option value="200"
                                                    @if(isset($limit) && $limit == 200) selected @endif>
                                                Hiển thị 200
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-bottom: 15px">
                                        <select class="form-control select2" name="matp">
                                            <option value="">Tỉnh/Thành phố</option>
                                            @foreach($provinces as $province)
                                                <option value="{{$province->matp}}" @if(request('matp') == $province->matp) selected @endif>{{$province->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-bottom: 15px">
                                        <select class="form-control" name="status">
                                            <option value="">Trạng thái</option>
                                            <option value="NOW" @if(request('status') == 'NOW') selected @endif>Đang áp dụng</option>
                                            <option value="OLD" @if(request('status') == 'OLD') selected @endif>Trạng thái cũ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pull-right">
                                        <a href="{{ url('admin/delivery_fees') }}" class="btn btn-blue-grey mr-2">
                                            Hủy lọc
                                        </a>
                                        <button type="submit" class="btn btn-primary">Lọc</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

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

                    <div class="table-rep-plugin">
                        <div class="table table-bordered table-responsive" data-pattern="priority-columns">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px" class="text-center">ID</th>
                                        <th style="width: 130px">Tỉnh/Thành phố</th>
                                        <th>Phí vận chuyển</th>
                                        <th style="width: 100px" class="text-center">Trạng thái</th>
                                        <th style="width: 120px">Ngày tạo</th>
                                        <th style="width: 120px">Người tạo</th>
                                        <th style="width: 130px">Thời gian thay đổi</th>
                                        <th style="width: 130px">Người thay đổi</th>
                                        <th style="width: 100px" class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($fees as $key => $fee)
                                    <tr>
                                        <td class="text-center">{{$fee->id}}</td>
                                        <td>{{$fee->province ? $fee->province->name : ''}}</td>
                                        <td style="max-width:400px;overflow: hidden;text-overflow: ellipsis;">{{number_format($fee->fee)}}</td>
                                        <td class="text-center">
                                            @if($fee->status == 'NOW')
                                                <span class="badge badge-success">Đang áp dụng</span>
                                            @else
                                                <span class="badge badge-secondary">Trạng thái cũ</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$fee->created_at ? date('d/m/Y', strtotime($fee->created_at)) : ''}}
                                        </td>
                                        <td>
                                            {{$fee->createdBy ? $fee->createdBy->name : ''}}
                                        </td>
                                        <td>
                                            {{$fee->time_change ? date('d/m/Y H:m:i', strtotime($fee->time_change)) : ''}}
                                        </td>
                                        <td>
                                            {{$fee->changedBy ? $fee->changedBy->name : ''}}
                                        </td>
                                        <td class="table-action text-center">
                                            <a href="{{route('delivery_fees.edit', $fee->id)}}" title="Sửa">
                                                <span class="badge badge-brown"><i class="fa fa-pencil"></i></span>
                                            </a>
                                            <a onclick="return confirm('Bạn chắc chắn xóa chứ?')" href="{{route('delivery_fees.delete', $fee->id)}}" title="Xóa">
                                                <span class="badge badge-danger"><i class="dripicons-cross"></i></span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="row mt-3">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info">
                                        Tổng {{$fees->total()}} phí vận chuyển
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="pull-right">
                                        @if(count($fees) > 0)
                                            {{ $fees->appends(request()->query())->render('admins.inc.pagination') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
