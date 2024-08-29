{{--<div class="size-item" style="padding: 10px 15px">--}}
{{--    <button type="button" class="btn btn-danger close-color-button closeColorAdd">X</button>--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-3">--}}
{{--            <div class="form-group">--}}
{{--                <label>Màu sắc <span class="required">*</span></label>--}}
{{--                <select class="form-control" name="item[{{$key}}][color_id]" required>--}}
{{--                    <option value="">Lựa màu sắc</option>--}}
{{--                    @foreach($colors as $color)--}}
{{--                        <option value="{{$color->id}}">{{$color->title}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label>Mặc định</label> &nbsp;--}}
{{--                <input type="radio" class="color_show" name="color_show">--}}
{{--                <input type="hidden" class="get_show" name="item[{{$key}}][get_show]" value="0">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-9">--}}
{{--            <div class="form-group">--}}
{{--                <label>Hình ảnh sản phẩm theo màu (760px*760px) <span class="required">*</span></label>--}}
{{--                <div class="row" id="color_photos_{{$key}}"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group" id="sizeGroup{{$key}}">--}}
{{--        <label class="w-100 border_b">Màu sắc sản phẩm theo kích thước</label>--}}
{{--        <div class="p_size_item">--}}
{{--            <button type="button" class="btn btn-danger close-size-button closeSizeAdd">X</button>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-3">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Kích thước <span class="required">*</span></label>--}}
{{--                        <select class="form-control" name="item[{{$key}}][sizes][0][size_titles]" required>--}}
{{--                            <option value="">Lựa chọn kích thước</option>--}}
{{--                            @foreach(config("sizes") as $k => $v)--}}
{{--                                <option value="{{$k}}">{{$v}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-3">--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Mã sản phẩm <span class="required">*</span></label>--}}
{{--                            <input type="text" class="form-control code-input" name="item[{{$key}}][sizes][0][codes]" maxlength="20" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-sm-3">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Số lượng <span class="required">*</span></label>--}}
{{--                        <input type="number" class="form-control" name="item[{{$key}}][sizes][0][stocks]" required>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-12">--}}
{{--            <div class="add_color_item">--}}
{{--                <button type="button" class="btn btn-lime pull-right add-size" data-key="{{$key + 1}}" data-item="{{$key}}">--}}
{{--                    Thêm kích thước--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="size-item" style="padding: 10px 15px">
    <button type="button" class="btn btn-danger close-color-button closeSizeAdd">X</button>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Tiêu đề <span class="required">*</span></label>
                <input type="text" class="form-control"  name="item[{{$key}}][title]" required>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Mã sản phẩm <span class="required">*</span></label>
                        <input type="text" class="form-control code-input" name="item[{{$key}}][codes]" maxlength="20" required>
                    </div>
                    <div class="col-md-6">
                        <label>Số lượng <span class="required">*</span></label>
                        <input type="number" min="1" class="form-control" name="item[{{$key}}][stocks]" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Giá bán <span style="color: red;font-weight: bold">*</span></label>
                        <input type="text" class="form-control custom-mask price_size" name="item[{{$key}}][prices]"
                               minlength="2" maxlength="14"
                               data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0"
                               required>
                    </div>
                    <div class="col-md-4">
                        <label>Giá sale</label>
                        <input type="text" class="form-control custom-mask sale_price_size" name="item[{{$key}}][sale_prices]"
                               minlength="2" maxlength="14"
                               data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0">
                    </div>
                    <div class="col-md-4">
                        <label>Giảm giá(%)</label>
                        <input type="number" class="form-control discount" name="item[{{$key}}][discounts]" disabled>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label>Mặc định</label>
                    <input type="radio" class="size_show" name="size_show">
                    <input type="hidden" class="get_show" name="item[{{$key}}][get_show]" value="0">
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group">
                <label class="">Hình ảnh sản phẩm theo kích thước (500px*480px)</label>
                <div class="row" id="size_photos_{{$key}}"></div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".custom-mask").inputmask({
            'alias': 'numeric', allowMinus: false
        });

        $("#size_photos_{{$key}}").spartanMultiImagePicker({
            fieldName: 'item[{{$key}}][photos][]',
            maxCount: 1,
            rowHeight: '150px',
            groupClassName: 'col-md-3',
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
