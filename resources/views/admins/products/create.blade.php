@extends('admins.layouts.master')
@section('title', 'Thêm sản phẩm')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thêm sản phẩm
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
                        </div>`
                    @endif
                    <form class="create_product_form" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                                        <select class="form-control select2" name="category_id" id="category_id" required>
                                                            <option value="">Chọn danh mục</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}" data-parent="{{ $category->parent_id }}" {{old('category_id') == $category->id ? 'selected' : ''}} >
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
                                                        <div>
                                                            <select class="form-control select2" name="brand_id" id="brand_id" required>
                                                                <option value="">Chọn thương hiệu</option>
                                                                @foreach ($brands as $brand)
                                                                    <option value="{{ $brand->id }}" {{old('brand_id') == $brand->id ? 'selected' : ''}} >{{ $brand->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label>Tên sản phẩm <span class="required">*</span></label>
                                                        <input type="text" class="form-control" value="{{old('title')}}" name="title" maxlength="200" required>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label>Công dung sản phẩm</label>
                                                        <select name="uses[]" class="select2 form-control select2-multiple" multiple>
                                                            @if(count($productUses) > 0)
                                                                @foreach($productUses as $itemU)
                                                                    <option value="{{ $itemU->id }}">{{ $itemU->title }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label>Thành phần trong sản phẩm</label>
                                                        <select name="ingredients[]" class="select2 form-control select2-multiple" multiple>
                                                            @if(count($ingredients) > 0)
                                                                @foreach($ingredients as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <div>
                                                                <label>Sản phẩm mới về</label>
                                                            </div>
                                                            <input type="checkbox" id="switch3" name="is_new" switch="none" {{old('is_new') ? 'checked' : ''}}/>
                                                            <label for="switch3" data-on-label="On" data-off-label="Off"></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div>
                                                                <label>Trạng thái</label>
                                                            </div>
                                                            <input type="checkbox" id="switch6" name="status" checked="true" switch="none" {{old('status') ? 'checked' : ''}}/>
                                                            <label for="switch6" data-on-label="On" data-off-label="Off"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <div>
                                                                <label>Sản phẩm yêu thích</label>
                                                            </div>
                                                            <input type="checkbox" id="switch2" name="is_favourite" switch="none" {{old('is_favourite') ? 'checked' : ''}}/>
                                                            <label for="switch2" data-on-label="On" data-off-label="Off"></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div>
                                                                <label>Sản phẩm bán chạy</label>
                                                            </div>
                                                            <input type="checkbox" id="switch1" name="featured" switch="none" {{old('featured') ? 'checked' : ''}}/>
                                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Hình ảnh đại diện (500px*480px) <span class="required">*</span></label>
                                                    <div id="image"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mô tả ngắn sản phẩm</label>
                                                    <textarea name="description" rows="5" class="form-control" required>{{old('description')}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Meta title</label>
                                                    <div>
                                                        <input value="{{old('meta_title')}}" type="text" class="form-control" name="meta_title"
                                                               placeholder="Thẻ tiêu đề">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Meta description</label>
                                                    <div>
                                                        <textarea name="meta_description" rows="5" class="form-control">{{old('meta_description')}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--Tab one-->
                                    <div id="tab-two" class="tab-pane fade">
                                        <div class="size-item" style="padding: 10px 15px">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Tiêu đề <span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="item[0][title]" value="{{ old('item[0][title]') }}"
                                                               placeholder="Tiêu đề" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Mã sản phẩm <span class="required">*</span></label>
                                                                <input type="text" class="form-control code-input" name="item[0][codes]" maxlength="20"
                                                                       value="{{ old('item[0][codes]') }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Số lượng <span class="required">*</span></label>
                                                                <input type="number" class="form-control" min="1" name="item[0][stocks]"
                                                                       value="{{ old('item[0][stocks]') }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Giá bán <span style="color: red;font-weight: bold">*</span></label>
                                                                <input type="text" class="form-control custom-mask price_size" name="item[0][prices]"
                                                                       minlength="2" maxlength="14" value="{{ old('item[0][prices]') }}"
                                                                       data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0"
                                                                       required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Giá sale</label>
                                                                <input type="text" class="form-control custom-mask sale_price_size" name="item[0][sale_prices]"
                                                                       minlength="2" maxlength="14" value="{{ old('item[0][sale_prices]') }}"
                                                                       data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Giảm giá(%)</label>
                                                                <input type="number" class="form-control discount" name="item[0][discounts]"
                                                                       value="{{ old('item[0][discounts]') }}"  disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label>Mặc định</label>
                                                            <input type="radio" class="size_show" name="size_show" checked>
                                                            <input type="hidden" class="get_show" name="item[0][get_show]" value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label class="">Hình ảnh sản phẩm theo kích thước (500px*480px) <span class="required">*</span></label>
                                                        <div class="row" id="size_photos_0"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="add-size-area">
                                            <button type="button" class="btn btn-purple addItemType" data-key="1">
                                                Thêm phân loại
                                            </button>
                                        </div>
                                    </div><!--Tab two-->

                                    <div id="tab-three" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="mt-2">Thông tin chung</label>
                                                    <textarea class="editor" name="content_prd">{{old('content_prd')}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="mt-2">Hướng dẫn sử dụng</label>
                                                    <textarea class="editor" name="txt_manual">{{old('txt_manual')}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--Tab three-->
                                    <div id="tab-four" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="mt-2">Công dụng sản phẩm</label>
                                                    <textarea class="editor" name="txt_uses">{{old('txt_uses')}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="mt-2">Thông số sản phẩm</label>
                                                    <textarea class="editor" name="txt_info">{{old('txt_info')}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="mt-2">Mô tả thành phần trong sản phẩm</label>
                                                    <textarea class="editor" name="txt_ingredient">{{old('txt_ingredient')}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--Tab four-->
                                </div>
                            </div>
                        </div><!--panel-body-->
                        <div class="panel-footer text-right">
                            <button type="submit" name="button" class="btn btn-info create-product-submit">Lưu</button>
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
    <script src="{{ asset('assets/js/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
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

            //image
            $("#image").spartanMultiImagePicker({
                fieldName: 'product_image',
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
            // img item size
            $("#size_photos_0").spartanMultiImagePicker({
                fieldName: 'item[0][photos][]',
                maxCount: 6,
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

            //handle sale price size
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

            // add prod item size
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

            // add size
            {{--$('body').on('click', '.add-size', function () {--}}
            {{--    let itemCk = '#sizeGroup'+ $(this).attr('data-item');--}}
            {{--    let item = $(this).attr('data-item');--}}
            {{--    let key = $(itemCk).find('div.p_size_item').length;--}}
            {{--    $.post("{{route('admin.products.append')}}", {_token:'{{ csrf_token() }}', 'key': key, 'item': item}, function (data) {--}}
            {{--        $(itemCk).append(data);--}}
            {{--    });--}}
            {{--    $(this).attr('data-key', parseInt(key) + 1);--}}
            {{--});--}}

            // click default show
            $(document).on("click", ".size-item .size_show", function(){
                $('.size-item').each(function () {
                    $('input.get_show').val(0);
                });
                $(this).parent().find("input.get_show").val(1);
            });

        });
        //
    </script>
@endsection
