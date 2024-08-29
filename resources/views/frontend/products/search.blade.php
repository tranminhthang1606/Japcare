@extends('frontend.layouts.master')
@section('title', 'Tìm kiếm nước hoa')
@section('description', 'Tìm kiếm nước hoa')
@section('keywords', 'Tìm kiếm nước hoa')
@section('meta_keywords', 'Tìm kiếm nước hoa')
@section('meta_description', 'Tìm kiếm nước hoa')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
                <p>
                    <a href="{{route('home')}}">Trang chủ</a>
                    <span class="separator"> > </span>
                    <span class="last">
                        Tìm kiếm từ khóa <b>"{{request('txtsearch')}}"</b>
                    </span>
                </p>
            </nav>
        </div>
    </div>
    <section class="service">
        <div class="container">
            <div class="row mobile-joie-row">
                <div class="col-md-3 nav_left mobile-joie-left">
                    <div class="section_side_left">
                        <h2 class="title_product">Thương hiệu</h2>
                        <div>
                            <input type="text" placeholder="Nhập thương hiệu" id="myInput" onkeyup="myBrandSearch()"
                                   style="border: 0; border-bottom: 1px solid black; width: 100%; padding: 3px 28px 3px 0; margin: 10px 0">
                            <i class="fa fa-search" style="position: absolute; top: 55px; right: 20px"></i>
                        </div>
                        <ul class="list_category" id="myProductList">
                            @foreach($allBrands as $brand)
                                <li>
                                    <a href="{{route('brand.detail', $brand->slug)}}">{{$brand->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @include('frontend.inc.newsletter')
                </div>
                <div class="col-md-9 nav_right mobile-joie-right">
                    <div class="title_cat">
                        <h2>
                            - Có {{$totalprod}} kết quả -
                        </h2>
                        <div class="dropdown pull-right drop-sort">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sắp xếp theo
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu drop-order" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['orderby' => 'alpha-asc']) }}">
                                        Tên từ: A-Z
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['orderby' => 'alpha-desc']) }}">
                                        Tên từ: Z-A
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['orderby' => 'created-asc']) }}">
                                        Sản phẩm từ mới đến cũ
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['orderby' => 'created-desc']) }}">
                                        Sản phẩm từ cũ đến mới
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="list_product product_category row row5">
                        @if(count($products) > 0)
                            @foreach($products as $product)
                                <div class="col-xs-6 col-md-3">
                                    <div class="item_product">
                                        <div class="box_image">
                                            <a href="{{route('product-detail', $product->slug)}}">
                                                <img src="{{asset($product->featured_img)}}" alt="{{$product->title}}"/>
                                            </a>
                                            <div class="button-add">
                                                <a id="smallButton"
                                                   data-attr="{{route('products.view-quick', $product->id)}}"
                                                   data-toggle="modal" data-target="#product_quick_view">Xem nhanh</a>
                                            </div>
                                        </div>
                                        <div class="detail_product">
                                            <p>
                                                {{$product->brand->title}}
                                            </p>
                                            <h3>
                                                <a href="{{route('product-detail', $product->slug)}}">{{$product->title}}</a>
                                            </h3>
                                            <div class="price_product">
                                                @if(count($product->productSizes) > 1)
                                                    <div class="price_real mult_size">
                                                        @if($product->productSizes->first()->price < $product->productSizes->last()->price)
                                                            <span class="p_amount">
                                                                &#165;{{$product->productSizes->first()->sale_price != null ? number_format($product->productSizes->first()->sale_price) : number_format($product->productSizes->first()->price)}} &ndash;
                                                            </span>
                                                            <span class="p_amount">
                                                                &#165;{{$product->productSizes->last()->sale_price != null ? number_format($product->productSizes->last()->sale_price) : number_format($product->productSizes->last()->price)}}
                                                            </span>
                                                        @else
                                                            <span class="p_amount">
                                                                &#165;{{$product->productSizes->last()->sale_price != null ? number_format($product->productSizes->last()->sale_price) : number_format($product->productSizes->last()->price)}}
                                                                 &ndash;
                                                            </span>
                                                            <span class="p_amount">
                                                                &#165;{{$product->productSizes->first()->sale_price != null ? number_format($product->productSizes->first()->sale_price) : number_format($product->productSizes->first()->price)}}
                                                            </span>
                                                        @endif
                                                    </div>
                                                @else
                                                    @if($product->productSizes && $product->productSizes->first()->sale_price != null)
                                                        <div class="price_discount">
                                                            <span class="p_amount">&#165;{{number_format($product->productSizes->first()->price)}}</span>
                                                        </div>
                                                        <div class="price_real">
                                                            <span class="p_amount">&#165;{{number_format($product->productSizes->first()->sale_price)}}</span>
                                                        </div>
                                                    @else
                                                        <div class="price_real flex100">
                                                            <span class="p_amount">&#165;{{number_format($product->productSizes->first()->price)}}</span>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="product_size">
                                                <span>{{count($product->productSizes)}} Sizes</span>
                                            </div>
                                        </div>
                                        @if($product->is_new == 1)
                                            <div class="prod_new">
                                                <span>New</span>
                                            </div>
                                        @endif
                                        @if($product->discount == 1)
                                            <div class="prod_sale {{$product->is_new == 1 ? 'new_lable' : ''}}">
                                                <span>Sale</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <div class="null_style">
                                    <h3>Từ khóa bạn tìm kiếm <b>"{{request('txtsearch')}}"</b>!</h3>
                                    <h4>Không có kết quả nào, vui lòng thay đổi bộ lọc hoặc từ khóa.</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if(count($products) > 0)
                        <div class="pagination_wrapper">
                            {{ $products->appends(request()->query())->render('frontend.paginator.index') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
