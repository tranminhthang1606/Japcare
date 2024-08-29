@extends('admins.layouts.master')
@section('title', 'Danh sách bài viết')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        <span>Danh sách bài viết</span>
                        <a href="{{url('admin/articles/create')}}"
                           class="btn btn-rounded btn-info pull-right">Thêm mới bài viết
                        </a>
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
                        <form action="{{ route('articles.index') }}" method="get">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="d-inline-flex w-100">
                                        <div style="width: 120px">
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
                                        <div style="margin-left: 20px; width: calc(100% - 140px);">
                                            <input class="form-control" type="search" name="keyword" placeholder="Tìm tên danh sách"
                                                   value="{{request('keyword') ?: ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control" name="article_category_id">
                                            <option value="all">Chọn danh mục</option>
                                            @foreach ($categories as $parent_category)
                                                <option value="{{ $parent_category->id }}" data-parent="{{ $parent_category->parent_id }}"
                                                    {{old('parent_id') == $parent_category->id ? 'selected' : ''}} >
                                                    {{ $parent_category->title }}
                                                </option>
                                                @if (count($parent_category->children) > 0)
                                                    @include('admins.inc.subcategories',['children' => $parent_category->children, 'parent' => '-'])
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-inline-flex w-100">
                                        <div style="width: calc(50% - 8px); margin-right: 8px">
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
                                        <div style="width: calc(50% - 7px); margin-left: 8px;">
                                            <div class="form-group">
                                                <select class="form-control" name="is_featured">
                                                    <option value="">Lọc tin nổi bật</option>
                                                    <option value="1" @if(request('is_featured') == 1) selected @endif>
                                                        Tin nổi bật
                                                    </option>
                                                    <option value="2" @if(request('is_featured') == 2) selected @endif>Tin thường</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="d-inline-flex w-100">
                                        <div style="width: calc(50% - 8px); margin-right: 8px">
                                            <div class="form-group">
                                                <select class="form-control" name="is_hot">
                                                    <option value="">Lọc chủ đề hot</option>
                                                    <option value="1" @if(request('is_hot') == 1) selected @endif>
                                                        Chủ đề hot
                                                    </option>
                                                    <option value="2" @if(request('is_hot') == 2) selected @endif>Tin thường</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div style="width: calc(50% - 7px); margin-left: 8px;">
                                            <div class="form-group pull-right">
                                                <a href="{{ route('articles.index') }}" class="btn btn-blue-grey mr-2">
                                                    Hủy lọc
                                                </a>
                                                <button type="submit" class="btn btn-primary"> Lọc</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-rep-plugin">
                        <div class="table table-bordered table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 40px">ID</th>
                                        <th>Tiêu đề</th>
                                        <th style="width: 180px">Ảnh</th>
                                        <th>Danh mục cha</th>
                                        <th style="width: 120px">Trạng thái</th>
                                        <th style="width: 120px">Tin nổi bật</th>
                                        <th style="width: 120px">Chủ đề hot</th>
                                        <th style="width: 150px">Thời gian<br/>người tạo</th>
                                        <th class="text-center" style="width: 100px">Tuỳ chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($articles) == 0)
                                    <tr>
                                        <td colspan="9" class="dataTables_empty">No data</td>
                                    </tr>
                                @else
                                    @foreach($articles as $key => $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                <p class="mb-1">{{$item->title}}</p>
                                                <p class="mb-0">{{$item->slug}}</p>
                                            </td>
                                            <td>
                                                <img src="{{asset($item->thumbnail)}}" alt="{{$item->title}}" height="150px"/>
                                            </td>
                                            <td>{{$item->articleCategory->title}}</td>
                                            <td class="text-center">
                                                @if($item->status === 1)
                                                    <span class="badge badge-success">Hoạt động</span>
                                                @else
                                                    <span class="badge badge-danger">Khóa</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->is_featured === 1)
                                                    <span class="badge badge-info">Nổi bật</span>
                                                @else
                                                    <span class="badge badge-warning">Tin thường</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->is_hot === 1)
                                                    <span class="badge badge-info">Chủ đề hot</span>
                                                @else
                                                    <span class="badge badge-warning">Tin thường</span>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="mb-0">{{$item->created_at}}</p>
                                                <p class="mb-0">
                                                    <i class="fa fa-user-circle"></i> {{$item->user->name}}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.article.edit',$item->id ) }}">
                                                    <span class="badge badge-brown"><i class="fa fa-pencil"></i></span>
                                                </a>
                                                <a onclick="confirm_modal('{{route('articles.destroy', $item->id)}}');">
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
                                Tổng {{$articles->total()}} danh sách
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="pull-right">
                                @if(count($articles) > 0)
                                    {{ $articles->appends(request()->query())->render('admins.inc.pagination') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
