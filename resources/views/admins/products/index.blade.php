@extends('admins.layouts.master')
@section('title', 'Product list')

@section('content')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="header-title mb-2 border_b" style="display: table; width: 100%;">
                        <span>Danh sách sản phẩm</span>
                        <a href="{{url('admin/products/create')}}" class="btn btn-rounded btn-dark pull-right">
                            Thêm sản phẩm mới
                        </a>
                    </h4>
                    <div class="find_wap">
                        <form action="{{url('admin/products/')}}" method="get">
                            @csrf
                            <div class="row" style="margin-bottom: 15px">
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-bottom: 15px">
                                        <div class="d-inline-flex w-100">
                                            <div style="width: 35%;">
                                                <select class="form-control" name="product_show" id="product_show">
                                                    <option value="20" @if(isset($limit) && $limit == 20) selected @endif>
                                                        Hiển thị 20
                                                    </option>
                                                    <option value="50" @if(isset($limit) && $limit == 50) selected @endif>
                                                        Hiển thị 50
                                                    </option>
                                                    <option value="100" @if(isset($limit) && $limit == 100) selected @endif>
                                                        Hiển thị 100
                                                    </option>
                                                    <option value="200" @if(isset($limit) && $limit == 200) selected @endif>
                                                        Hiển thị 200
                                                    </option>
                                                </select>
                                            </div>
                                            <div style="width: 65%; margin-left: 8px">
                                                <input class="form-control" type="search" name="keyword" placeholder="Tìm tên sản phẩm"
                                                       value="@if(request('keyword')) {{request('keyword')}} @endif" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control select2" name="product_category">
                                            <option value="">Lọc theo danh mục</option>
                                            @foreach ($allCategories as $category)
                                                <option value="{{ $category->id }}" data-parent="{{ $category->parent_id }}" {{old('product_category') == $category->id ? 'selected' : ''}} >
                                                    {{ $category->title }}
                                                </option>
                                                @if (count($category->children) > 0)
                                                    @include('admins.inc.subcategories',['children' => $category->children, 'parent' => '-'])
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" style="margin-bottom: 15px">
                                        <select class="form-control select2" name="product_brand">
                                            <option value="">Lọc theo thương hiệu</option>
                                            @foreach($allBrands as $brand)
                                                <option value="{{$brand->id}}" @if(request('product_brand') == $brand->id) selected @endif>{{$brand->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="product_status">
                                            <option value="">Lọc trạng thái</option>
                                            <option value="1" @if(request('product_status') == 1) selected @endif>Hoạt động</option>
                                            <option value="2" @if(request('product_status') == 2) selected @endif>Đã khóa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="flex-style">
                                        <div class="flex-basis-50">
                                            <label>Sản phẩm mới về</label>
                                            <div>
                                                <input type="checkbox" id="switch1" name="product_is_new"
                                                       switch="none" {{request('product_is_new') ? 'checked' : ''}}/>
                                                <label for="switch1" data-on-label="On" data-off-label="Off" style="margin-bottom: 0"></label>
                                            </div>
                                        </div>
                                        <div class="flex-basis-50">
                                            <label>Yêu thích</label>
                                            <div>
                                                <input type="checkbox" id="switch2" name="product_is_favourite"
                                                       switch="none" {{request('product_is_favourite') ? 'checked' : ''}}/>
                                                <label for="switch2" data-on-label="On" data-off-label="Off" style="margin-bottom: 0"></label>
                                            </div>
                                        </div>
                                        <div class="flex-basis-50">
                                            <label>Bán chạy</label>
                                            <div>
                                                <input type="checkbox" id="switch3" name="product_featured"
                                                       switch="none" {{request('product_featured') ? 'checked' : ''}}/>
                                                <label for="switch3" data-on-label="On" data-off-label="Off" style="margin-bottom: 0"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2" style="text-align: right">
                                    <div class="form-group">
                                        <a href="{{url('admin/products')}}" class="btn btn-blue-grey">
                                            Hủy lọc
                                        </a>
                                    </div>
                                    <div class="form-group" style="margin-top: 15px">
                                        <button type="submit" class="btn btn-info">
                                            Lọc
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
                    <div class="table-rep-plugin">
                        <div class="table table-bordered table-responsive" data-pattern="priority-columns">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px">ID</th>
                                        <th>Tên sản phẩm</th>
                                        <th style="width: 250px">Danh mục/ Thương hiệu</th>
                                        <th class="text-center" style="width: 150px">Ảnh đại diện</th>
                                        <th class="text-center" style="width: 130px">Trạng thái</th>
                                        <th class="text-center" style="width: 130px">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($products) > 0)
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="text-center">{{$product->id}}</td>
                                            <td>
                                                <p class="mb-2">
                                                    <a href="{{ route('products.edit', $product->id) }}">
                                                        {{ Illuminate\Support\Str::of($product->title)->words(15, ' ...') }}
                                                    </a>
                                                </p>
                                                <p class="mb-2">
                                                    @if($product->is_new == 1)
                                                        <span class="badge badge-info">Sản phẩm mới</span>
                                                    @endif
                                                    @if($product->is_favourite == 1)
                                                        <span class="badge badge-purple">Yêu thích</span>
                                                    @endif
                                                    @if($product->featured == 1)
                                                        <span class="badge badge-pink">Bán chạy</span>
                                                    @endif
                                                </p>
                                                <p class="mb-0">Số kích thước: {{count($product->productSizes)}}</p>
                                            </td>
                                            <td>
                                                <p title="Danh mục" class="mb-1">
                                                    <b>Danh mục:</b> {{ $product->category->title ? Illuminate\Support\Str::of($product->category->title)->words(10, '...') : ''}}
                                                </p>
                                                <p title="Thương hiệu" class="mb-0">
                                                    {{ $product->brand->title ? Illuminate\Support\Str::of($product->brand->title)->words(10, '...') : ''}}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('products.edit', $product->id) }}">
                                                    <img src="{{asset($product->featured_img)}}" alt="product_img" style="max-height: 90px">
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                @if($product->status != 1)
                                                    <span class="badge badge-danger">Đã khóa</span>
                                                @else
                                                    <span class="badge badge-success">Hoạt động</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('products.edit', $product->id) }}">
                                                    <span class="badge badge-brown" data-toggle="tooltip" data-placement="top" title="Sửa sản phẩm">
                                                        <i class="fa fa-pencil"></i>
                                                    </span>
                                                </a> &nbsp;
                                                <form method="POST" action="{{route('products.delete_product_subm', $product->id)}}" style="display: inline">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="boder_none delete_item">
                                                        <span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Xóa sản phẩm">
                                                            <i class="ion ion-close"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">Không có dữ liệu</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <div class="row mt-3">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info">
                                        Tổng {{$products->total()}} SP
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="pull-right">
                                        @if(count($products) > 0)
                                            {{ $products->appends(request()->query())->render('admins.inc.pagination') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!--end card -->
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
@endsection
@section('bottom_script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.delete_item').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Bạn có chắc muốn xóa?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có',
                    cancelButtonText: 'Không xóa'
                }).then( function (isConfirm) {
                    if (isConfirm && isConfirm.value) {
                        $(e.target).closest('form').submit();
                    }
                });
            });
        });
    </script>
@endsection
