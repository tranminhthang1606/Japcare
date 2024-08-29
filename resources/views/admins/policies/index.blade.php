@extends('admins.layouts.master')
@section('title', 'Cập nhật trang ' . ($policy->title_page ?: 'chính sách'))

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">Cập nhật trang: {{$policy->title_page ?: 'chính sách'}}</h4>
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
                    <form action="{{route('policies.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body">
                            <div class="tab-base tab-stacked-left">
                                <!--Nav tabs-->
                                <ul class="nav nav-tabs-custom">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab-one"
                                           aria-expanded="true">Tổng thể</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab-two"
                                           aria-expanded="false">Thẻ Meta</a>
                                    </li>
                                </ul>
                                <!--Tabs Content-->
                                <div class="tab-content">

                                    <div id="tab-one" class="tab-pane fade show active">
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="hidden" name="name" value="{{$policy->name}}">
                                                    <label class="control-label"><span style="color: red;font-weight: bold">*</span> Tiêu đề</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="title_page" required
                                                               value="{{old('title_page') ?: $policy->title_page}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label class="control-label">Nội dung</label>
                                                    <div>
                                                        <textarea id="content" class="editor"  name="content_policy">{{old('content_policy') ?: $policy->content}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tab-two" class="tab-pane fade">
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label class="control-label">Tiêu đề Meta</label>
                                                    <div>
                                                        <input type="text" class="form-control" value="{{old('meta_title') ?: $policy->meta_title}}" name="meta_title">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label class="control-label">Nội dung Meta</label>
                                                    <div>
                                                        <textarea class="form-control" name="meta_description" rows="10">{{old('meta_description') ?: $policy->meta_description}}</textarea>
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
            </div> <!-- end card -->
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
        });
    </script>
@endsection
