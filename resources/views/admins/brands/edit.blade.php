@extends('admins.layouts.master')
@section('title', 'Sửa thương hiệu sản phẩm')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">Sửa thương hiệu sản phẩm
                        <a href="{{ route('brands.index') }}" class="btn btn-blue-grey pull-right">Danh sách</a>
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
                    <form action="{{route('brands.update', $brand->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="panel-body">
                            <div class="tab-base tab-stacked-left">
                                <!--Nav tabs-->
                                <ul class="nav nav-tabs-custom">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab-one" aria-expanded="true">Tổng thể</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab-two" aria-expanded="false">Thẻ Meta</a>
                                    </li>
                                </ul>
                                <!--Tabs Content-->
                                <div class="tab-content">
                                    <div id="tab-one" class="tab-pane fade show active">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Tiêu đề <span style="color: red;font-weight: bold">*</span></label>
                                                    <input type="text" class="form-control" value="{{old('title') ?: $brand->title}}" name="title" placeholder="Tiêu đề" maxlength="255" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Slug <span style="color: red;font-weight: bold">*</span></label>
                                                    <input type="text" class="form-control" value="{{old('slug') ?: $brand->slug}}" name="slug" placeholder="Slug" maxlength="255" required>
                                                    <p class="mb-0">
                                                        <small>Viết thường không dấu, cách nhau bằng dấu gạch ngang</small>
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Logo (Height 109px)</label>
                                                    <div id="wap_logo">
                                                        @if ($brand->logo == null)
                                                            <div id="logo"></div>
                                                        @else
                                                            <div class="col-md-6">
                                                                <div class="img-upload-preview">
                                                                    <img src="{{ asset($brand->logo) }}" alt="logo" class="img-responsive" height="200px">
                                                                    <button type="button" class="btn btn-danger close-btn remove-logo">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="previous_logo" value="{{ $brand->logo }}">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-4">
                                                        <div>
                                                            <label>Trạng thái</label>
                                                        </div>
                                                        <input type="checkbox" id="switch4" name="status"
                                                               switch="none" {{old('status') ? 'checked' : ($brand->status ? 'checked' : '')}}/>
                                                        <label for="switch4" data-on-label="On" data-off-label="Off"></label>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <div>
                                                            <label>Nổi bật</label>
                                                        </div>
                                                        <input type="checkbox" id="switch1" name="top"
                                                               switch="none" {{old('top') ? 'checked' : ($brand->top ? 'checked' : '')}}/>
                                                        <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Mô tả</label>
                                                    <textarea id="content" class="editor" name="description">{{$brand->description}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-two" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-6 offset-3">
                                                <div class="form-group">
                                                    <label class="control-label">Thẻ tiêu đề</label>
                                                    <div>
                                                        <input value="{{$brand->meta_title}}" type="text" class="form-control" name="meta_title" placeholder="Thẻ tiêu đề">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Thẻ mô tả</label>
                                                    <div>
                                                        <textarea name="meta_description" rows="5" class="form-control">{{$brand->meta_description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <button type="submit" name="button" class="btn btn-info">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <!-- validation js -->
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            $('form').parsley();
            try {
                CKEDITOR.instances['content'].destroy(true);
            } catch (e) { }
            CKEDITOR.replace('content', {
                filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            //logo
            $("#logo").spartanMultiImagePicker({
                fieldName:        'image',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-6',
                maxFileSize:      '1024000',
                dropFileLabel : "Drop Here",
                onExtensionErr : function(index, file){
                    console.log(index, file,  'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr : function(index, file){
                    console.log(index, file,  'file size too big');
                    alert('File size too big');
                }
            });
            $('.remove-logo').on('click', function () {
                $(this).parents(".col-md-6").remove();
                $('#wap_logo').append('<div id="logo"></div>');
                $("#logo").spartanMultiImagePicker({
                    fieldName: 'logo',
                    maxCount: 1,
                    rowHeight: '200px',
                    groupClassName: 'col-md-6',
                    maxFileSize: '1024000',
                    dropFileLabel: "Drop Here",
                    onExtensionErr: function (index, file) {
                        console.log(index, file, 'extension err');
                        alert('Please only input png or jpg type file')
                    },
                    onSizeErr: function (index, file) {
                        console.log(index, file, 'file size too big');
                        alert('File size too big');
                    }
                });
            });
        });
    </script>
@endsection
