@extends('admins.layouts.master')
@section('title', 'Admin add')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thêm nhân viên
                        <a href="{{ url('/admin/admin') }}" class="btn btn-secondary waves-effect pull-right">Danh sách nhân viên</a>
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
                    <form action="{{route('admin.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4 position_rel">
{{--                                <div class="form-group">--}}
{{--                                    <label>Ảnh đại diện</label> <br>--}}
{{--                                    <span>Chọn hình ảnh </span>--}}
{{--                                    <input name="file" type="file" class="form-control" accept="image/*"/>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <div class="m-b-15">
                                        <label>Ảnh đại diện(520px*520px)</label>
                                    </div>
                                    <div class="row" id="image"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Chọn quyền</label>
                                    <select name="role_id" class="form-control" required>
                                        <option value="">Chọn phân quyền</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <div>
                                        <input type="checkbox" id="switch1" name="status" checked switch="none" />
                                        <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Full name <strong class="text-danger">*</strong></label>
                                    <input name="name" type="text" class="form-control" required placeholder="Full name"/>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-Mail <strong class="text-danger">*</strong></label>
                                    <div>
                                        <input name="email" type="email" class="form-control" required parsley-type="email" placeholder="E-mail" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <strong class="text-danger">*</strong></label>
                                    <div>
                                        <input name="password" type="password" id="pass2" class="form-control" required
                                               placeholder="Password" />
                                    </div>
                                    <div class="m-t-10">
                                        <input name="password_confirmation" type="password" class="form-control" required
                                               data-parsley-equalto="#pass2"
                                               placeholder="Confirm Password" autocomplete="new-password"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <div>
                                        <input name="phone" type="text" class="form-control" placeholder="Phone number"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-5">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- end card-body -->
            </div> <!-- end card -->
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
        });
    </script>
@endsection
