@extends('admins.layouts.master')
@section('title', 'Danh sách danh mục con')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title m-b-15" style="display: table; width: 100%;">
                        <span>Danh mục con sản phẩm</span>
                        <a href="{{url('admin/subcategories/create')}}" class="btn btn-rounded btn-info pull-right">Thêm danh mục con mới</a>
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

                    <div class="panel-body">
                        <table id="subcategories" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="40px">ID</th>
                                    <th>Danh mục cha</th>
                                    <th>Tiêu đề</th>
                                    <th>Hình ảnh</th>
                                    <th width="80px">Nổi bật</th>
                                    <th width="80px">Menu</th>
                                    <th width="80px">Trạng thái</th>
                                    <th width="100px">Hành động</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(function () {
                var table = $('#subcategories').DataTable({
                    processing: true,
                    serverSide: true,
                    "order": [[ 5, "desc" ]],
                    ajax: "{{ url('admin/subcategories') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'category_title', name: 'category_title'},
                        {data: 'title', name: 'title'},
                        {data: 'image', name: 'image'},
                        {data: 'featured', name: 'featured'},
                        {data: 'is_menu', name: 'is_menu'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            });

        });
    </script>
@endsection
