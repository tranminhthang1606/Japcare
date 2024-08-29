@extends('admins.layouts.master')
@section('title', 'Danh mục sản phẩm')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        <span>Danh mục sản phẩm</span>
                        <a href="{{ route('categories.create') }}" class="btn btn-rounded btn-info pull-right">Thêm danh mục mới</a>
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
                        <form action="{{ route('categories.index') }}" method="get">
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
                                            <input class="form-control" type="search" name="keyword" placeholder="Tìm tên danh mục"
                                                   value="{{request('keyword') ?: ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control" name="featured">
                                            <option value="">Danh mục nổi bật ?</option>
                                            <option value="1" @if(request('featured') == 1) selected @endif>Nổi bật</option>
                                            <option value="2" @if(request('featured') == 2) selected @endif>Không nổi bật</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control" name="is_menu">
                                            <option value="">Hiển thị trên menu ?</option>
                                            <option value="1" @if(request('is_menu') == 1) selected @endif>Hiển thị</option>
                                            <option value="2" @if(request('is_menu') == 2) selected @endif>Không hiển thị</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control" name="status">
                                            <option value="">Trạng thái</option>
                                            <option value="1" @if(request('status') == 1) selected @endif>Kích hoạt</option>
                                            <option value="2" @if(request('status') == 2) selected @endif>Khoá</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group pull-right">
                                        <a href="{{ route('categories.index') }}" class="btn btn-blue-grey mr-2">
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
                                        <th style="width: 40px">ID</th>
                                        <th>Tiêu đề</th>
                                        <th style="width: 200px">Hình ảnh</th>
                                        <th>Danh mục cha</th>
                                        <th style="width: 120px">Nổi bật</th>
                                        <th style="width: 120px">Hiển thị Menu</th>
                                        <th style="width: 120px">Trạng thái</th>
                                        <th style="width: 150px">Người tạo</th>
                                        <th style="width: 100px">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($categories) == 0)
                                    <tr>
                                        <td colspan="9" class="dataTables_empty">No data</td>
                                    </tr>
                                @endif
                                @foreach($categories as $key => $cate)
                                    <tr>
                                        <td>{{$cate->id}}</td>
                                        <td>
                                            <p class="mb-1">{{$cate->title}}</p>
                                            <p class="mb-0">{{$cate->slug}}</p>
                                        </td>
                                        <td><img src="{{asset($cate->image)}}" height="80px" alt=""></td>
                                        <td>
                                            @if($cate->parent_id && $cate->parent)
                                                {{$cate->parent->title}}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($cate->featured === 1)
                                                <span class="badge badge-primary">Có</span>
                                            @else
                                                <span class="badge badge-warning">Không</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($cate->is_menu === 1)
                                                <span class="badge badge-primary">Có</span>
                                            @else
                                                <span class="badge badge-warning">Không</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($cate->status === 1)
                                                <span class="badge badge-success">Kích hoạt</span>
                                            @else
                                                <span class="badge badge-danger">Khóa</span>
                                            @endif
                                        </td>
                                        <td>{{$cate->creator->name ?? ''}}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $cate->id) }}">
                                                <span class="badge badge-brown"><i class="fa fa-pencil"></i></span>
                                            </a>
                                            <a onclick="confirm_modal('{{route('categories.delete', $cate->id)}}');">
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
                                Tổng {{$categories->total()}} danh mục
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="pull-right">
                                @if(count($categories) > 0)
                                    {{ $categories->appends(request()->query())->render('admins.inc.pagination') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end card -->
        </div> <!-- container -->
    </div><!-- Page content Wrapper -->
@endsection

