@extends('admins.layouts.master')
@section('title', 'Sửa sản phẩm')

@section('stylesheet')
    <style type="text/css">
        .modal-dialog {
            max-width: 760px;
        }
        .modal-content .close {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 35px;
            z-index: 99;
            background-color: #ccc;
            border-radius: 3px;
        }
        .modal-body {
            padding: 30px 15px;
            text-align: center;
        }
        .modal-body img {
            max-width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Sửa sản phẩm
                        <a href="{{url('admin/products')}}" class="btn btn-rounded btn-dark pull-right prod-create">
                            Danh sách sản phẩm
                        </a>
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
                    <form class="update_product_form" action="{{route('products.update', $product->id)}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="panel-body">
                            <div class="tab-base tab-stacked-left">
                                <!--Nav tabs-->
                                <ul class="nav nav-tabs-custom">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab-one"
                                           aria-expanded="true">Thông tin chung</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab-two"
                                           aria-expanded="false">Phân loại sản phẩm</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab-three"
                                           aria-expanded="false">Mô tả sản phẩm</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab-four"
                                           aria-expanded="false">Thành phần/ công dụng</a>
                                    </li>
                                </ul>
                                <!--Tabs Content-->
                                <div class="tab-content">
                                    <div id="tab-one" class="tab-pane fade show active">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <label>Danh mục <span class="required">*</span></label>
                                                        <select class="form-control select2" name="category_id" required>
                                                            <option value="">Chọn danh mục</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}" data-parent="{{ $category->parent_id }}"
                                                                    {{ $product->category_id == $category->id ? 'selected' : ''}} >
                                                                    {{ $category->title }}
                                                                </option>
                                                                @if (count($category->children) > 0)
                                                                    @include('admins.inc.subcategories',['children' => $category->children, 'parent' => '-'])
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Thương hiệu <span class="required">*</span></label>
                                                        <select class="form-control select2" name="brand_id" required>
                                                            <option value="">Chọn thương hiệu</option>
                                                            @foreach ($brands as $brand)
                                                                <option
                                                                    value="{{ $brand->id }}" {{old('brand_id') == $brand->id ? 'selected' : ($product->brand_id == $brand->id ? 'selected' : '')}} >{{ $brand->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label>Tên sản phẩm <span class="required">*</span></label>
                                                        <input type="text" name="title" class="form-control" value="{{old('title') ?: $product->title}}"
                                                               maxlength="255" required>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label>Slug <span class="required">*</span></label>
                                                        <input type="text" name="slug" class="form-control" value="{{old('slug') ?: $product->slug}}"
                                                               maxlength="255" required>
                                                        <p class="mb-0">
                                                            <small>Viết thường không dấu, cách nhau bằng dấu gạch ngang</small>
                                                        </p>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label>Công dung sản phẩm</label>
                                                        <select name="uses[]" class="select2 form-control select2-multiple" multiple>
                                                            @if(count($productUses) > 0)
                                                                @foreach($productUses as $itemU)
                                                                    @if(is_array(json_decode($product->uses)) && in_array($itemU->id, json_decode($product->uses)))
                                                                        <option value="{{ $itemU->id }}" selected>{{ $itemU->title }}</option>
                                                                    @else
                                                                        <option value="{{ $itemU->id }}">{{ $itemU->title }}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label class="control-label">Thành phần</label>
                                                        <select name="ingredients[]" class="select2 form-control select2-multiple" multiple>
                                                            @foreach($ingredients as $item)
                                                                @if(is_array(json_decode($product->ingredients)) && in_array($item->id, json_decode($product->ingredients)))
                                                                    <option value="{{ $item->id }}" selected>{{ $item->title }}</option>
                                                                @else
                                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <div>
                                                                <label>Sản phẩm mới về</label>
                                                            </div>
                                                            <input type="checkbox" id="switch3" name="is_new"
                                                                   switch="none" {{$product->is_new == 1 ? 'checked' : ''}}/>
                                                            <label for="switch3" data-on-label="On" data-off-label="Off"></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div>
                                                                <label>Trạng thái</label>
                                                            </div>
                                                            <input type="checkbox" id="is_status" name="is_status"
                                                                   switch="none" {{$product->status == 1 ? 'checked' : ''}}/>
                                                            <label for="is_status" data-on-label="On" data-off-label="Off"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <div>
                                                                <label>Sản phẩm yêu thích</label>
                                                            </div>
                                                            <input type="checkbox" id="switch2" name="is_favourite"
                                                                   switch="none" {{$product->is_favourite == 1 ? 'checked' : ''}}/>
                                                            <label for="switch2" data-on-label="On" data-off-label="Off"></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div>
                                                                <label>Sản phẩm bán chạy</label>
                                                            </div>
                                                            <input type="checkbox" id="switch1" name="featured"
                                                                   switch="none" {{old('featured') ? 'checked' : ($product->featured ? 'checked' : '')}} />
                                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Hình ảnh đại diện (500px*480px)</label>
                                                    <div id="wap_img">
                                                        @if ($product->featured_img != null)
                                                            <div class="col-md-3 col-sm-3 col-xs-4">
                                                                <div class="img-upload-preview" style="height: 200px">
                                                                    <img height="200px" src="{{ asset($product->featured_img) }}" alt=""/>
                                                                    <button type="button" class="btn btn-danger close-btn remove-file">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div id="image"></div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Meta title</label>
                                                    <input type="text" value="{{old('meta_title') ?: $product->meta_title}}"
                                                           class="form-control" name="meta_title">
                                                </div>
                                                <div class="form-group">
                                                    <label>Meta description</label>
                                                    <textarea name="meta_description" rows="5"
                                                              class="form-control">{{old('meta_description') ?: $product->meta_description}}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div><!--Tab one-->
                                    <div id="tab-two" class="tab-pane fade">
                                        @foreach($product_size as $ks => $itemSize)
                                            <div class="size-item" style="padding: 10px 15px">
                                                @if($ks != 0 || $itemSize->is_default != 1)
                                                    <button type="button" class="btn btn-danger close-color-button closeSize">X {{ $itemSize->is_default }}</button>
                                                @endif

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Tiêu đề <span class="required">*</span></label>
                                                            <input type="text" class="form-control" name="item[{{$ks}}][title]"
                                                                   value="{{$itemSize->title}}" required>
                                                            <input type="hidden" class="product_size_id" name="item[{{$ks}}][product_size_ids]"
                                                                   value="{{$itemSize->id}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label>Mã sản phẩm <span class="required">*</span></label>
                                                                    <input type="text" class="form-control code-input" name="item[{{$ks}}][codes]"
                                                                           value="{{$itemSize->code}}" maxlength="20" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Số lượng <span class="required">*</span></label>
                                                                    <input type="number" class="form-control" min="1" name="item[{{$ks}}][stocks]"
                                                                           value="{{$itemSize->stock}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Giá bán <span style="color: red;font-weight: bold">*</span></label>
                                                                    <input type="text" class="form-control custom-mask price_size" name="item[{{$ks}}][prices]"
                                                                           value="{{$itemSize->price}}" minlength="2" maxlength="14"
                                                                           data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0"
                                                                           required>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label>Giá sale</label>
                                                                    <input type="text" class="form-control custom-mask sale_price_size" name="item[{{$ks}}][sale_prices]"
                                                                           value="{{$itemSize->sale_price}}" minlength="2" maxlength="14"
                                                                           data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label>Giảm giá(%)</label>
                                                                    <input type="number" class="form-control discount" name="item[{{$ks}}][discounts]"
                                                                           value="{{$itemSize->discount}}" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label>Mặc định</label>
                                                                <input type="radio" class="size_show" name="size_show" @if($itemSize->is_default == 1) checked @endif>
                                                                <input type="hidden" class="get_show" name="item[{{$ks}}][get_show]" value="{{$itemSize->is_default}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <label>Hình ảnh sản phẩm theo kích thước (500px*480px)
                                                                @if($itemSize->is_default == 1)
                                                                    <span class="required">*</span>
                                                                @endif
                                                            </label>
                                                            @if($itemSize->photo_color && is_array(json_decode($itemSize->photo_color)))
                                                                @if($ks < 1)
                                                                    <div id="size_photos_0" class="row">
                                                                        @foreach (json_decode($itemSize->photo_color) as $key => $photo)
                                                                            <div class="col-md-3 col-xs-4">
                                                                                <div class="img-upload-preview" style="height: 150px">
                                                                                    <img height="150px" src="{{ asset($photo) }}" alt="" class="img-responsive">
                                                                                    <input type="hidden" name="item[{{$ks}}][photos_prv][]" value="{{ $photo }}">
                                                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <div id="wap_img_{{$ks}}">
                                                                        @foreach (json_decode($itemSize->photo_color) as $key => $photo)
                                                                            <div class="col-md-3 col-xs-4">
                                                                                <div class="img-upload-preview" style="height: 150px">
                                                                                    <img height="150px" src="{{ asset($photo) }}" alt="" class="img-responsive">
                                                                                    <input type="hidden" name="item[{{$ks}}][photos_prv][]" value="{{ $photo }}">
                                                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div id="size_photos_{{$ks}}"></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="add-size-area">
                                            <button type="button" class="btn btn-purple addItemType" data-key="{{ $countSize }}">
                                                Thêm phân loại
                                            </button>
                                        </div>
                                    </div><!--Tab two-->
                                    <!--tab-three-->
                                    <div id="tab-three" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="mt-2">Thông tin chung</label>
                                                    <textarea class="editor" name="content_prd">{{old('content_prd') ?: $product->content}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="mt-2">Hướng dẫn sử dụng</label>
                                                    <textarea class="editor" name="txt_manual">{{old('txt_manual') ?: $product->txt_manual}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--Tab three-->
                                    <div id="tab-four" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="mt-2">Công dụng sản phẩm</label>
                                                    <textarea class="editor" name="txt_uses">{{old('txt_uses') ?: $product->txt_uses}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="mt-2">Thông số sản phẩm</label>
                                                    <textarea class="editor" name="txt_info">{{old('txt_info') ?: $product->txt_info}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="mt-2">Mô tả thành phần trong sản phẩm</label>
                                                    <textarea class="editor" name="txt_ingredient">{{old('txt_ingredient') ?: $product->txt_ingredient}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--Tab four-->

                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <button type="submit" class="btn btn-info update-product-submit">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <img id="img_detail" src="{{ asset($product->featured_img) }}" alt="img show"/>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom_script')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- validation js -->
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('form').parsley();
            $(".custom-mask").inputmask({
                'alias': 'numeric', allowMinus: false
            });
            //
            try {
                CKEDITOR.instances['content_prd'].destroy(true);
                CKEDITOR.instances['txt_uses'].destroy(true);
                CKEDITOR.instances['txt_ingredient'].destroy(true);
                CKEDITOR.instances['txt_manual'].destroy(true);
                CKEDITOR.instances['txt_info'].destroy(true);
            } catch (e) {}
            CKEDITOR.replace('content_prd', {
                filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('txt_uses', {
                filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('txt_ingredient', {
                filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('txt_manual', {
                filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('txt_info', {
                filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });

            // show size imge
            $('.img-upload-preview').on('click', function () {
                let urlImg = $(this).find('img.img-responsive').attr('src');
                $('.modal-body #img_detail').attr('src', urlImg);
                $('#myModal').modal();
            });

            //image
            $("#image").spartanMultiImagePicker({
                fieldName: 'product_image',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'col-md-3',
                maxFileSize: '720000',
                allowedExt: '',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    alert('File size too big');
                }
            });
            $('.remove-file').on('click', function () {
                $(this).parents(".col-md-3").remove();
                $('#wap_img').append('<div id="image"></div>');
                $("#image").spartanMultiImagePicker({
                    fieldName: 'product_image',
                    maxCount: 1,
                    rowHeight: '150px',
                    groupClassName: 'col-md-3 col-sm-3 col-xs-4',
                    maxFileSize: '720000',
                    allowedExt: '',
                    dropFileLabel: "Drop Here",
                    onExtensionErr: function (index, file) {
                        alert('Please only input png or jpg type file')
                    },
                    onSizeErr: function (index, file) {
                        alert('File size too big');
                    }
                });
            });
            // size first
            $("#size_photos_0").spartanMultiImagePicker({
                fieldName: 'item[0][photos][]',
                maxCount: 6,
                rowHeight: '150px',
                groupClassName: 'col-md-3',
                maxFileSize: '1024000',
                allowedExt: '',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    alert('File size too big');
                }
            });
            $("#size_photos_0 .remove-files").on('click', function () {
                $(this).parents(".col-md-3").remove();
            });

            @foreach($product_size as $k => $itemSize)
                @if($k < 1) @continue @endif

                $("#size_photos_{{$k}}").spartanMultiImagePicker({
                    fieldName: 'item[{{$k}}][photos][]',
                    maxCount: 1,
                    rowHeight: '150px',
                    groupClassName: 'col-md-3',
                    maxFileSize: '1024000',
                    allowedExt: '',
                    dropFileLabel: "Drop Here",
                    onExtensionErr: function (index, file) {
                        alert('Please only input png or jpg type file')
                    },
                    onSizeErr: function (index, file) {
                        alert('File size too big');
                    }
                });

                $("#wap_img_{{$k}} .remove-files").on('click', function () {
                    $(this).parents(".col-md-3").remove();
                    $("#wap_img_{{$k}}").append('<div id="size_photos_{{$k}}"></div>');

                    $("#size_photos_{{$k}}").spartanMultiImagePicker({
                        fieldName: 'item[{{$k}}][photos][]',
                        maxCount: 1,
                        rowHeight: '150px',
                        groupClassName: 'col-md-3',
                        maxFileSize: '720000',
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
            @endforeach

            //handle color delete
            $('.closeSize').on('click', function (e) {
                e.preventDefault();
                let $this = $(this).parent('.size-item');
                let product_size_id = $this.find('.product_size_id').val();
                Swal.fire({
                    title: 'Bạn có chắc muốn xóa?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có',
                    cancelButtonText: 'Không xóa'
                }).then(function (isConfirm) {
                    if (isConfirm && isConfirm.value) {
                        if (product_size_id != '') {
                            $.post('{{ route('admin.products.delete_size') }}', {
                                '_token': '{{ csrf_token() }}',
                                'id': product_size_id
                            }, function (data) {
                                if (data == 1) {
                                    $this.remove();
                                    showResultAlert('success', 'Xóa loại sản phẩm thành công!');
                                } else {
                                    showResultAlert('error', 'Xóa loại sản phẩm đã xảy ra lỗi. Vui lòng thử lại!');
                                }
                            });
                        }
                    }
                });
            });

            //handle sale price
            $(document).on('keyup', '.price_size', function () {
                $(this).parents('.size-item').find('.discount').val('');
                $(this).parents('.size-item').find('.sale_price_size').val('');
            });

            $(document).on('keyup','.sale_price_size', function () {
                let price = $(this).parents('.size-item').find('.price_size').val().replaceAll(',', '');
                if (price) {
                    let getSalePrice = $(this).val();
                    let sale_price = getSalePrice.replaceAll(',', '');
                    if (parseInt(sale_price) > parseInt(price)) {
                        showResultAlert('error', 'Giá sale phải thấp hơn giá hiện tại!');
                        $(this).val(price);
                        $(this).parents('.size-item').find('.discount').val(0)
                    } else {
                        let discount = Math.round(((price - sale_price) * 100) / price);
                        $(this).parents('.size-item').find('.discount').val(discount)
                    }
                }
            });
            //add color prod
            $('.addItemType').on('click', function () {
                let key = $(this).attr('data-key');
                $.post("{{route('admin.products.appendItem')}}", {_token:'{{ csrf_token() }}', 'key': key}, function (data) {
                    $('#tab-two').append(data);
                });
                $(this).attr('data-key', parseInt(key) + 1);
            });
            //handle item remove
            $('body').on('click', '.closeSizeAdd', function () {
                const grandParent = $(this).parent().parent();
                let isShow = $(this).parent().find('.get_show:first').val() == 1;
                $(this).parent().remove();
                if (isShow) {
                    grandParent.find('.size_show:first').prop("checked", true);
                    grandParent.find('.get_show:first').val(1)
                }
            });

            // click default show
            $(document).on("click", ".size-item .size_show", function(){
                $('.size-item').each(function () {
                    $('input.get_show').val(0);
                });
                $(this).parent().find("input.get_show").val(1);
            });

        });
    </script>
@endsection
