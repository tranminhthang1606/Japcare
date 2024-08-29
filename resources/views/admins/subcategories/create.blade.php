@extends('admins.layouts.master')
@section('title', 'Thêm danh mục con sản phẩm')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">Thêm danh mục con sản phẩm</h4>
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
                    <form action="{{route('subcategories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="control-label">Danh mục cha <span style="color: red;font-weight: bold">*</span></label>
                                                    <div>
                                                        <select class="form-control" name="category_id" required>
                                                            <option value="">Chọn danh mục</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Tiêu đề <span style="color: red;font-weight: bold">*</span></label>
                                                    <div>
                                                        <input type="text" class="form-control" value="{{old('title')}}" name="title" placeholder="Tiêu đề" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Hình ảnh </label>
                                                    <div class="col-lg-12">
                                                        <div id="image">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-4">
                                                        <div>
                                                            <label>Nổi bật</label>
                                                        </div>
                                                        <input type="checkbox" id="switch1" name="featured" switch="none" {{old('featured') ? 'checked' : ''}}/>
                                                        <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <div>
                                                            <label>Hiển thị trên menu</label>
                                                        </div>
                                                        <input type="checkbox" id="switch2" name="is_menu" switch="none" {{old('is_menu') ? 'checked' : ''}}/>
                                                        <label for="switch2" data-on-label="On" data-off-label="Off"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <label>Trạng thái</label>
                                                    </div>
                                                    <input type="checkbox" id="switch3" name="status" switch="none" checked/>
                                                    <label for="switch3" data-on-label="On" data-off-label="Off"></label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="control-label">Mô tả</label>
                                                    <div >
                                                        <textarea id="content" class="editor" name="description">{{old('description')}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-two" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-3">
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="control-label">Thẻ tiêu đề</label>
                                                    <div>
                                                        <input value="{{old('meta_title')}}" type="text" class="form-control" name="meta_title" placeholder="Thẻ tiêu đề">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Thẻ mô tả</label>
                                                    <div>
                                                        <textarea name="meta_description" rows="5" class="form-control">{{old('meta_description')}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <button type="submit" name="button" class="btn btn-info">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div> <!-- end row -->
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
            //image
            $("#image").spartanMultiImagePicker({
                fieldName:        'image',
                maxCount:         1,
                rowHeight:        '200px',
                groupClassName:   'col-md-4 col-sm-4 col-xs-6',
                maxFileSize:      '',
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
