@extends('admins.layouts.master')
@section('title', 'Sửa phí vận chuyển')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Sửa phí vận chuyển
                        <a href="{{ url('admin/delivery_fees') }}" class="btn btn-rounded btn-secondary pull-right">
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
                    <form id="edit_form" action="{{route('delivery_fees.edit', $fee->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body">
                            <div class="tab-base tab-stacked-left">
                                <div class="row">
                                    <div class="col-sm-4 offset-sm-4">
                                        <div class="form-group">
                                            <label class="control-label"><strong class="text-danger">*</strong>
                                                Tỉnh/Thành phố
                                            </label>
                                            <select class="form-control demo-select2-placeholder" name="matp" disabled>
                                                <option value="">Lựa chọn Tỉnh/Thành phố</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{$province->matp}}" @if($fee->matp == $province->matp) selected @endif>{{$province->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 offset-sm-4">
                                        <div class="form-group">
                                            <label class="control-label"><strong class="text-danger">*</strong>
                                                Phí vận chuyển
                                            </label>
                                            <input name="fee" type="text"
                                               minlength="1" maxlength="14"
                                               class="form-control custom-mask price"
                                               data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0"
                                               value="{{ old('fee') ?: $fee->fee }}"
                                               required
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-center">
                                <button id="edit_submit" type="button" class="btn btn-primary waves-effect waves-light m-r-5">
                                    Sửa
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">
                                    Huỷ
                                </button>
                            </div>
                        </div><!-- panel body -->
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <!-- validation js -->
    <script src="{{ asset('assets/js/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            $('form').parsley();
            $(".custom-mask").inputmask({
                'alias': 'numeric', allowMinus: false
            });

            $('#edit_submit').on('click', function () {
                let form = $('#edit_form');
                form.parsley().validate();
                if (form.parsley().isValid()) {
                    $('#edit_submit').prop('disabled', true)
                    form.submit();
                }
            });
        });
    </script>
@endsection
