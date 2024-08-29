@extends('admins.layouts.master')
@section('title', 'Thêm phân quyền')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thêm quyền mới
                        <a href="{{ url('/admin/roles') }}" class="btn btn-secondary waves-effect pull-right">Danh sách quyền</a>
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

                    <form action="{{route('roles.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-4 position_rel">
                                <div class="form-group">
                                    <label>Tên quyền <strong class="text-danger">*</strong></label>
                                    <input type="text" placeholder="Tên quyền" id="name" name="name" class="form-control" required />
                                </div>
                                <div class="form-group position_b">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-5">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="panel-heading">
                                    <h5 class="panel-title border_b">Danh sách chức năng</h5>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span>Danh mục sản phẩm</span> &nbsp;
                                            <input type="checkbox" id="switch1" name="permissions[]" switch="none" value="1" />
                                            <label class="mb_5" for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Danh sách sản phẩm</span> &nbsp;
                                            <input type="checkbox" id="switch2" name="permissions[]" switch="none" value="2" />
                                            <label class="mb_5" for="switch2" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Thương hiệu</span> &nbsp;
                                            <input type="checkbox" id="switch3" name="permissions[]" switch="none" value="3" />
                                            <label class="mb_5" for="switch3" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Màu sắc sản phẩm</span> &nbsp;
                                            <input type="checkbox" id="switch17" name="permissions[]" switch="none" value="17" />
                                            <label class="mb_5" for="switch17" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Danh mục Tin tức</span> &nbsp;
                                            <input type="checkbox" id="switch5" name="permissions[]" switch="none" value="5" />
                                            <label class="mb_5" for="switch5" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Danh sách Tin tức</span> &nbsp;
                                            <input type="checkbox" id="switch6" name="permissions[]" switch="none" value="6" />
                                            <label class="mb_5" for="switch6" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Liên hệ - Góp ý</span> &nbsp;
                                            <input type="checkbox" id="switch7" name="permissions[]" switch="none" value="7" />
                                            <label class="mb_5" for="switch7" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Quản trị hệ thống</span> &nbsp;
                                            <input type="checkbox" id="switch14" name="permissions[]" switch="none" value="14" />
                                            <label class="mb_5" for="switch14" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Cài đặt hệ thống</span> &nbsp;
                                            <input type="checkbox" id="switch15" name="permissions[]" switch="none" value="15" />
                                            <label class="mb_5" for="switch15" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Quản lý Công dụng</span> &nbsp;
                                            <input type="checkbox" id="switch19" name="permissions[]" switch="none" value="19" />
                                            <label class="mb_5" for="switch19" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span>Khách hàng</span> &nbsp;
                                            <input type="checkbox" id="switch8" name="permissions[]" switch="none" value="8" />
                                            <label class="mb_5" for="switch8" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Đơn hàng</span> &nbsp;
                                            <input type="checkbox" id="switch9" name="permissions[]" switch="none" value="9" />
                                            <label class="mb_5" for="switch9" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Đánh giá sản phẩm</span> &nbsp;
                                            <input type="checkbox" id="switch10" name="permissions[]" switch="none" value="10" />
                                            <label class="mb_5" for="switch10" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Sliders trang chủ</span> &nbsp;
                                            <input type="checkbox" id="switch11" name="permissions[]" switch="none" value="11" />
                                            <label class="mb_5" for="switch11" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Banner trang chủ</span> &nbsp;
                                            <input type="checkbox" id="switch12" name="permissions[]" switch="none" value="12" />
                                            <label class="mb_5" for="switch12" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Quản lý phí vận chuyển</span> &nbsp;
                                            <input type="checkbox" id="switch16" name="permissions[]" switch="none" value="16" />
                                            <label class="mb_5" for="switch16" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Chính sách của Trang</span> &nbsp;
                                            <input type="checkbox" id="switch13" name="permissions[]" switch="none" value="13" />
                                            <label class="mb_5" for="switch13" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Quản lý phí vận chuyển</span> &nbsp;
                                            <input type="checkbox" id="switch16" name="permissions[]" switch="none" value="16" />
                                            <label class="mb_5" for="switch16" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group">
                                            <span>Quản lý thành phần</span> &nbsp;
                                            <input type="checkbox" id="switch18" name="permissions[]" switch="none" value="18" />
                                            <label class="mb_5" for="switch18" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div><!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
