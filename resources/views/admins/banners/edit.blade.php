@extends('admins.layouts.master')
@section('title', 'Chỉnh sửa banner')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Chỉnh sửa banner
                        <a href="{{ route('banners.index') }}" class="btn btn-secondary waves-effect pull-right">Danh sách banner</a>
                    </h4>

                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif
                    <form action="{{ route('banners.update',$banner->id ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6 position_rel">
                                <div class="form-group">
                                    <label><strong class="text-danger">*</strong> Tiêu đề</label>
                                    <input name="title" type="text" class="form-control" required value="{{old('title') ?: $banner->title}}" />
                                </div>
                                <div class="form-group">
                                    <label>Link liên kết</label>
                                    <input name="link_detail" type="text" class="form-control" value="{{old('link_detail') ?: $banner->link}}" />
                                </div>
                                <div class="form-group">
                                    <label>Kiểu banner</label>
                                    <select id="select-type-show" class="form-control" name="type_show" required>
                                        <option value="" selected>Chọn kiểu banner</option>
                                        <option value="1" {{ $banner->type_show == "1" ? 'selected' : '' }}>Đăng nhập - Đăng ký</option>
                                        <option value="2" {{ $banner->type_show == "2" ? 'selected' : '' }}>Banner 2 ảnh cạnh slider</option>
                                        <option value="3" {{ $banner->type_show == "3" ? 'selected' : '' }}>Banner 3 ảnh phần body</option>
                                        <option value="4" {{ $banner->type_show == "4" ? 'selected' : '' }}>Banner Top</option>
                                        <option value="5" {{ $banner->type_show == "5" ? 'selected' : '' }}>Banner 2 ảnh phần body trên footer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label>Trạng thái</label>
                                    </div>
                                    <input type="checkbox" id="switch1" name="status" switch="none" {{old('status') ? 'checked' : ($banner->status == 1 ? 'checked' : '') }}/>
                                    <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div>
                                        <label id="label-img"><strong class="text-danger">*</strong> Ảnh </label>
                                    </div>
                                    <div id="wap_img">
                                        @if ($banner->image != null)
                                            <div class="col-md-12">
                                                <div class="img-upload-preview" style="height: 200px">
                                                    <img height="150px" src="{{ asset($banner->image) }}" alt="" class="img-responsive"/>
                                                    <button type="button" class="btn btn-danger close-btn remove-file">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="previous_photo" value="{{ $banner->image }}">
                                        @else
                                            <div id="image"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
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

                        </div>
                    </form>
                </div>
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <!-- validation js -->
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('form').parsley();

            $("#image").spartanMultiImagePicker({
                fieldName: 'image',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'col-md-12',
                maxFileSize: '720000',
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
                $(this).parents(".col-md-12").remove();
                $('#wap_img').append('<div id="image"></div>');
                $("#image").spartanMultiImagePicker({
                    fieldName: 'image',
                    maxCount: 1,
                    rowHeight: '150px',
                    groupClassName: 'col-md-12',
                    maxFileSize: '720000',
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
            const size = {
                "1": "600px * 550px",
                "2": "416px * 184px",
                "3": "416px * 182px",
                "4": "1920px * 40px",
                "5": "636px * 272px"
            };
            const selectedValue = $("#select-type-show").val();
            const labelText = size[selectedValue]
                ? `<strong class="text-danger">*</strong> Ảnh ${size[selectedValue]}`
                : `<strong class="text-danger">*</strong> Ảnh ${selectedText}`;
            $("#label-img").html(labelText);

            $("#select-type-show").change(function () {
                const value = $(this).val();
                const labelText = size[value] ? `<strong class="text-danger">*</strong> Ảnh ${size[value]}` : `<strong class="text-danger">*</strong> Ảnh`;
                $("#label-img").html(labelText);
            });
        });
    </script>
@endsection
