@extends('admins.layouts.master')
@section('title', 'Roles list')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Danh sách quyền
                        <a href="{{ url('/admin/roles/create') }}" class="btn btn-info waves-effect pull-right">Thêm quyền</a>
                    </h4>

                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif

                    <table id="adv_table" class="table table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 30px;">ID</th>
                                <th>Tên quyền</th>
                                <th style="width: 120px;">Ngày tạo</th>
                                <th style="width: 80px;">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if( isset($roles) && count($roles) == 0)
                            <tr>
                                <td colspan="3" class="dataTables_empty">No data</td>
                            </tr>
                        @else
                            @foreach($roles as $key => $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{$item->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('/admin/roles/' . $item->id ) . '/edit'}}">
                                            <span class="badge badge-brown"><i class="fa fa-pencil"></i></span>
                                        </a>
                                        <form method="POST" action="/admin/roles/{{$item->id}}" style="display: inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="boder_none">
                                                <span class="badge badge-danger delete_bt"><i class="dripicons-cross"></i></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div><!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#adv_table').DataTable({
                "order": [[1, "desc"]]
            });
            //
            $('.delete_bt').click(function (e) {
                e.preventDefault() // Don't post the form, unless confirmed
                if (confirm('Are you sure delete?')) {
                    // Post the form
                    $(e.target).closest('form').submit() // Post the surrounding form
                }
            });
        });
    </script>
@endsection
