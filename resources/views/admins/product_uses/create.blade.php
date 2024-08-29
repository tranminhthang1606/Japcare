@extends('admins.layouts.master')
@section('title', 'Thêm mới ProductUse')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thêm mới công dụng
                        <a href="{{ route('product_uses.index') }}" class="btn btn-secondary waves-effect
                        pull-right">Danh sách công dụng</a>
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
                    <form action="{{ route('product_uses.store' ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6 position_rel">
                                <div class="form-group">
                                    <label>Công dụng</label>
                                    <input name="title" type="text" value="{{old('title')}}"
                                           class="form-control" placeholder="Nhập mô tả..."/>
                                </div>
                                <label> <strong class="text-danger">*</strong> Thành phần</label>
                                <select name="description[]" class="select2 form-control select2-multiple"
                                        multiple>
                                    @foreach($ingredients as $item)
                                        <option value="{{ $item->id }}">{{ $item->title}}</option>
                                    @endforeach
                                </select>
                                <div class="form-group">
                                    <div>
                                        <label>Trạng thái</label>
                                    </div>
                                    <input type="checkbox" id="switch1" name="status"
                                           switch="none" {{old('status') ? 'checked' : ''}} />
                                    <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div>
                                        <label id="label-img"><strong class="text-danger">*</strong> Hình ảnh
                                            icon (80px*80px)</label>
                                    </div>
                                    <div class="row" id="image"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-5">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- end card body -->
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
                rowHeight: '250px',
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
    </script>
@endsection

