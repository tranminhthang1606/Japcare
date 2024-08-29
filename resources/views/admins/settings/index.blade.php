@extends('admins.layouts.master')
@section('title', 'Settings')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">Cài đặt hệ thống</h4>
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
                    <div class="setting_wap" >
                        <form action="{{ route('settings.update',$settings->id ) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="panel-body">
                                <div class="tab-base tab-stacked-left">
                                    <!--Nav tabs-->
                                    <ul class="nav nav-tabs-custom">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tab-one" aria-expanded="true">Tổng thể</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab-two" aria-expanded="false">Nội dung chân trang</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab-three" aria-expanded="true">Thông tin chung</a>
                                        </li>
                                    </ul>
                                    <!--Tabs Content-->
                                    <div class="tab-content" style="margin-top: 15px">
                                        <div id="tab-one" class="tab-pane fade show active">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Tên trang web</label>
                                                        <div class="col-sm-9">
                                                            <input name="st_name_site" type="text" class="form-control" value="{{$settings->st_name_site}}" placeholder="Tên trang web" required/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Hotline 1</label>
                                                        <div class="col-sm-9">
                                                            <input name="phone" type="text" class="form-control" value="{{$settings->phone}}" placeholder="Hotline 1" required/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Hotline 2</label>
                                                        <div class="col-sm-9">
                                                            <input name="hotline" type="text" class="form-control" value="{{$settings->hotline}}" placeholder="Hotline 2" required/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Email</label>
                                                        <div class="col-sm-9">
                                                            <input name="email" type="text" class="form-control" value="{{$settings->email}}" placeholder="Email" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Địa chỉ</label>
                                                        <div class="col-sm-9">
                                                            <input name="address" type="text" class="form-control" value="{{$settings->address}}" placeholder="Địa chỉ" required/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Link website</label>
                                                        <div class="col-sm-9">
                                                            <input name="url_website" type="text" class="form-control" value="{{$settings->url_website}}" placeholder="Link website" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Link Facebook</label>
                                                        <div class="col-sm-9">
                                                            <input name="facebook" type="text" class="form-control" value="{{$settings->facebook}}" placeholder="Link Facebook" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Link Tiktok</label>
                                                        <div class="col-sm-9">
                                                            <input name="tiktok" type="text" class="form-control" value="{{$settings->tiktok}}" placeholder="Link Tiktok" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Link Shopee</label>
                                                        <div class="col-sm-9">
                                                            <input name="shopee" type="text" class="form-control" value="{{$settings->shopee}}" placeholder="Link Shopee" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Link Instagram</label>
                                                        <div class="col-sm-9">
                                                            <input name="instagram" type="text" class="form-control" value="{{$settings->instagram}}" placeholder="Link Instagram" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Link Youtube</label>
                                                        <div class="col-sm-9">
                                                            <input name="youtube" type="text" class="form-control" value="{{$settings->youtube ?? ''}}" placeholder="Link Youtube" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Thời gian làm việc</label>
                                                        <div class="col-sm-9">
                                                            <input name="working_time" type="text" class="form-control" value="{{$settings->working_time ?? ''}}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="form-group col-4">
                                                            <label>Logo giao diện (height 75px)</label>
                                                            <div id="wap_img_st_logo">
                                                                @if ($settings->st_logo != null)
                                                                    <div class="logo_top">
                                                                        <div class="img-upload-preview" style="height: 200px">
                                                                            <img height="200px" src="{{ asset($settings->st_logo) }}" alt="" class="img-responsive"/>
                                                                            <button type="button" class="btn btn-danger close-btn remove-file-st-logo">
                                                                                <i class="fa fa-times"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="prv_st_logo" value="{{ $settings->st_logo }}">
                                                                @else
                                                                    <div id="image_st_logo"></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4">
                                                            <label>Logo footer (200px * 200px)</label>
                                                            <div id="wap_img_admin_logo">
                                                                @if ($settings->admin_logo != null)
                                                                    <div class="logo_footer">
                                                                        <div class="img-upload-preview" style="height: 200px">
                                                                            <img height="200px" src="{{ asset($settings->admin_logo) }}" alt="" class="img-responsive"/>
                                                                            <button type="button" class="btn btn-danger close-btn remove-file-admin-logo">
                                                                                <i class="fa fa-times"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="prv_admin_logo" value="{{ $settings->admin_logo }}">
                                                                @else
                                                                    <div id="image_admin_logo"></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-4">
                                                            <label>Logo favicon (32px * 32px)</label>
                                                            <div id="wap_img_favicon">
                                                                @if ($settings->favicon != null)
                                                                    <div class="favicon_site">
                                                                        <div class="img-upload-preview" style="height: 200px">
                                                                            <img height="200px" src="{{ asset($settings->favicon) }}" alt="" class="img-responsive"/>
                                                                            <button type="button" class="btn btn-danger close-btn remove-file-favicon">
                                                                                <i class="fa fa-times"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="prv_favicon" value="{{ $settings->favicon }}">
                                                                @else
                                                                    <div id="image_favicon"></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="tab-two" class="tab-pane fade">
                                            <div class="row mt-10">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Copyright</label>
                                                        <div>
                                                            <textarea class="form-control" name="copyright" rows="10">{{$settings->copyright}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tiêu đề Meta</label>
                                                        <input type="text" class="form-control" value="{{$settings->meta_keywords}}" name="meta_title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Nội dung Meta</label>
                                                        <div>
                                                            <textarea class="form-control" name="meta_description" rows="10">{{$settings->meta_description}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="tab-three" class="tab-pane fade">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="ship_block_area">
                                                        <label class="control-label">Dịch vụ chăm sóc khách hàng</label>
                                                        @if(isset($settings->customer_service))
                                                            @php
                                                                $services = json_decode($settings->customer_service);
                                                            @endphp
                                                            @foreach($services as $index => $service)
                                                                <div class="ship_block_item">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label>Icon </label>
                                                                                @if(isset($service->service_img))
                                                                                    <div>
                                                                                        <img src="{{asset($service->service_img)}}" alt="" style="max-height: 50px;"/>
                                                                                    </div>
                                                                                @endif
                                                                                <input name="service_img[]" type="file" class="form-control-file" accept="image/*"/>
                                                                                <input type="hidden" name="current_service_img[]" value="{{$service->service_img ?? ''}}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6 d-flex align-items-center justify-content-end">
                                                                            <button type="button" name="button" class="btn btn-danger ship_block_item-close-btn">X</button>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label>Tiêu đề <span style="color: red;font-weight: bold">*</span></label>
                                                                                <input name="service_title[]" type="text" class="form-control"
                                                                                       value="{{$service->service_title ?? ''}}" required/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label>Nội dung<span style="color: red;font-weight: bold">*</span></label>
                                                                                <input name="service_content[]" type="text" class="form-control"
                                                                                       value="{{$service->service_content ?? ''}}" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr/>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="panel-footer text-left">
                                                        <button type="button" name="button" class="btn btn-success ship_block_item-add-btn">Thêm dịch vụ</button>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Hướng dẫn chuyển khoản</label>
                                                        <div>
                                                            <textarea class="form-control" name="bank_transfer_guide" rows="10">{{$settings->bank_transfer_guide}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <button type="submit" name="button" class="btn btn-info">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <img id="img_detail" src="{{ asset($settings->banner_top) }}" alt="img show"/>
                </div>
            </div>
        </div>
    </div><!-- end myModal -->
@endsection
@section('bottom_script')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <!-- validation js -->
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('form').parsley();
            try {
                CKEDITOR.instances['copyright'].destroy(true);
                CKEDITOR.instances['bank_transfer_guide'].destroy(true);
            } catch (e) {
            }
            CKEDITOR.replace('copyright', {
                filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('bank_transfer_guide', {
                filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });

            // logo top
            $("#st_logo").spartanMultiImagePicker({
                fieldName: 'st_logo',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'logo_top',
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
            $('.remove-file-st-logo').on('click', function () {
                $(this).parents(".logo_top").remove();
                $('#wap_img_st_logo').append('<div id="image_st_logo"></div>');
                $("#image_st_logo").spartanMultiImagePicker({
                    fieldName: 'st_logo',
                    maxCount: 1,
                    rowHeight: '150px',
                    groupClassName: 'logo_top',
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
            // end logo top
            // logo footer
            $("#admin_logo").spartanMultiImagePicker({
                fieldName: 'admin_logo',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'logo_footer',
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
            $('.remove-file-admin-logo').on('click', function () {
                $(this).parents(".logo_footer").remove();
                $('#wap_img_admin_logo').append('<div id="image_admin_logo"></div>');
                $("#image_admin_logo").spartanMultiImagePicker({
                    fieldName: 'admin_logo',
                    maxCount: 1,
                    rowHeight: '150px',
                    groupClassName: 'logo_footer',
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
            // end logo footer
            //favicon
            $("#favicon").spartanMultiImagePicker({
                fieldName: 'favicon',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'col-12',
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
            $('.remove-file-favicon').on('click', function () {
                $(this).parents(".favicon_site").remove();
                $('#wap_img_favicon').append('<div id="image_favicon"></div>');
                $("#image_favicon").spartanMultiImagePicker({
                    fieldName: 'favicon',
                    maxCount: 1,
                    rowHeight: '150px',
                    groupClassName: 'favicon_site',
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
            // end favicon
            $('.img-upload-preview').on('click', function (){
                let urlImg = $(this).find('img.img-responsive').attr('src');
                $('.modal-body #img_detail').attr('src', urlImg);
                $('#myModal').modal();
            });

            //
            $('.remove-file-image-service').on('click', function () {
                $(this).parents(".col-md-3").remove();
            });


            $(".ship_block_item-add-btn").on("click", function () {
                let html = `<div class="ship_block_item">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Icon <span style="color: red;font-weight: bold">*</span></label>
                                    <input name="service_img[]" type="file" class="form-control-file" accept="image/*" required/>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex align-items-center justify-content-end">
                                <button type="button" name="button" class="btn btn-danger ship_block_item-close-btn">X</button>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tiêu đề <span style="color: red;font-weight: bold">*</span></label>
                                    <input name="service_title[]" type="text" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nội dung <span style="color: red;font-weight: bold">*</span></label>
                                    <input name="service_content[]" type="text" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>`;
                $(".ship_block_area").append(html);
            });
            $(document).on("click", ".ship_block_item-close-btn", function () {
                $(this).closest('.ship_block_item').remove();
            });

        });
    </script>
@endsection
