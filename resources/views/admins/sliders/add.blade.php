@extends('admins.layouts.master')
@section('title', 'Thêm Slider')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thêm slider
                        <a href="{{ url('/admin/sliders') }}" class="btn btn-secondary waves-effect pull-right">Danh sách Sliders</a>
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
                    <form action="{{ route('sliders.store' ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-5 position_rel">
                                <div class="form-group">
                                    <label><strong class="text-danger">*</strong> Tiêu đề</label>
                                    <input name="title" type="text" class="form-control" required placeholder="Tiêu đề" />
                                </div>
                                <div class="form-group">
                                    <label>Link liên kết</label>
                                    <input name="link_detail" type="text" class="form-control" placeholder="Link liên kết" />
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label>Trạng thái</label>
                                    </div>
                                    <input type="checkbox" id="switch1" name="published" switch="none" checked/>
                                    <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                </div>
                                <div class="form-group">
                                    <label>Kiểu slider</label>
                                    <select class="form-control" name="type" required>
                                        <option value="" selected>Chọn kiểu slider</option>
                                        <option value="1">Slider trang chủ</option>
                                        <option value="2">Slider trang tin tức</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="m-b-15">
                                        <label>Ảnh kích thước(843*386px)</label>
                                    </div>
                                    <div class="row" id="image"></div>
                                </div>
                                <div class="form-group">
                                    <div class="m-b-15">
                                        <label>Ảnh mobile</label>
                                    </div>
                                    <div class="row" id="image_mb"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-5">
                                        Thêm slider
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect">Hủy nhập</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <script type="text/javascript">
        $(document).ready(function (){
            $("#image").spartanMultiImagePicker({
                fieldName: 'slider_photo',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'col-md-12',
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
            $("#image_mb").spartanMultiImagePicker({
                fieldName: 'slider_photo_mb',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'col-md-3 col-sm-3 col-xs-4',
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
