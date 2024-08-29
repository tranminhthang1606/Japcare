@extends('admins.layouts.master')
@section('title', 'Danh sách popup')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Dánh sách popup
                        <a href="{{ url('/admin/popups/create') }}" class="btn btn-info waves-effect pull-right">Thêm popup</a>
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
                        <form action="{{ route('popups.index') }}" method="get">
                            <div class="row">
                                <div class="col-md-3 mb-3">
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
                                            <input class="form-control" type="search" name="keyword" placeholder="Tìm theo tiêu đề"
                                                   value="{{request('keyword') ?: ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
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
                                <div class="col-md-6 mb-3">
                                    <div class="form-group pull-right">
                                        <a href="{{ route('popups.index') }}" class="btn btn-blue-grey mr-2">
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
                                        <th style="width: 200px">Ảnh popup</th>
                                        <th>Link</th>
                                        <th class="text-center" style="width: 120px">Trạng thái</th>
                                        <th class="text-center" style="width: 120px">Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($popups) == 0)
                                    <tr>
                                        <td colspan="6" class="dataTables_empty">No data</td>
                                    </tr>
                                @else
                                    @foreach($popups as $key => $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td><img style="width: 150px" class="img-thumbnail" src={{ asset($item->image) }} alt=""></td>
                                            <td>{{ $item->link }}</td>
                                            <td>
                                                @if($item->status === 1)
                                                    <span class="badge badge-primary">Hoạt động</span>
                                                @else
                                                    <span class="badge badge-warning">Khoá</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('/admin/popups/' . $item->id ) . '/edit'}}">
                                                    <span class="badge badge-brown"><i class="fa fa-pencil"></i></span>
                                                </a>
                                                <a onclick="confirm_modal('{{route('popups.destroy', $item->id)}}');">
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
                                Tổng {{$popups->total()}} popup
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="pull-right">
                                @if(count($popups) > 0)
                                    {{ $popups->appends(request()->query())->render('admins.inc.pagination') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection

