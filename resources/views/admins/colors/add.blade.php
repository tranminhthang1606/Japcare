@extends('admins.layouts.master')
@section('title', 'Thêm màu sắc')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thêm  màu sắc
                        <a href="{{ url('admin/colors') }}" class="btn btn-rounded btn-secondary pull-right">
                            Danh sách
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
                    <form id="create_form" action="{{ route('colors.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body">
                            <div class="tab-base tab-stacked-left">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Tên màu sắc <strong class="text-danger">*</strong>
                                            </label>
                                            <input name="title" class="form-control" value="{{ old('title') }}" required/>
                                        </div>
                                        <div class="form-group m-b-0">
                                            <label>Chọn mã màu <strong class="text-danger">*</strong></label>
                                            <input type="text" class="colorpicker-default form-control" name="color_code" value="{{ old('color_code') }}">
                                            <div id="color_display" class="mt-2" style="width: 75px; height: 75px"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="control-label"> Mô tả</label>
                                            <textarea class="form-control" rows="5" name="description">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button id="create_submit" type="button" class="btn btn-primary waves-effect waves-light m-r-5">
                                    Thêm mã màu
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">Huỷ</button>
                            </div>
                        </div><!-- panel body -->
                    </form>
                </div>
            </div><!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <!-- validation js -->
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            $('form').parsley();

            const color_display = $(`input[name="color_code"]`);
            if (color_display.val()) $("#color_display").css("background-color", color_display.val());
            color_display.on("change", function () {
                $("#color_display").css("background-color", color_display.val())
            })

            $('#create_submit').on('click', function () {
                let form = $('#create_form');
                form.parsley().validate();
                if (form.parsley().isValid()) {
                    $('#create_submit').prop('disabled', true)
                    form.submit();
                }
            });
        });
    </script>
@endsection
