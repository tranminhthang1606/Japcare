@extends('admins.layouts.master')
@section('title', 'Thêm danh mục sản phẩm')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thêm danh mục sản phẩm
                        <a href="{{ route('categories.index') }}" class="btn btn-rounded btn-blue-grey pull-right">Danh sách</a>
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
                    <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="parent_id">Danh mục cha</label>
                                        <select class="form-control" name="parent_id" id="parent_id">
                                            <option value="0">Chọn danh mục cha</option>
                                            @foreach ($parent_categories as $category)
                                                <option value="{{ $category->id }}" data-parent="{{ $category->parent_id }}" {{old('parent_id') == $category->id ? 'selected' : ''}} >{{ $category->title . (old('parent_id') == $category->id ? 'selected' : '') }}</option>

                                                @if (count($category->children) > 0)
                                                    @include('admins.inc.subcategories',['children' => $category->children, 'parent' => '-'])
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tiêu đề <span style="color: red;font-weight: bold">*</span></label>
                                        <div>
                                            <input type="text" class="form-control" value="{{old('title')}}" name="title" placeholder="Tiêu đề" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh danh mục</label>
                                        <div id="image" class="row"></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <div>
                                                <label>Trạng thái</label>
                                            </div>
                                            <input type="checkbox" id="switch3" name="status" switch="none" checked/>
                                            <label for="switch3" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <div>
                                                <label>Nổi bật</label>
                                            </div>
                                            <input type="checkbox" id="switch1" name="featured"
                                                   switch="none" {{old('featured') ? 'checked' : ''}}/>
                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <div>
                                                <label>Hiển thị ở menu</label>
                                            </div>
                                            <input type="checkbox" id="switch2" name="is_menu"
                                                   switch="none" {{old('is_menu') ? 'checked' : ''}}/>
                                            <label for="switch2" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="form-group">
                                        <label>Thẻ tiêu đề</label>
                                        <div>
                                            <input value="{{old('meta_title')}}" type="text" class="form-control" name="meta_title" placeholder="Thẻ tiêu đề">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Thẻ mô tả</label>
                                        <div>
                                            <textarea name="meta_description" rows="5" class="form-control">{{old('meta_description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Mô tả <strong class="text-danger">*</strong></label>
                                        <div>
                                            <textarea id="content" class="editor" name="description" required>{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <button type="reset" class="btn btn-secondary waves-effect">
                                Hủy nhập
                            </button>
                            <button type="submit" name="button" class="btn btn-info">Lưu</button>
                        </div>
                    </form>
                </div>
            </div><!-- end row -->
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
                groupClassName:   'col-md-6',
                maxFileSize:      '72000',
                allowedExt:  '',
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
