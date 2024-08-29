@extends('admins.layouts.master')
@section('title', 'Danh sách liên hệ - góp ý')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title m-b-15" style="display: table; width: 100%;">
                        <span>Danh sách liên hệ - góp ý</span>
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

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 50px">ID</th>
                                <th>Họ tên khách hàng</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Nội dung</th>
                                <th>Ngày gửi</th>
                                <th style="width: 120px">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($contacts as $key => $contact)
                                <tr>
                                    <td>{{$contact->id}}</td>
                                    <td>{{$contact->full_name}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->phone_number}}</td>
                                    <td>{{$contact->address}}</td>
                                    <td>{{$contact->content}}</td>
                                    <td>
                                        {{date_format($contact->created_at, 'd/m/y')}}
                                    </td>
                                    <td class="table-action">
                                        <a onclick="return confirm('Bạn chắc chắn chứ?')" title="Xóa"
                                           href="{{route('admin.contacts.delete', $contact->id)}}"
                                        ><i class="mdi mdi-delete" style="color: red"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div><!-- end row -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
