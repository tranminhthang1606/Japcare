@extends('admins.layouts.master')
@section('title', 'Sửa danh mục sản phẩm')

@section('content')
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="card m-b-20">
            <div class="card-body">
                <h4 class="mt-0 header-title border_b">
                    Sửa danh mục sản phẩm
                    <a href="{{ route('categories.index') }}" class="btn btn-rounded btn-blue-grey pull-right">Danh
                        sách</a>
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
                <form action="{{route('categories.update', $category->id)}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="parent_id">Danh mục cha</label>
                                    <select class="form-control" name="parent_id" id="parent_id">
                                        <option value="">Chọn danh mục cha</option>
                                        @foreach ($parent_categories as $parent_category)
                                        <option value="{{ $parent_category->id }}"
                                            data-parent="{{ $parent_category->parent_id }}" {{ $category->id ==
                                            $parent_category->id ? 'disabled' : ''}}
                                            {{ $category->parent_id == $parent_category->id ? 'selected' : ''}}>
                                            {{ $parent_category->title }}
                                        </option>
                                        @if (count($parent_category->children) > 0)
                                        @include('admins.inc.subcategories',
                                        ['children' => $parent_category->children, 'parent' => '-',
                                        'id_selected'=>$category->parent_id, 'id_current'=>$category->id]
                                        )
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề <span style="color: red;font-weight: bold">*</span></label>
                                    <div>
                                        <input type="text" class="form-control" name="title" placeholder="Tiêu đề"
                                            value="{{old('title') ?: $category->title}}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Link danh mục <strong class="text-danger">*</strong></label>
                                    <input name="slug" type="text" class="form-control" required
                                        value="{{old('slug') ?: $category->slug}}" />
                                    <p class="mb-0">
                                        <small>Viết thường không dấu, cách nhau bằng dấu gạch ngang</small>
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>Hình ảnh danh mục</label>
                                    <div id="wap_img">
                                        @if ($category->image != null)
                                        <div class="col-md-6">
                                            <div class="img-upload-preview">
                                                <img src="{{ asset($category->image) }}" alt="" class="img-responsive">
                                                <button type="button" class="btn btn-danger close-btn remove-files">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="previous_image" value="{{$category->image}}">
                                        @else
                                        <div id="image"></div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <div><label>Trạng thái</label></div>
                                        <input type="checkbox" id="switch3" name="status" switch="none" {{old('status')
                                            ? 'checked' : ($category->status ? 'checked' : '')}}/>
                                        <label for="switch3" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <div><label>Nổi bật</label></div>
                                        <input type="checkbox" id="switch1" name="featured" switch="none"
                                            {{old('featured') ? 'checked' : ($category->featured ? 'checked' : '')}}/>
                                        <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <div>
                                            <label>Hiển thị trên menu</label>
                                        </div>
                                        <input type="checkbox" id="switch2" name="is_menu" switch="none"
                                            {{old('is_menu') ? 'checked' : ($category->is_menu ? 'checked' : '')}}/>
                                        <label for="switch2" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="content">Mô tả <strong class="text-danger">*</strong></label>
                                    <textarea id="content" class="editor" name="description"
                                        required>{{old('description') ?: $category->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Thẻ tiêu đề</label>
                                    <input type="text" name="meta_title"
                                        value="{{old('meta_title') ?: $category->meta_title}}" class="form-control"
                                        placeholder="Thẻ tiêu đề">
                                </div>
                                <div class="form-group">
                                    <label>Thẻ mô tả</label>
                                    <textarea name="meta_description" rows="5"
                                        class="form-control">{{old('meta_description') ?: $category->meta_description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button type="reset" class="btn btn-secondary waves-effect">
                            Hủy nhập
                        </button>
                        <button type="submit" name="button" class="btn btn-info">Cập nhật</button>
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
    jQuery(document).ready(function () {
            $('form').parsley();

            try {
                CKEDITOR.instances['content'].destroy(true);
            } catch (e) {
            }
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
            $('#wap_img .remove-files').on('click', function () {
                $(this).parents(".col-md-6").remove();
                $('#wap_img').append('<div id="image"></div>');

                $("#image").spartanMultiImagePicker({
                    fieldName: 'image',
                    maxCount: 1,
                    rowHeight: '200px',
                    groupClassName: 'col-md-6',
                    maxFileSize: '1024000',
                    allowedExt:  '',
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