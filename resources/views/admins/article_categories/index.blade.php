@extends('admins.layouts.master')
@section('title', 'Danh mục tin tức')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="header-title mb-2 mt-0 border_b">
                        <span>Danh mục tin tức</span>
                        <a href="{{url('admin/articles-categories/create')}}" class="btn btn-rounded btn-info pull-right">Thêm mới danh mục</a>
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
                        <form action="{{ route('articles-categories.index') }}" method="get">
                            <div class="row">
                                <div class="col-lg-3">
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
                                            <input class="form-control" type="search" name="keyword" placeholder="Tìm tên danh mục" value="{{request('keyword') ?: ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-control" name="status">
                                        <option value="">Lọc trạng thái</option>
                                        <option value="1" @if(request('status') == 1) selected @endif>Hoạt động</option>
                                        <option value="2" @if(request('status') == 2) selected @endif>Đã khóa</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-control" name="is_show">
                                        <option value="">Lọc hiển thị ở trang danh sách</option>
                                        <option value="1" @if(request('is_show') == 1) selected @endif>Có hển thị</option>
                                        <option value="2" @if(request('is_show') == 2) selected @endif>Không hiển thị</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group pull-right">
                                        <a href="{{ route('articles-categories.index') }}"
                                           class="btn btn-blue-grey mr-2">
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
                            <table class="table table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 40px">ID</th>
                                        <th>Tên danh mục</th>
                                        <th style="width: 200px">Hình ảnh</th>
                                        <th>Danh mục cha</th>
                                        <th style="width: 120px">Trạng thái</th>
                                        <th style="width: 120px">
                                            Hiển thị trang<br/>danh sách
                                        </th>
                                        <th style="width: 150px" class="text-center">
                                            Ngày tạo<br/>Người tạo
                                        </th>
                                        <th class="text-center" style="width: 100px">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($articles_categories) == 0)
                                    <tr>
                                        <td colspan="8" class="dataTables_empty">No data</td>
                                    </tr>
                                @else
                                    @foreach($articles_categories as $key => $cate)
                                        <tr>
                                            <td>{{$cate->id}}</td>
                                            <td>
                                                <p class="mb-1">{{$cate->title}}</p>
                                                <p class="mb-0">{{$cate->slug}}</p>
                                            </td>
                                            <td>
                                                @if($cate->photos)
                                                    <img height="150px" alt="{{$cate->title}}" src="{{asset($cate->photos)}}">
                                                @endif
                                            </td>
                                            <td>
                                                @if($cate->parent)
                                                    {{$cate->parent->title}}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($cate->status === 1)
                                                    <span class="badge badge-success">Kích hoạt</span>
                                                @else
                                                    <span class="badge badge-danger">Khóa</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($cate->is_show === 1)
                                                    <span class="badge badge-info">Hiển thị</span>
                                                @else
                                                    <span class="badge badge-warning">Không</span>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="mb-1">{{$cate->created_at}}</p>
                                                <p class="mb-0">{{$cate->creator->name ?? ''}}</p>
                                            </td>
                                            <td class="text-center">
                                                <a href="/admin/articles-categories/{{$cate->id}}/edit">
                                                    <span class="badge badge-brown"><i class="fa fa-pencil"></i></span>
                                                </a>
                                                <a onclick="confirm_modal('{{route('articles-categories.destroy', $cate->id)}}');">
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
                                Tổng {{$articles_categories->total()}} danh mục
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="pull-right">
                                @if(count($articles_categories) > 0)
                                    {{ $articles_categories->appends(request()->query())->render('admins.inc.pagination') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div><!-- end card body-->
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection

