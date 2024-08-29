@extends('admins.layouts.master')
@section('title', 'Sliders edit')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Chi tiết slider
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
                    <form action="{{ route('sliders.update',$dataDetail->id ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4 position_rel">
                                <div class="form-group">
                                    <label><strong class="text-danger">*</strong> Tiêu đề</label>
                                    <input name="title" type="text" class="form-control" required placeholder="Tiêu đề" value="{{$dataDetail->title}}" />
                                </div>
                                <div class="form-group">
                                    <label>Link liên kết</label>
                                    <input name="link_detail" type="text" class="form-control" placeholder="Link liên kết" value="{{$dataDetail->link}}" />
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label>Trạng thái</label>
                                    </div>
                                    <input type="checkbox" id="switch1" name="published" switch="none" {{$dataDetail->published == 1 ? 'checked' : '' }}/>
                                    <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                </div>
                                <div class="form-group">
                                    <label>Kiểu slider</label>
                                    <select class="form-control" name="type" required>
                                        <option value="" selected>Chọn kiểu slider</option>
                                        <option value="1" {{ $dataDetail->type == "1" ? 'selected' : '' }}>Slider trang chủ</option>
                                        <option value="2" {{ $dataDetail->type == "2" ? 'selected' : '' }}>Slider tin tức</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <div>
                                        <label>Ảnh kích thước(843px*386px)</label>
                                    </div>
                                    <div id="wap_img">
                                        @if ($dataDetail->photo != null)
                                            <div class="col-md-12">
                                                <div class="img-upload-preview" style="height: 200px">
                                                    <img height="150px" src="{{ asset($dataDetail->photo) }}" alt="" class="img-responsive"/>
                                                    <button type="button" class="btn btn-danger close-btn remove-file">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="previous_photo" value="{{ $dataDetail->photo }}">
                                        @else
                                            <div id="image"></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label>Ảnh mobile</label>
                                    </div>
                                    <div id="wap_img_mb">
                                        @if ($dataDetail->photo_mb != null)
                                            <div class="col-md-3 col-sm-3 col-xs-4">
                                                <div class="img-upload-preview" style="height: 200px">
                                                    <img height="150px" src="{{ asset($dataDetail->photo_mb) }}" alt="" class="img-responsive"/>
                                                    <button type="button" class="btn btn-danger close-btn remove-file-mb">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="previous_photo_mb" value="{{ $dataDetail->photo_mb }}">
                                        @else
                                            <div id="image_mb"></div>
                                        @endif
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
                </div>
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <script type="text/javascript">
        $(document).ready(function (){
            $("#image").spartanMultiImagePicker({
                fieldName: 'photo',
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
            $('.remove-file').on('click', function () {
                $(this).parents(".col-md-12").remove();
                $('#wap_img').append('<div id="image"></div>');
                $("#image").spartanMultiImagePicker({
                    fieldName: 'photo',
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
            });

            $("#image_mb").spartanMultiImagePicker({
                fieldName: 'photo_mb',
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
            $('.remove-file-mb').on('click', function () {
                $(this).parents(".col-md-3").remove();
                $('#wap_img_mb').append('<div id="image_mb"></div>');
                $("#image_mb").spartanMultiImagePicker({
                    fieldName: 'photo_mb',
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

        });
    </script>
@endsection
