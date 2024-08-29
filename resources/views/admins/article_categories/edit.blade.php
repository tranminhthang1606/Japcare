@extends('admins.layouts.master')
@section('title', 'Sửa danh mục tin tức')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Sửa danh mục tin tức
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

                    <form action="{{route('articles-categories.update', ['articles_category' => $category->id])}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="panel-body">
                            <div class="tab-base tab-stacked-left">
                                <!--Nav tabs-->
                                <ul class="nav nav-tabs-custom">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab-one" aria-expanded="true">Thông tin chung</a>
                                    </li>
                                </ul>
                                <!--Tabs Content-->
                                <div class="tab-content">
                                    <div id="tab-one" class="tab-pane fade show active">
                                        <div class="row">
                                            <div class="col-4 position_rel">
                                                <div class="form-group">
                                                    <label class="control-label" for="banner">Danh mục cha</label>
                                                    <select class="form-control" name="parent_id" id="parent_id">
                                                        <option value="0">Chọn danh mục cha</option>
                                                        @foreach ($parent_categories as $parent_category)
                                                            <option value="{{ $parent_category->id }}" data-parent="{{ $parent_category->parent_id }}"
                                                                {{ $category->id == $parent_category->id ? 'disabled' : ''}}
                                                                {{$category->parent_id == $parent_category->id ? 'selected' : ''}} >
                                                                {{ $parent_category->title }}
                                                            </option>
                                                            @if (count($parent_category->children) > 0)
                                                                @include(
                                                                    'admins.inc.subcategories',
                                                                    ['children' => $parent_category->children, 'parent' => '-',
                                                                    'id_selected'=>$category->parent_id, 'id_current'=>$category->id]
                                                                )
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tiêu đề <strong class="text-danger">*</strong></label>
                                                    <input name="title" type="text" class="form-control"
                                                           required value="{{old('title') ?: $category->title}}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Link danh mục <strong class="text-danger">*</strong></label>
                                                    <input name="slug" type="text" class="form-control"
                                                           required value="{{old('slug') ?: $category->slug}}"/>
                                                    <p class="mb-0">
                                                        <small>Viết thường không dấu, cách nhau bằng dấu gạch ngang</small>
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Miêu tả ngắn <strong class="text-danger">*</strong></label>
                                                    <textarea name="description" class="form-control" rows="6">{{old('description') ?: $category->description}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="banner">
                                                        Hình ảnh <small>(520x520)</small>
                                                    </label>

                                                    <div id="wap_img">
                                                        @if ($category->photos != null)
                                                            <div class="col-md-6">
                                                                <div class="img-upload-preview" style="height: 200px">
                                                                    <img height="150px" src="{{ asset($category->photos) }}" alt="" class="img-responsive"/>
                                                                    <button type="button" class="btn btn-danger close-btn remove-file">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="previous_photo" value="{{ $category->photos }}">
                                                        @else
                                                            <div id="image"></div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Trạng thái hiển thị</label>&nbsp;
                                                    <input type="checkbox" id="switch1" name="status" switch="none" {{old('status') ? 'checked' : ($category->status == 1 ? 'checked' : '')}}/>
                                                    <label style="margin-bottom: -6px" for="switch1" data-on-label="On" data-off-label="Off"></label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Hiển thị menu trang</label>&nbsp;
                                                    <input type="checkbox" id="switch2" name="is_show" switch="none"
                                                        {{old('is_show') ? 'checked' : ($category->is_show == 1 ? 'checked' : '')}}/>
                                                    <label style="margin-bottom: -6px" for="switch2" data-on-label="On" data-off-label="Off"></label>
                                                </div>
                                            </div>

                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label>Nội dung danh mục <strong class="text-danger">*</strong></label>
                                                    <textarea id="content" name="content_cate" class="form-control">{{old('content_cate') ?: $category->content}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tiêu đề Meta</label>
                                                    <input type="text" class="form-control" name="meta_title" value="{{old('meta_title') ?: $category->meta_title}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Nội dung Meta</label>
                                                    <textarea class="form-control" name="meta_description" rows="3">{{old('meta_description') ?: $category->meta_description}}</textarea>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-5">
                                Sửa
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect">
                                Hủy nhập
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
                $(this).parents(".col-md-6").remove();
                $('#wap_img').append('<div id="image"></div>');
                $("#image").spartanMultiImagePicker({
                    fieldName: 'banner',
                    maxCount: 1,
                    rowHeight: '150px',
                    groupClassName: 'col-md-4',
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

        });
    </script>
@endsection
