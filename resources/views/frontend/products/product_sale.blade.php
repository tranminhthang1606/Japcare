@extends('frontend.layouts.master')
@section('title','Product sale')
@section('bottom_style')
    <link rel="stylesheet" href="{{asset('frontend/css/filter_loader.css')}}">
@endsection
@section('content')
    <!-- main start -->
    <main id="main" class="site-main" role="main">
        <div id="filter_loader"><div id="status"><div class="filter_spinner"></div></div></div>
        <header class="container accessory-products-header">
            <h1 class="accessory-products-header__title page-title heading">
                <span>
                    @if(isset($category))
                        {{$category->title}}
                    @else
                        @if(isset($tit_show_cat) && $tit_show_cat != null)
                            {{$tit_show_cat}}
                        @elseif(request('keyword'))
                            Kết quả tìm kiếm
                        @else
                            Sản phẩm
                        @endif
                    @endif
                </span>
            </h1>
        </header>
        @if(request('keyword'))
            <div class="null_style">
                <h3>Từ khóa tìm kiếm "{{request('keyword')}}"!</h3>
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 side_bar-product">
                    <div class="show_filter-wrap">
                        <span>Bộ lọc sản phẩm</span>
                        <div><i class="fa-solid fa-chevron-down"></i></div>
                    </div>
                    <div class="filter_wrap">
                        <div class="product_price">
                            <div class="ti_wrap-price">
                                <span class="side_product-title">Giá sản phẩm</span>
                                <i class="fa-solid fa-minus"></i>
                            </div>
                            <div class="filter_prices">
                                <div class="price">
                                    <input id="data-price-1" type="checkbox" name="price_filter" value="0-100000">
                                    <label for="data-price-1">Dưới 100,000đ</label>
                                </div>
                                <div class="price">
                                    <input id="data-price-2" type="checkbox" name="price_filter" value="100000-200000">
                                    <label for="data-price-2">100,000đ - 200,000đ</label>
                                </div>
                                <div class="price">
                                    <input id="data-price-3" type="checkbox" name="price_filter" value="200000-350000">
                                    <label for="data-price-3">200,000đ - 350,000đ</label>
                                </div>
                                <div class="price">
                                    <input id="data-price-4" type="checkbox" name="price_filter" value="350000-500000">
                                    <label for="data-price-4">350,000đ - 500,000đ</label>
                                </div>
                                <div class="price">
                                    <input id="data-price-5" type="checkbox" name="price_filter" value="500000-5000000000">
                                    <label for="data-price-5">Trên 500,000đ</label>
                                </div>

                            </div>
                        </div>
                        <div class="product_color">
                            <div class="ti_wrap-color">
                                <span class="side_product-title">Màu sắc</span>
                                <i class="fa-solid fa-minus"></i>
                            </div>
                            <div class="filter_colors">
                                @foreach($productColors as $productColor)
                                    <div class="color" title="{{$productColor->title}}">
                                        <input id="data-color-{{$productColor->id}}" type="checkbox" value="{{$productColor->id}}" name="color_filter">
                                        <label style="background-color: {{$productColor->color_code}};" for="data-color-{{$productColor->id}}"></label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="product_size">
                            <div class="ti_wrap-size">
                                <span class="side_product-title">Kích thước</span>
                                <i class="fa-solid fa-minus"></i>
                            </div>
                            <div class="filter_sizes">
                                @foreach(config('sizes') as $kSize => $vSize)
                                    <div class="size">
                                        <input id="data-size-{{$kSize}}" type="checkbox" value="{{$kSize}}" name="size_filter">
                                        <label for="data-size-{{$kSize}}">{{$vSize}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($sale_products) > 0)
                    <div class="col-lg-9 col-md-12 all_product">
                        <div class="all_product-heading">
                            <h2>Tất cả sản phẩm</h2>
                            <div class="sort_product">
                                <select name="sort_filter" id="sort_filter">
                                    <option value="latest">Mới nhất</option>
                                    <option value="oldest">Cũ nhất</option>
                                    <option value="price_asc">Giá: Tăng dần</option>
                                    <option value="price_desc">Giá: Giảm dần</option>
                                    <option value="a_z">Tên: A-Z</option>
                                    <option value="z_a">Tên: Z-A</option>
                                </select>
                            </div>
                        </div>
                        <div id="product_result">
                            <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
                                @foreach($sale_products as $prd)
                                    @include('frontend.products.item', $prd)
                                @endforeach
                            </div>
                            @include('frontend.inc.pagination_ajax', $paginationPage)
                        </div>
                    </div>
                @elseif(request('keyword'))
                    <div class="null_style">
                        <h4>Không có kết quả nào, vui lòng thay đổi từ khóa.</h4>
                        <a class="btn_buy btn_add_cart" href="{{ route('home') }}">Quay lại trang chủ</a>
                    </div>
                @else
                    <div class="null_style">
                        <h3>Sản phẩm đang được cập nhật!</h3>
                        <h4>Rất xin lỗi quý Khách vì sự bất tiện này.</h4>
                        <a class="btn_buy btn_add_cart" href="{{ route('home') }}">Quay lại trang chủ</a>
                    </div>
                @endif
            </div>

        </div>

    </main>
    <script>
        (function ($) {
            $(document).ready(function () {
                $("ul.dropdown-menu [data-toggle=dropdown]").on("click", function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    $(this).parent().siblings().removeClass("open");
                    $(this).parent().toggleClass("open");
                });
                $(`input[name="price_filter"]`).on("change", function () {
                    filterProducts();
                })
                $(`input[name="color_filter"]`).on("change", function () {
                    filterProducts();
                })
                $(`input[name="size_filter"]`).on("change", function () {
                    filterProducts();
                })
                $(`select[name="sort_filter"]`).on("change", function () {
                    filterProducts();
                })
                $(document).on("click", `.pagination .page-item a`, function (){
                    const page_filter = $(this).attr("data-value");
                    if (page_filter) filterProducts(page_filter);
                })
            });

            function filterProducts(page_filter = 1) {
                $('#filter_loader').show();
                $('#filter_loader #status').show();
                let price_filter = [];
                $(`input[name="price_filter"]:checked`).each(function(i){
                    price_filter[i] = $(this).val();
                });
                let color_filter = [];
                $(`input[name="color_filter"]:checked`).each(function(i){
                    color_filter[i] = $(this).val();
                });
                let size_filter = [];
                $(`input[name="size_filter"]:checked`).each(function(i){
                    size_filter[i] = $(this).val();
                });
                const sort_filter = $(`select[name="sort_filter"]`).val();
                const keyword = '{{request('keyword')}}';
                $.get("{{route('productSale_filter_result')}}", {price_filter, color_filter, size_filter, sort_filter, page_filter, keyword}, function (data) {

                    $('#product_result').html(data);
                    $('#filter_loader').hide();
                    $('#filter_loader #status').hide();
                });
            }
        })(jQuery);
    </script>
@endsection
