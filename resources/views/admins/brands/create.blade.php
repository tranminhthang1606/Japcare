@extends('admins.layouts.master')
@section('title', 'Thêm thương hiệu sản phẩm')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thêm thương hiệu sản phẩm
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
                    <form action="{{route('brands.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Tiêu đề <span style="color: red;font-weight: bold">*</span></label>
                                        <div>
                                            <input type="text" class="form-control" value="{{old('title')}}" name="title" placeholder="Tiêu đề" maxlength="200" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Logo (Width 520px)</label>
                                        <div id="logo" class="row"></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <div>
                                                <label>Trạng thái</label>
                                            </div>
                                            <input type="checkbox" id="switch4" name="status" switch="none" checked/>
                                            <label for="switch4" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <div>
                                                <label>Nổi bật</label>
                                            </div>
                                            <input type="checkbox" id="switch1" name="top" switch="none" {{old('top') ? 'checked' : ''}}/>
                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tiêu đề Meta</label>
                                        <div>
                                            <input value="{{old('meta_title')}}" type="text" class="form-control" name="meta_title" placeholder="Thẻ tiêu đề">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung Meta</label>
                                        <textarea name="meta_description" rows="5" class="form-control">{{old('meta_description')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Giới thiệu thương hiệu</label>
                                        <textarea id="content" class="editor" name="description">{{old('description')}}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <button type="submit" name="button" class="btn btn-info">Thêm mới</button>
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
                fieldName:        'logo',
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
        });
    </script>
@endsection
