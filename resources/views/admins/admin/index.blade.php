@extends('admins.layouts.master')
@section('title', 'Quản lý tài khoản quản trị')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Danh sách tài khoản quản trị
                        <a href="{{ url('/admin/admin/create') }}" class="btn btn-info waves-effect pull-right">Thêm nhân viên</a>
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
                        <form action="{{ route('admin.index') }}" method="get">
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
                                                   placeholder="Tìm tên, email, số điện thoại"
                                                   value="{{request('keyword') ?: ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control demo-select2-placeholder" name="isActive">
                                            <option value="">Trạng thái</option>
                                            <option value="1" @if(request('isActive') == 1) selected @endif>Hoạt động</option>
                                            <option value="2" @if(request('isActive') == 2) selected @endif>Khoá</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <div class="form-group pull-right">
                                        <a href="{{ route('admin.index') }}"
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
                            <table id="admintable" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px">ID</th>
                                    <th>Họ tên</th>
                                    <th>Ảnh đại diện</th>
                                    <th style="width: 150px">Email</th>
                                    <th style="width: 120px">Điện thoại</th>
                                    <th style="width: 150px">Phân quyền</th>
                                    <th class="text-center" style="width: 120px">Trạng thái</th>
                                    <th class="text-center" style="width: 120px">Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($admins) == 0)
                                    <tr>
                                        <td colspan="8" class="dataTables_empty">No data</td>
                                    </tr>
                                @endif
                                @foreach($admins as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if($item->avatar)
                                                <img style="width: 150px" class="img-thumbnail" src={{ asset($item->avatar) }} alt="">
                                            @endif
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->role ? $item->role->name : '' }}</td>
                                        <td class="text-center">
                                            @if($item->isActive == 1)
                                                <span class="badge badge-primary">Active</span>
                                            @else
                                                <span class="badge badge-warning">Block</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('/admin/admin/' . $item->id ) . '/edit'}}">
                                                <span class="badge badge-brown"><i class="fa fa-pencil"></i></span>
                                            </a>
                                            @if($item->id != 1)
                                                @if(Auth::user()->id != $item->id)
                                                    <form method="POST" action="/admin/admin/{{$item->id}}" style="display: inline">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="boder_none">
                                                            <span class="badge badge-danger delete_item"><i class="dripicons-cross"></i></span>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
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
                                Tổng {{$admins->total()}} tài khoản
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="pull-right">
                                @if(count($admins) > 0)
                                    {{ $admins->appends(request()->query())->render('admins.inc.pagination') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->

@endsection

