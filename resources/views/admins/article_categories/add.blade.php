@extends('admins.layouts.master')
@section('title', 'Thêm danh mục tin tức')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thêm danh mục tin tức
                        <a href="{{ route('articles-categories.index')  }}" class="btn btn-secondary waves-effect pull-right">Danh sách</a>
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

                    <form action="{{route('articles-categories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4 position_rel">
                                <div class="form-group">
                                    <label class="control-label" for="parent_id">Danh mục cha</label>
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
                                    <label><strong class="text-danger">*</strong> Tiêu đề</label>
                                    <input name="title" type="text" class="form-control" required value="{{old('title')}}"/>
                                </div>
                                <div class="form-group">
                                    <label><strong class="text-danger">*</strong> Miêu tả ngắn</label>
                                    <textarea name="description" class="form-control" rows="6">{{old('description')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="banner">
                                        Ảnh banner danh mục <small>(520x520)</small>
                                    </label>
                                    <div class="row" id="image"></div>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái hiển thị</label>&nbsp;
                                    <input type="checkbox" id="switch1" name="status" switch="none" checked/>
                                    <label style="margin-bottom: -6px" for="switch1" data-on-label="On" data-off-label="Off"></label>
                                </div>
                                <div class="form-group">
                                    <label>Hiển thị ở trang danh sách</label>&nbsp;
                                    <input type="checkbox" id="switch2" name="is_show" switch="none" checked/>
                                    <label style="margin-bottom: -6px" for="switch2" data-on-label="On" data-off-label="Off"></label>
                                </div>
                                <br/>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Tiêu đề Meta</label>
                                    <input type="text" class="form-control" name="meta_title" value="{{old('meta_title')}}">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung Meta</label>
                                    <textarea class="form-control" name="meta_description" rows="3">{{old('meta_description')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung danh mục <strong class="text-danger">*</strong></label>
                                    <textarea id="content" name="content_cate" class="form-control" required>{{old('content_cate')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-5">
                                Thêm mới
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect">
                                Hủy nhập
                            </button>
                        </div>
                    </form>
                </div><!-- end card body-->
            </div><!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <!-- validation js -->
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('form').parsley();

            try {
                CKEDITOR.instances['content'].destroy(true);
            } catch (e) {
            }
            CKEDITOR.replace('content', {
                filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });

            $("#image").spartanMultiImagePicker({
                fieldName: 'banner',
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
