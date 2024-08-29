@extends('admins.layouts.master')
@section('title', 'Chỉnh sửa thành phần')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Chỉnh sửa công dụng
                        <a href="{{ route('product_uses.index') }}" class="btn btn-secondary waves-effect
                        pull-right">Danh
                            sách công dụng</a>
                    </h4>

                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif
                    <form action="{{ route('product_uses.update',$productUses->id ) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6 position_rel">
                                <div class="form-group">
                                    <label>Công dụng</label>
                                    <input name="title" type="text" class="form-control" value="{{old
                                    ('title') ?: $productUses->title}}"/>
                                </div>
                                <div class="form-group">
                                    <label>Thành phần</label>
                                    <select name="description[]" class="select2 form-control select2-multiple"
                                            multiple>
                                        @foreach($ingredients as $item)
                                            @if(is_array(json_decode($productUses->description)) && in_array($item->id,
                                             json_decode($productUses->description)))
                                                <option value="{{ $item->id }}" selected>{{ $item->title }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label>Trạng thái</label>
                                    </div>
                                    <input type="checkbox" id="switch1" name="status"
                                           switch="none" {{old('status') ? 'checked' : ($productUses->status == 1 ? 'checked' : '') }}/>
                                    <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div>
                                        <label id="label-img"><strong class="text-danger">*</strong> Hình ảnh
                                            icon (80px*80px) </label>
                                    </div>
                                    <div id="wap_img">
                                        @if ($productUses-> icon_uses != null)
                                            <div class="col-md-12">
                                                <div class="img-upload-preview" style="height: 200px">
                                                    <img height="150px" src="{{ asset($productUses->icon_uses) }}" alt=""
                                                         class="img-responsive"/>
                                                    <button type="button" class="btn btn-danger close-btn remove-file">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="previous_photo"
                                                   value="{{ $productUses->icon_uses }}">
                                        @else
                                            <div id="image"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-5">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <!-- validation js -->
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('form').parsley();

            $("#image").spartanMultiImagePicker({
                fieldName: 'product_uses',
                maxCount: 1,
                rowHeight: '150px',
                groupClassName: 'col-md-12',
                maxFileSize: '6000',
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
                $(this).parents(".col-md-12").remove();
                $('#wap_img').append('<div id="image"></div>');
                $("#image").spartanMultiImagePicker({
                    fieldName: 'product_uses',
                    maxCount: 1,
                    rowHeight: '150px',
                    groupClassName: 'col-md-12',
                    maxFileSize: '6000',
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
        });
    </script>
@endsection
