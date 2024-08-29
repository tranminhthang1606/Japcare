@php
    //get url
    $pathArr = explode('/', request()->path());
    if (isset($pathArr[0]) && $pathArr[0]) {
        $first = "Trang chủ";
        $first_link = "/";
        switch ($pathArr[0]) {
            case "gioi-thieu":
                $second = "Giới thiệu";
                $second_link = null;
                break;
            case "chinh-sach":
                if (isset($pathArr[1]) && $pathArr[1]) {
                    $second = "Chính sách";
                    $second_link = null;
                    $third_link = null;
                    switch ($pathArr[1]) {
                        case "giao-hang":
                            $third = "Giao hàng";
                            break;
                        case "mua-hang-va-thanh-toan":
                            $third = "Mua hàng và thanh toán";
                            break;
                        case "gia-ca":
                            $third = "Giá cả";
                            break;
                        case "doi-tra":
                            $third = "Đổi trả";
                            break;
                        case "dieu-khoan-va-dich-vu":
                            $third = "Điều khoản và dịch vụ";
                            break;
                        case "bao-mat":
                            $third = "Bảo mật";
                            break;
                        default:
                            $first = null;
                    }
                } else {
                    $first = null;
                }
                break;
            case "lien-he":
                $second = "Liên hệ";
                $second_link = null;
                break;
            case "danh-muc-tin":
                $second = "Danh mục tin";
                $second_link = null;
                if (isset($pathArr[1]) && $pathArr[1] && isset($cateInfo)) {
                    $third = $cateInfo->title;
                    $third_link = null;
                } else {
                    $first = null;
                }
                break;
            case "bai-viet":
                $second = "Bài viết";
                $second_link = null;
                if (isset($pathArr[1]) && $pathArr[1] && isset($newsDetail)) {
                    $third = $newsDetail->title;
                    $third_link = null;
                } else {
                    $first = null;
                }
                break;
            case "san-pham":
                $second = "Sản phẩm";
                $second_link = null;
                break;
            case "san-pham-khuyen-mai":
                $second = "Sản phẩm khuyến mại";
                $second_link = null;
                break;
            case "danh-muc":
                $second = "Danh mục";
                $second_link = null;
                if (isset($pathArr[1]) && $pathArr[1] && isset($category)) {
                    $third = $category->title;
                    $third_link = null;
                } else {
                    $first = null;
                }
                break;
            case "tim-kiem":
                $second = "Tìm kiếm";
                $second_link = null;
                break;
            case "gio-hang":
                $second = "Giỏ hàng";
                $second_link = "/gio-hang/san-pham-ban-chon";
                if (isset($pathArr[1]) && $pathArr[1]) {
                    switch ($pathArr[1]) {
                        case "san-pham-ban-chon":
                            $third = "Sản phẩm đã chọn";
                            $third_link = null;
                            break;
                        case "thanh-toan":
                            $third = "Thanh toán";
                            $third_link = null;
                            break;
                        case "thank-you":
                            $third = "Cảm ơn";
                            $third_link = null;
                            break;
                        default:
                            $first = null;
                    }
                } else {
                    $first = null;
                }
                break;
            default:
                if (isset($product)) {
                    if ($product->category) {
                        $second = $product->category->title ?: '';
                        $second_link = route('products_cate', $product->category->slug);
                        $third = $product->title;
                        $third_link = null;
                    } else {
                        $second = $product->title;
                        $third_link = null;
                    }
                } else {
                    $first = null;
                }
        }
    } else {
        $first = null;
    }
@endphp

@if($first)
    <div class="rt-breadcrumbs">
        <div class="container">
            <p class="breadcrumbs row">
                <a href="{{$first_link}}">{{$first}}</a>
                <i class="fa fa-angle-right"></i>
                <span>
                    @if(isset($second_link) && $second_link)
                        <a href="{{$second_link}}">{{$second}}</a>
                    @else
                        {{$second}}
                    @endif
                    @if(isset($third) && $third)
                        <i class="fa fa-angle-right"></i>
                        <span class="breadcrumb_last" aria-current="page">
                            @if(isset($third_link) && $third_link)
                                <a href="{{$third_link}}">{{$third}}</a>
                            @else
                                {{$third}}
                            @endif
                        </span>
                    @endif
                </span>
            </p>
        </div>
    </div>
@endif
