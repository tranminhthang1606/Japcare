@extends('admins.layouts.master')
@section('title', 'Danh sách sản phẩm đã xem của khách hàng')

<!-- Basic Data Tables -->
@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title border_b">
                        Danh sách sản phẩm đã xem của khách hàng
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
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Tên khách hàng: </label>
                            <span>{{$customer->user->name}}</span>
                        </div>
                        <div class="col-sm-4">
                            <label>Số điện thoại: </label>
                            <span>{{$customer->user->phone}}</span>
                        </div>
                        <div class="col-sm-4">
                            <label>Email: </label>
                            <span>{{$customer->user->email}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Địa chỉ: </label>
                            @foreach($customer->customersAddress as $addr)
                                @if($addr->is_default == 1)
                                    <span>{{$addr->address}}</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <table id="viewed_products_table" class="table table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th width="50px">ID</th>
                                <th width="100px">Danh mục</th>
                                <th width="80px">Thương hiệu</th>
                                <th>Tên sản phẩm</th>
                                <th width="100px">Ảnh đại diện</th>
                                <th width="50px">Nổi bật</th>
                                <th width="50px">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($data) == 0)
                            <tr>
                                <td colspan="6" class="dataTables_empty">No data</td>
                            </tr>
                        @endif
                        @foreach($data as $key => $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{($category = \App\Models\Category::find($product->category_id)) ? $category->title : ''}}</td>
                                <td>{{($brand = \App\Models\Brand::find($product->brand_id)) ? $brand->title : ''}}</td>
                                <td>{{$product->title}}</td>
                                <td>
                                    <img src="{{asset($product->featured_img)}}" height="50px" alt="product" />
                                </td>
                                <td>
                                    @if($product->featured == 1)
                                        <span class="badge badge-primary">Active</span>
                                    @else
                                        <span class="badge badge-warning">Block</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->status == 1)
                                        <span class="badge badge-primary">Active</span>
                                    @else
                                        <span class="badge badge-warning">Block</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div> <!-- end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#viewed_products_table').DataTable({
                "order": [[ 20, "desc" ]]
            });
        });
    </script>
@endsection
