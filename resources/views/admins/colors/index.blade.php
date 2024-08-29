@extends('admins.layouts.master')
@section('title', 'Danh sách màu sắc')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class=" header-title mb-2 border_b" style="display: table; width: 100%;">
                        <span>Danh sách màu sắc</span>
                        <a href="{{ url('admin/colors/create') }}" class="btn btn-rounded btn-info pull-right">
                            Thêm màu sắc
                        </a>
                    </h4>
                    <div class="find_wap">
                        <form action="{{url('admin/colors')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-bottom: 15px">
                                        <select class="form-control" name="num_show">
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
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-bottom: 15px">
                                        <input class="form-control" type="search" name="keyword" placeholder="Tìm tên màu"
                                               value="@if(request('keyword')) {{request('keyword')}} @endif" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control demo-select2-placeholder" name="status">
                                        <option value="">Lọc trạng thái</option>
                                        <option value="1" @if(request('status') == 1) selected @endif>Hoạt động</option>
                                        <option value="0" @if(request('status') === 0 || request('status') === '0') selected @endif>Đã khóa</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group pull-right">
                                        <a href="{{ url('admin/colors') }}" class="btn btn-blue-grey mr-2">
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
                                    <th style="width: 130px">Mã màu</th>
                                    <th>Tên màu</th>
                                    <th style="width: 100px" class="text-center">Trạng thái</th>
                                    <th style="width: 120px">Ngày tạo</th>
                                    <th style="width: 120px">Người tạo</th>
                                    <th style="width: 100px" class="text-center">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($colors as $key => $color)
                                    <tr>
                                        <td class="text-center">{{$color->id}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="mr-2">{{$color->color_code}}</div>
                                                <div style="background-color: {{$color->color_code}}; height: 50px; width: 50px"></div>
                                            </div>
                                        </td>
                                        <td style="max-width:400px;overflow: hidden;text-overflow: ellipsis;">{{$color->title}}</td>
                                        <td class="text-center">
                                            @if($color->status == 1)
                                                <span class="badge badge-success">Hoạt động</span>
                                            @else
                                                <span class="badge badge-secondary">Đã khóa</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$color->created_at ? date('d/m/Y', strtotime($color->created_at)) : ''}}
                                        </td>
                                        <td>
                                            {{$color->createdBy ? $color->createdBy->name : ''}}
                                        </td>
                                        <td class="table-action text-center">
                                            <a href="{{route('colors.edit', $color->id)}}" title="Sửa">
                                                <span class="badge badge-brown"><i class="fa fa-pencil"></i></span>
                                            </a>
                                            <a onclick="return confirm('Bạn chắc chắn xóa chứ?')"
                                               href="{{route('colors.delete', $color->id)}}" title="Xóa">
                                                <span class="badge badge-danger"><i class="dripicons-cross"></i></span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="row mt-3">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info">
                                        Tổng {{$colors->total()}} mã màu
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="pull-right">
                                        @if(count($colors) > 0)
                                            {{ $colors->appends(request()->query())->render('admins.inc.pagination') }}
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
