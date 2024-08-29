@extends('admins.layouts.master')
@section('title', 'Thêm mới popup')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Thêm mới popup
                        <a href="{{ route('popups.index') }}" class="btn btn-secondary waves-effect pull-right">Danh sách popup</a>
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
                    <form action="{{ route('popups.store' ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6 position_rel">
                                <div class="form-group">
                                    <label><strong class="text-danger">*</strong> Tiêu đề</label>
                                    <input value="{{old('title')}}" name="title" type="text" class="form-control" required placeholder="Tiêu đề" />
                                </div>
                                <div class="form-group">
                                    <label>Link liên kết</label>
                                    <input value="{{old('link_detail')}}" name="link_detail" type="text" class="form-control" placeholder="Link liên kết" />
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label>Trạng thái</label>
                                    </div>
                                    <input type="checkbox" id="switch1" name="status" switch="none" {{old('status') ? 'checked' : ''}} />
                                    <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div>
                                        <label id="label-img"><strong class="text-danger">*</strong> Ảnh</label>
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
                fieldName: 'pop_image',
                maxCount: 1,
                rowHeight: '250px',
                groupClassName: 'col-md-12',
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
@endsection

