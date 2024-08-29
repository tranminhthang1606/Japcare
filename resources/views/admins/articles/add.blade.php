@extends('admins.layouts.master')
@section('title', 'Thêm tin tức')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thêm tin tức
                        <a href="{{route('articles.index')}}" class="btn btn-rounded btn-info pull-right">Danh sách</a>
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
                    <form action="{{route('articles.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="category_id">Danh mục bài viết <strong class="text-danger">*</strong></label>
                                        <select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
                                            <option value="">Chọn danh mục</option>
                                            @foreach ($categories as $parent_category)
                                                <option value="{{ $parent_category->id }}" data-parent="{{ $parent_category->parent_id }}"
                                                    {{old('parent_id') == $parent_category->id ? 'selected' : '' }} >
                                                    {{ $parent_category->title }}
                                                </option>
                                                @if (count($parent_category->children) > 0)
                                                    @include('admins.inc.subcategories',['children' => $parent_category->children, 'parent' => '-'])
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tiêu đề bài viết <strong class="text-danger">*</strong></label>
                                        <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Tiêu đề bài viết" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Miêu tả ngắn <strong class="text-danger">*</strong></label>
                                        <textarea name="description" rows="4" class="form-control" required>{{old('description')}}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Trạng thái hiển thị</label>&nbsp;
                                                <input type="checkbox" id="switch1" name="status" switch="none" checked/>
                                                <label style="margin-bottom: -6px" for="switch1" data-on-label="On" data-off-label="Off"></label>
                                            </div>
                                            <div class="form-group">
                                                <label>Bài viết nổi bật</label>&nbsp;
                                                <input type="checkbox" id="switch2" name="is_featured" switch="none" />
                                                <label style="margin-bottom: -6px" for="switch2" data-on-label="On" data-off-label="Off"></label>
                                            </div>
                                            <div class="form-group">
                                                <label>Chủ đề hot</label>&nbsp;
                                                <input type="checkbox" id="switch3" name="is_hot" switch="none" />
                                                <label style="margin-bottom: -6px" for="switch3" data-on-label="On" data-off-label="Off"></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Hình ảnh <small>(760x760)</small></label>
                                                <div id="photos" class="row"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="form-group">
                                        <label>Tiêu đề Meta</label>
                                        <input type="text" class="form-control" name="meta_title" value="{{old('meta_title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung Meta</label>
                                        <textarea class="form-control" name="meta_description" rows="3">{{old('meta_description')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Nội dung bài viết <strong class="text-danger">*</strong></label>
                                        <div>
                                            <textarea id="content" class="editor" name="content_article" required>{{old('content_article')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-5">
                                Lưu
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div><!-- end card -->
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
            //
            $("#photos").spartanMultiImagePicker({
                fieldName:        'image',
                maxCount:         1,
                rowHeight:        '150px',
                groupClassName:   'col-md-12',
                maxFileSize:      '720000',
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
