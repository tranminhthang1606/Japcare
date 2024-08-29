@extends('admins.layouts.master')
@section('title', 'Sửa nhân viên')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thông tin nhân viên
                        <a href="{{ url('/admin/admin') }}" class="btn btn-secondary waves-effect pull-right">Danh sách nhân viên</a>
                    </h4>
                    <form action="{{route('admin.update', ['admin' => $data->id] ) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4 position_rel">
                                <div class="form-group">
                                    <div>
                                        <label>Ảnh đại diện(520px*520px)</label>
                                    </div>
                                    <div id="wap_img">
                                        @if ($data->avatar != null)
                                            <div class="col-md-6">
                                                <div class="img-upload-preview">
                                                    <img height="150px" src="{{ asset($data->avatar) }}" alt="" class="img-responsive"/>
                                                    <button type="button" class="btn btn-danger close-btn remove-file">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="previous_photo" value="{{ $data->avatar }}">
                                        @else
                                            <div id="image"></div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Chọn quyền</label>
                                    <select name="role_id" class="form-control" required>
                                        <option value="">Chọn phân quyền</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" @if($data->role_id == $role->id) selected @endif >{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label>Trạng thái</label>
                                    </div>
                                    <input type="checkbox" id="switch1" name="status" {{$data->isActive == 1 ? 'checked' : '' }} switch="none" />
                                    <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label>Họ tên</label>
                                    <input name="name" type="text" class="form-control" required placeholder="Full name"
                                           value="{{$data->name}}"
                                    />
                                </div>
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <div>
                                        <input name="email" type="email" class="form-control" required
                                               parsley-type="email" placeholder="E-mail" value="{{$data->email}}"
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <div>
                                        <input name="password" type="password" id="pass2" class="form-control"
                                               placeholder="Password"/>
                                    </div>
                                    <div class="m-t-10">
                                        <input name="password_confirmation" type="password" class="form-control"
                                               data-parsley-equalto="#pass2"
                                               placeholder="Nhập lại mật khẩu"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <div>
                                        <input name="phone" type="text" class="form-control" placeholder="Số điện thoại"
                                               value="{{$data->phone}}"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-5">
                                        lưu lại
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect">
                                        Hủy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <!-- validation js -->
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
            $("#image").spartanMultiImagePicker({
                fieldName: 'file',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'col-md-6',
                maxFileSize: '1024000',
                allowedExt:  '',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    alert('File size too big');
                }
            });
            $('.remove-file').on('click', function () {
                $(this).parents(".col-md-6").remove();
                $('#wap_img').append('<div id="image"></div>');
                $("#image").spartanMultiImagePicker({
                    fieldName: 'file',
                    maxCount: 1,
                    rowHeight: '150px',
                    groupClassName: 'col-md-6',
                    maxFileSize: '1024000',
                    allowedExt:  '',
                    dropFileLabel: "Drop Here",
                    onExtensionErr: function (index, file) {
                        alert('Please only input png or jpg type file')
                    },
                    onSizeErr: function (index, file) {
                        alert('File size too big');
                    }
                });
            });
        });
    </script>
@endsection
