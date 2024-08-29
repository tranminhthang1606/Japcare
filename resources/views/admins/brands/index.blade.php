@extends('admins.layouts.master')
@section('title', 'Thương hiệu sản phẩm')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        <span>Thương hiệu sản phẩm</span>
                        <a href="{{ route('brands.create') }}" class="btn btn-rounded btn-info pull-right">Thêm thương hiệu mới</a>
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
                    <div class="find_wap mb-3">
                        <form action="{{ route('brands.index') }}" method="get">
                            <div class="row">
                                <div class="col-md-3">
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
                                            <input class="form-control" type="search" name="keyword" placeholder="Tìm tên thương hiệu"
                                                   value="{{request('keyword') ?: ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control" name="top">
                                            <option value="">Lọc thương hiệu nổi bật</option>
                                            <option value="1" @if(request('top') == 1) selected @endif>
                                                Thương hiệu nổi bật
                                            </option>
                                            <option value="2" @if(request('top') == 2) selected @endif>
                                                Thương hiệu thường
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control" name="status">
                                            <option value="">Trạng thái</option>
                                            <option value="1" @if(request('status') == 1) selected @endif>
                                                Hoạt động
                                            </option>
                                            <option value="2" @if(request('status') == 2) selected @endif>Khoá</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group pull-right">
                                        <a href="{{ route('brands.index') }}" class="btn btn-blue-grey mr-2">
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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px">ID</th>
                                        <th>Tiêu đề</th>
                                        <th style="width: 250px">Logo</th>
                                        <th style="width: 150px">Thương hiệu nổi bật</th>
                                        <th style="width: 120px">Trạng thái</th>
                                        <th style="width: 120px">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($brands) == 0)
                                    <tr>
                                        <td colspan="6" class="dataTables_empty">No data</td>
                                    </tr>
                                @else
                                    @foreach($brands as $key => $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <p class="mb-1">{{$item->title}}</p>
                                                <p class="mb-0">{{$item->slug}}</p>
                                            </td>
                                            <td>
                                                <img src="{{ asset($item->logo) }}" height="80px" alt="">
                                            </td>
                                            <td>
                                                @if($item->top === 1)
                                                    <span class="badge badge-primary">Nổi bật</span>
                                                @else
                                                    <span class="badge badge-warning">Thường</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status === 1)
                                                    <span class="badge badge-success">Kích hoạt</span>
                                                @else
                                                    <span class="badge badge-danger">Khóa</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('brands.edit', $item->id) }}">
                                                    <span class="badge badge-brown"><i class="fa fa-pencil"></i></span>
                                                </a>
                                                <a onclick="confirm_modal('{{route('brands.destroy', $item->id)}}');">
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
                                Tổng {{$brands->total()}} thương hiệu
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="pull-right">
                                @if(count($brands) > 0)
                                    {{ $brands->appends(request()->query())->render('admins.inc.pagination') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection

