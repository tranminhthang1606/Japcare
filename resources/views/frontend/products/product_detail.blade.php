@extends('frontend.layouts.master')
@section('title', $product->title ?? '')
@section('description', $product->description ?? '')
@section('keywords', $product->title ?? '')
@section('meta_keywords', $product->meta_title ?? '')
@section('meta_description', $product->meta_description ?? '')
{{--@section('thumbnail_img', asset("$product->featured_img") ?? '')--}}

@section('content')

<div class="container">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
            <li class="breadcrumb-item"><a href="#">Mỹ phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                {{$product->title}}
            </li>
        </ol>
    </nav>
</div>
@error('err_noti')
<div class="alert alert-danger" role="alert">
    {{$message}}
</div>

@enderror
<div class="product_detail-page">
    <div class="product-detail-header container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                @if($_isDerive == 'mb')
                <div class="banner_product-detail-mobile">
                    <div class="swiper mySwiper14">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/images/') }}/pd-banner-mobile-1.jpg" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/images/') }}/pd-banner-mobile-2.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/images/') }}/pd-banner-mobile-3.jpg" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/images/') }}/pd-banner-mobile-4.jpg" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/images/') }}/pd-banner-mobile-5.jpg" alt="">
                            </div>
                        </div>
                        <div class="swiper-button-next white"></div>
                        <div class="swiper-button-prev white"></div>
                    </div>
                </div>
                @else
                <div class="thumbs_product-detail-img">
                    <div class="swiper mySwiper9">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide img-thumb-show">
                                <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                            </div>
                            <div class="swiper-slide img-thumb-show">
                                <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                            </div>
                            <div class="swiper-slide img-thumb-show">
                                <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                            </div>
                            <div class="swiper-slide img-thumb-show">
                                <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                            </div>
                            <div class="swiper-slide img-thumb-show">
                                <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                            </div>
                        </div>
                        <div class="swiper-button-next white thumb"></div>
                        <div class="swiper-button-prev white thumb"></div>
                    </div>
                    <div class="swiper mySwiper10">
                        <div class="swiper-wrapper thumbs-slider">
                            <div class="swiper-slide thumb-image">
                                <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                            </div>
                            <div class="swiper-slide thumb-image">
                                <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                            </div>
                            <div class="swiper-slide thumb-image">
                                <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                            </div>
                            <div class="swiper-slide thumb-image">
                                <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                            </div>
                            <div class="swiper-slide thumb-image">
                                <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <form action="{{route('cart.addToCart')}}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="col-lg-6 col-md-12">
                    <h3 class="product-detai-title">{{$product->title}}</h3>
                    <div class="product_detail-price">
                        <span class="product_detail-cur-price">{{number_format($product->sale_price,0,'.','.')}}đ</span>
                        <div>
                            <del class="product_detail-old-price">{{number_format($product->price,0,'.','.')}}đ</del>
                            <span class="product_detail-sale-percent">Giảm {{$product->discount}}%</span>
                        </div>
                    </div>
                    <p class="product-detai-status">Tình trạng: <span class="product-detail-still">{{$isValid>0?'Còn
                            hàng':'Hết hàng'}}</span>
                    </p>
                    {{-- <div class="usages">
                        <div class="usage">
                            <img src="{{ asset('frontend/images/') }}/usage-1.png" alt="">
                            <span>Cung cấp dưỡng chất và đổ ẩm cho da</span>
                        </div>
                        <div class="usage">
                            <img src="{{ asset('frontend/images/') }}/usage-2.png" alt="">
                            <span>Dưỡng da mịn màng, mềm mại</span>
                        </div>
                        <div class="usage">
                            <img src="{{ asset('frontend/images/') }}/usage-3.png" alt="">
                            <span>Làm sạch da</span>
                        </div>
                    </div> --}}
                    <div class="usages">
                        {!!$product->txt_uses!!}
                    </div>


                    @if ($isValid>0)
                    <div class="product-detail-capacity-type">
                        <span>Loại: </span>
                        @foreach ($product->productSizes as $item)

                        <div class="check-capacity">
                            <input id="type-{{$item->id}}" data-stock="{{$item->stock}}" type="radio" name="size_id"
                                value="{{$item->id}}" {{$item->stock ==0?'disabled':'checked'}}>
                            <label for="type-{{$item->id}}">{{$item->title}}</label>
                        </div>

                        @endforeach
                    </div>
                    <div class="product-detail-quantity">
                        <span class="title-quantity">Số lượng: </span>
                        <div class="number-quantity">
                            <span class="minus">-</span>

                            <input type="text" id="qty" name="product_qty" value="1" min="1"
                                />
                            <span class="plus">+</span>
                        </div>
                    </div>
                    <div class="product_detail-btn">

                        <button id="add-to-cart" type="submit">
                            <i class="fa-solid fa-bag-shopping" style="color: #ffffff;"></i>
                            <span>Thêm vào giỏ</span>
                        </button>

                        <button id="buy-now" type="submit">Mua ngay</button>
                    </div>
                    @endif
                    <div id="group-commit-has-bundle-deal">
                        <div class="group-commit">
                            <div class="commit">
                                <img src="{{ asset('frontend/images/') }}/commit-1.png" alt="">
                                <span>Sản phẩm 100% chính hãng</span>
                            </div>
                            <div class="commit">
                                <img src="{{ asset('frontend/images/') }}/commit-2.png" alt="">
                                <span>Hoàn trả hàng trong vòng 10 ngày</span>
                            </div>
                            <div class="commit">
                                <img src="{{ asset('frontend/images/') }}/commit-3.png" alt="">
                                <span>Miễn phí vận chuyển cho tất cả đơn hàng</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="menu-tabs container">
        <a class="" href="#" key-link-go-to="0">Thông tin chung</a>
        <a href="#" key-link-go-to="1">Công dụng</a>
        <a href="#" key-link-go-to="2">Thành phần</a>
        <a href="#" key-link-go-to="3">Hướng dẫn sử dụng</a>
        <a href="#" key-link-go-to="4">Thông số sản phẩm</a>
        <a href="#" key-link-go-to="review">Đánh giá</a>
    </div>

    <div class="container">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapse1" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapse1">
                        thông tin chi tiết
                    </button>
                </h2>
                <div id="panelsStayOpen-collapse1" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-heading1">
                    <div class="accordion-body">
                        <div class="skin-type">
                            <div class="item d-flex border-bottom">
                                <div class="icon-skin-type-title">
                                    Công dụng
                                </div>
                                <div class="list-info-skin-type-title">
                                    Thành phần hỗ trợ
                                </div>
                            </div>
                            <div class="item d-flex">
                                <div class="icon-skin-type">
                                    <img src="{{ asset('frontend/images/') }}/icon-tooltip.png" alt="Giúp da sáng mịn">
                                    <p class="mb-0 mt-2 pe-none">Giúp da sáng mịn</p>
                                </div>
                                <div class="list-info-skin-type">
                                    <div class="info-skin-type">
                                        <div class="tooltip-custom">
                                            <span class="tooltip-text">
                                                <p>Hạt ý dĩ hay hạt í dĩ được biết tới với các tên gọi khác nhau
                                                    như: hạt bo bo, hạt cườm gạo, ý mễ, lục cốc tử hay mễ nhân. Tên
                                                    tiếng anh của hạt ý dĩ là Coix Seed hoặc Seed of Job's Tear. Hạt
                                                    ý dĩ màu trắng sữa ngà, hình bầu dục, có vị ngọt thanh tự nhiên.
                                                </p>
                                                <p>Về thành phần, hạt ý dĩ chứa lượng lớn các axit béo không bão hòa
                                                    như: axit linoleic, axit palmitic, axit stearic,...cùng rất
                                                    nhiều axit amin vitamin thiết yếu cho cơ thể. Tác dụng chính của
                                                    ý dĩ&nbsp;là chống oxy hóa, ức chế tyrosinase giúp làm trắng da.
                                                    Ngoài ra ý dĩ còn giúp&nbsp;kháng viêm và hỗ trợ tăng sức đề
                                                    kháng cho cơ thể, tốt cho hệ hô hấp, ức chế khối u hay tế bào
                                                    ung thư, ngăn cản vi khuẩn và ký sinh trùng phát triển</p>
                                                <p><a href="#" target="_blank"><strong>Xem thêm</strong></a></p>
                                            </span>
                                            <span class="badge bg-success">
                                                <span>
                                                    Bột ý dĩ
                                                </span>
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7 0C3.13438 0 0 3.13438 0 7C0 10.8656 3.13438 14 7 14C10.8656 14 14 10.8656 14 7C14 3.13438 10.8656 0 7 0ZM7.5 10.375C7.5 10.4438 7.44375 10.5 7.375 10.5H6.625C6.55625 10.5 6.5 10.4438 6.5 10.375V6.125C6.5 6.05625 6.55625 6 6.625 6H7.375C7.44375 6 7.5 6.05625 7.5 6.125V10.375ZM7 5C6.80374 4.99599 6.61687 4.91522 6.47948 4.775C6.3421 4.63478 6.26515 4.4463 6.26515 4.25C6.26515 4.0537 6.3421 3.86522 6.47948 3.725C6.61687 3.58478 6.80374 3.50401 7 3.5C7.19626 3.50401 7.38313 3.58478 7.52052 3.725C7.6579 3.86522 7.73485 4.0537 7.73485 4.25C7.73485 4.4463 7.6579 4.63478 7.52052 4.775C7.38313 4.91522 7.19626 4.99599 7 5Z"
                                                        fill="#77BD9B"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5>Thành phần</h5>
                        <div class="tooltip-custom">
                            Vitamin E
                            <img src="{{ asset('frontend/images/') }}/tooltip_ingredient.jpg" width="22" height="22"
                                alt="tooltip">
                            <span class="tooltip-text">
                                <p>Vitamin E là một loại vitamin tan trong chất béo, là một thành phần quan trọng
                                    giúp duy trì hoạt động bình thường của các cơ quan trong cơ thể, cũng&nbsp;là
                                    một chất chống oxy hóa giúp làm chậm các quá trình gây tổn thương tế bào.</p>
                                <p><strong><a href="#" target="_blank">Xem thêm</a></strong></p>
                            </span>
                        </div>
                        <div class="tooltip-custom">
                            Bột ý dĩ
                            <img src="{{ asset('frontend/images/') }}/tooltip_ingredient.jpg" width="22" height="22"
                                alt="tooltip">
                            <span class="tooltip-text">
                                <p>Hạt ý dĩ hay hạt í dĩ được biết tới với các tên gọi khác nhau như: hạt bo bo, hạt
                                    cườm gạo, ý mễ, lục cốc tử hay mễ nhân. Tên tiếng anh của hạt ý dĩ là Coix Seed
                                    hoặc Seed of Job's Tear. Hạt ý dĩ màu trắng sữa ngà, hình bầu dục, có vị ngọt
                                    thanh tự nhiên.</p>
                                <p>Về thành phần, hạt ý dĩ chứa lượng lớn các axit béo không bão hòa như: axit
                                    linoleic, axit palmitic, axit stearic,...cùng rất nhiều axit amin vitamin thiết
                                    yếu cho cơ thể. Tác dụng chính của ý dĩ&nbsp;là chống oxy hóa, ức chế tyrosinase
                                    giúp làm trắng da. Ngoài ra ý dĩ còn giúp&nbsp;kháng viêm và hỗ trợ tăng sức đề
                                    kháng cho cơ thể, tốt cho hệ hô hấp, ức chế khối u hay tế bào ung thư, ngăn cản
                                    vi khuẩn và ký sinh trùng phát triển</p>
                                <p><a href="#" target="_blank"><strong>Xem thêm</strong></a></p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading-0">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapse-0" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapse-0">
                        thông tin chung
                    </button>
                </h2>
                <div id="panelsStayOpen-collapse-0" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-heading-0">
                    <div class="accordion-body">
                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until
                        the collapse plugin adds the appropriate classes that we use to style each element. These
                        classes control the overall appearance, as well as the showing and hiding via CSS
                        transitions. You can modify any of this with custom CSS or overriding our default variables.
                        It's also worth noting that just about any HTML can go within the
                        <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading-1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapse-1" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapse-1">
                        công dụng
                    </button>
                </h2>
                <div id="panelsStayOpen-collapse-1" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-heading-1">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                        collapse plugin adds the appropriate classes that we use to style each element. These
                        classes control the overall appearance, as well as the showing and hiding via CSS
                        transitions. You can modify any of this with custom CSS or overriding our default variables.
                        It's also worth noting that just about any HTML can go within the
                        <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading-2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapse-2" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapse-2">
                        thành phần
                    </button>
                </h2>
                <div id="panelsStayOpen-collapse-2" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-heading-2">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                        collapse plugin adds the appropriate classes that we use to style each element. These
                        classes control the overall appearance, as well as the showing and hiding via CSS
                        transitions. You can modify any of this with custom CSS or overriding our default variables.
                        It's also worth noting that just about any HTML can go within the
                        <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading-3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapse-3" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapse-3">
                        hướng dẫn sử dụng
                    </button>
                </h2>
                <div id="panelsStayOpen-collapse-3" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-heading-3">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                        collapse plugin adds the appropriate classes that we use to style each element. These
                        classes control the overall appearance, as well as the showing and hiding via CSS
                        transitions. You can modify any of this with custom CSS or overriding our default variables.
                        It's also worth noting that just about any HTML can go within the
                        <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading-4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapse-4" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapse-4">
                        thông số sản phẩm
                    </button>
                </h2>
                <div id="panelsStayOpen-collapse-4" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-heading-4">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                        collapse plugin adds the appropriate classes that we use to style each element. These
                        classes control the overall appearance, as well as the showing and hiding via CSS
                        transitions. You can modify any of this with custom CSS or overriding our default variables.
                        It's also worth noting that just about any HTML can go within the
                        <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container evaluate">
        <div class="evaluate-header row">
            <div class="total-rating col-lg-2 col-md-12">
                <p>Đánh giá</p>
                <p>Đánh giá trung bình</p>
                <div class="d-flex">
                    <div class="point">
                        <span>4.9 ★</span>
                    </div>
                </div>
            </div>
            <div class="filter-review col-lg-7 col-md-12">
                <div class="d-flex">
                    <span class="label-filter">Lọc theo</span>
                    <div class="list-btn-filter-review ms-3">
                        <button type="button" class="btn active">
                            <span> ★ ★ ★ ★ ★ (3062)</span>
                        </button>
                        <button type="button" class="btn">
                            <span> ★ ★ ★ ★ (90)</span>
                        </button>
                        <button type="button" class="btn">
                            <span> ★ ★ ★ (26)</span>
                        </button>
                        <button type="button" class="btn">
                            <span> ★ ★ (7)</span>
                        </button>
                        <button type="button" class="btn">
                            <span> ★ (0)</span>
                        </button>
                    </div>
                </div>
                <div class="list-btn-filter-review-2">
                    <button type="button" class="btn">
                        <span>Tất cả</span>
                    </button>
                    <button type="button" class="btn active">
                        <span>Có bình luận (1458)</span>
                    </button>
                </div>
            </div>
            <div class="comment-review col-lg-3 col-md-12">
                <p>Chia sẻ nhận xét của bạn về sản phẩm này</p>
                <a class="comment-txt" href="#">Viết bình luận</a>
            </div>
        </div>
        <div class="form-comment-rw">
            <form action="">
                <span>Đánh giá sản phẩm này <span class="color-star">*</span></span>
                <div class="rating-total-rw">
                    <input type="radio" name="rating-comment" id="rating-1">
                    <label for="rating-1">☆</label>
                    <input type="radio" name="rating-comment" id="rating-2">
                    <label for="rating-2">☆</label>
                    <input type="radio" name="rating-comment" id="rating-3">
                    <label for="rating-3">☆</label>
                    <input type="radio" name="rating-comment" id="rating-4">
                    <label for="rating-4">☆</label>
                    <input type="radio" name="rating-comment" id="rating-5">
                    <label for="rating-5">☆</label>
                </div>
                <div>
                    <span>Mô tả nhận xét <span class="color-star">*</span></span>
                </div>
                <textarea name="" id="" rows="4"></textarea>
                <div class="btn-rw">
                    <button class="btn btn-rw-cancel">Bỏ qua</button>
                    <button class="btn btn-rw-send">Gửi</button>
                </div>
            </form>
        </div>
        <div class="evaluate-body">
            <ul class="timeline">
                <li class="event" data-date="22:41:25 10/7/2023">
                    <p class="version-review">Phiên bản: 20 ngày</p>
                    <div class="d-flex">
                        <div class="d-flex">
                            <span class="star-rating">★★★★★</span>
                            <div class="name">
                                pmn159007
                            </div>
                        </div>
                    </div>
                    <div class="comment">
                        Công dụng:chua su dung nen khong biet
                        Đối tượng sử dụng:15tuoi trở lên
                        Lần đầu sử dụng chưa biết có trắng không. Nếu có hiệu quả sẽ ủng hộ shop nhiều nhiều.
                        Săn ở phiên live 7/7 nên được giá hời 🥰
                        Ship giao nhanh và thân thiện quá nè!! 😉
                    </div>
                </li>
                <li class="event" data-date="22:41:25 10/7/2023">
                    <p class="version-review">Phiên bản: 20 ngày</p>
                    <div class="d-flex">
                        <div class="d-flex">
                            <span class="star-rating">★★★★★</span>
                            <div class="name">
                                pmn159007
                            </div>
                        </div>
                    </div>
                    <div class="comment">
                        Công dụng:chua su dung nen khong biet
                        Đối tượng sử dụng:15tuoi trở lên
                        Lần đầu sử dụng chưa biết có trắng không. Nếu có hiệu quả sẽ ủng hộ shop nhiều nhiều.
                        Săn ở phiên live 7/7 nên được giá hời 🥰
                        Ship giao nhanh và thân thiện quá nè!! 😉
                    </div>
                </li>
                <li class="event" data-date="22:41:25 10/7/2023">
                    <p class="version-review">Phiên bản: 20 ngày</p>
                    <div class="d-flex">
                        <div class="d-flex">
                            <span class="star-rating">★★★★★</span>
                            <div class="name">
                                pmn159007
                            </div>
                        </div>
                    </div>
                    <div class="comment">
                        Công dụng:chua su dung nen khong biet
                        Đối tượng sử dụng:15tuoi trở lên
                        Lần đầu sử dụng chưa biết có trắng không. Nếu có hiệu quả sẽ ủng hộ shop nhiều nhiều.
                        Săn ở phiên live 7/7 nên được giá hời 🥰
                        Ship giao nhanh và thân thiện quá nè!! 😉
                    </div>
                </li>
                <li class="event" data-date="22:41:25 10/7/2023">
                    <p class="version-review">Phiên bản: 20 ngày</p>
                    <div class="d-flex">
                        <div class="d-flex">
                            <span class="star-rating">★★★★★</span>
                            <div class="name">
                                pmn159007
                            </div>
                        </div>
                    </div>
                    <div class="comment">
                        Công dụng:chua su dung nen khong biet
                        Đối tượng sử dụng:15tuoi trở lên
                        Lần đầu sử dụng chưa biết có trắng không. Nếu có hiệu quả sẽ ủng hộ shop nhiều nhiều.
                        Săn ở phiên live 7/7 nên được giá hời 🥰
                        Ship giao nhanh và thân thiện quá nè!! 😉
                    </div>
                </li>
                <li class="event" data-date="22:41:25 10/7/2023">
                    <p class="version-review">Phiên bản: 20 ngày</p>
                    <div class="d-flex">
                        <div class="d-flex">
                            <span class="star-rating">★★★★★</span>
                            <div class="name">
                                pmn159007
                            </div>
                        </div>
                    </div>
                    <div class="comment">
                        Công dụng:chua su dung nen khong biet
                        Đối tượng sử dụng:15tuoi trở lên
                        Lần đầu sử dụng chưa biết có trắng không. Nếu có hiệu quả sẽ ủng hộ shop nhiều nhiều.
                        Săn ở phiên live 7/7 nên được giá hời 🥰
                        Ship giao nhanh và thân thiện quá nè!! 😉
                    </div>
                </li>
                <li class="event" data-date="22:41:25 10/7/2023">
                    <p class="version-review">Phiên bản: 20 ngày</p>
                    <div class="d-flex">
                        <div class="d-flex">
                            <span class="star-rating">★★★★★</span>
                            <div class="name">
                                pmn159007
                            </div>
                        </div>
                    </div>
                    <div class="comment">
                        Công dụng:chua su dung nen khong biet
                        Đối tượng sử dụng:15tuoi trở lên
                        Lần đầu sử dụng chưa biết có trắng không. Nếu có hiệu quả sẽ ủng hộ shop nhiều nhiều.
                        Săn ở phiên live 7/7 nên được giá hời 🥰
                        Ship giao nhanh và thân thiện quá nè!! 😉
                    </div>
                </li>
                <li class="event" data-date="22:41:25 10/7/2023">
                    <p class="version-review">Phiên bản: 20 ngày</p>
                    <div class="d-flex">
                        <div class="d-flex">
                            <span class="star-rating">★★★★★</span>
                            <div class="name">
                                pmn159007
                            </div>
                        </div>
                    </div>
                    <div class="comment">
                        Công dụng:chua su dung nen khong biet
                        Đối tượng sử dụng:15tuoi trở lên
                        Lần đầu sử dụng chưa biết có trắng không. Nếu có hiệu quả sẽ ủng hộ shop nhiều nhiều.
                        Săn ở phiên live 7/7 nên được giá hời 🥰
                        Ship giao nhanh và thân thiện quá nè!! 😉
                    </div>
                </li>
            </ul>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination product-detail">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="container product-relate">
        <h2>Sản phẩm liên quan</h2>
        <div class="swiper mySwiper12">
            <div class="new_product-list swiper-wrapper">
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-1.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift sold-out">Hết hàng</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating"></div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-1.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da</a>
                            <div class="product_rating-sold">
                                <div class="product_rating"></div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next custom">
                <i class="fa-solid fa-arrow-right"></i>
            </div>
            <div class="swiper-button-prev custom">
                <i class="fa-solid fa-arrow-left"></i>
            </div>
        </div>
    </div>
    <div class="container product-seen">
        <h2>Sản phẩm đã xem</h2>
        <div class="swiper mySwiper12">
            <div class="new_product-list swiper-wrapper">
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-1.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift sold-out">Hết hàng</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating"></div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-1.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da</a>
                            <div class="product_rating-sold">
                                <div class="product_rating"></div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="new_product-card swiper-slide">
                    <div class="wrap">
                        <a href="javascript:void(0)"><img src="{{ asset('frontend/images/') }}/new-product-2.jpg"
                                alt=""></a>
                        <div class="new_product-content w-100 p-2">
                            <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá 150k</span>
                            <a href="javascript:void(0)">Sữa dưỡng trắng da DHC LX-ME Whitening Emulsion</a>
                            <div class="product_rating-sold">
                                <div class="product_rating">4.8 ★</div>
                                <div class="product_sold">Đã bán 50</div>
                            </div>
                            <div class="product_price">
                                <span class="price">300.000đ</span>
                                <del class="old-price">350.000đ</del>
                                <span class="percent">-20%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next custom">
                <i class="fa-solid fa-arrow-right"></i>
            </div>
            <div class="swiper-button-prev custom">
                <i class="fa-solid fa-arrow-left"></i>
            </div>
        </div>
    </div>
</div><!-- product_detail-page end -->
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
            //
            function initialMaxAndQty(){
                var checkedRadio = document.querySelector('input[name="size_id"]:checked');
                var stock = checkedRadio.getAttribute('data-stock');
                var qtyInput = document.getElementById('qty');
                if (checkedRadio) {
                qtyInput.max = stock;
            }
                
                
            }
           
            
            initialMaxAndQty()
            
            
            $('.minus').on('click', function () {
                let qty = $('#qty').val();
                if (qty > 1) {
                    $('#qty').val(parseInt(qty) - 1);
                    if ($('.plus').prop('disabled')) {
                        $('.plus').prop('disabled', false);
                    }
                }
            });

            $('.plus').on('click', function () {
                let qtyPlus = $('#qty').val();
                console.log(qtyPlus);
                var checkedRadio = document.querySelector('input[name="size_id"]:checked');
                var stock = checkedRadio.getAttribute('data-stock');
                if (qtyPlus == stock) {
                    $(this).prop('disabled', true);
                } else {
                    $('#qty').val(parseInt(qtyPlus) + 1);
                    $(this).prop('disabled', false);
                }
            });


            
            document.querySelectorAll('input[name="size_id"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    var stock = this.getAttribute('data-stock');
                    var qtyInput = document.getElementById('qty');
                    qtyInput.value = 1;
                    qtyInput.max = stock;
                });
            });

            $('#qty').on('keyup',function(){
                console.log($(this).val());
                if(isNaN($(this).val())){
                    $(this).val(1);
                    return;
                }
                if($(this).val() <0){
                    $(this).val(1);
                    return;
                }

                if($(this).val() > parseInt($(this).attr('max'))){
                    $(this).val(parseInt($(this).attr('max')));
                    return;
                }
            })

            
            $('.menu-tabs a').on('click', function (e) {
                e.preventDefault();
                $('.menu-tabs a').removeClass('active');
                let keyActive = $(this).attr('key-link-go-to');
                $("#panelsStayOpen-collapse-" + keyActive).removeClass("show");
                $("#panelsStayOpen-heading-" + keyActive + "button").addClass("collapsed");
                switch ($(this).attr('key-link-go-to')) {
                    case "0":
                        // add show
                        $("#panelsStayOpen-collapse-0").addClass("show");
                        $("#panelsStayOpen-heading-0 button").removeClass("collapsed");
                        // remove show
                        $("#panelsStayOpen-collapse-1").removeClass("show");
                        $("#panelsStayOpen-heading-1 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-2").removeClass("show");
                        $("#panelsStayOpen-heading-2 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-3").removeClass("show");
                        $("#panelsStayOpen-heading-3 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-4").removeClass("show");
                        $("#panelsStayOpen-heading-4 button").addClass("collapsed");
                        $(this).toggleClass('active');
                        $('html,body').animate({
                                scrollTop: $("#panelsStayOpen-heading-0").offset().top - 130},
                            'fast');
                        break;
                    case "1":
                        // add show
                        $("#panelsStayOpen-collapse-1").addClass("show");
                        $("#panelsStayOpen-heading-1 button").removeClass("collapsed");
                        // remove show
                        $("#panelsStayOpen-collapse-0").removeClass("show");
                        $("#panelsStayOpen-heading-0 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-2").removeClass("show");
                        $("#panelsStayOpen-heading-2 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-3").removeClass("show");
                        $("#panelsStayOpen-heading-3 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-4").removeClass("show");
                        $("#panelsStayOpen-heading-4 button").addClass("collapsed");
                        $(this).toggleClass('active');
                        $('html,body').animate({
                                scrollTop: $("#panelsStayOpen-heading-1").offset().top - 130},
                            'fast');
                        break;
                    case "2":
                        // add show
                        $("#panelsStayOpen-collapse-2").addClass("show");
                        $("#panelsStayOpen-heading-2 button").removeClass("collapsed");
                        // remove show
                        $("#panelsStayOpen-collapse-0").removeClass("show");
                        $("#panelsStayOpen-heading-0 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-1").removeClass("show");
                        $("#panelsStayOpen-heading-1 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-3").removeClass("show");
                        $("#panelsStayOpen-heading-3 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-4").removeClass("show");
                        $("#panelsStayOpen-heading-4 button").addClass("collapsed");
                        $(this).toggleClass('active');
                        $('html,body').animate({
                                scrollTop: $("#panelsStayOpen-heading-2").offset().top - 130},
                            'fast');
                        break;
                    case "3":
                        // add show
                        $("#panelsStayOpen-collapse-3").addClass("show");
                        $("#panelsStayOpen-heading-3 button").removeClass("collapsed");
                        // remove show
                        $("#panelsStayOpen-collapse-2").removeClass("show");
                        $("#panelsStayOpen-heading-2 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-0").removeClass("show");
                        $("#panelsStayOpen-heading-0 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-1").removeClass("show");
                        $("#panelsStayOpen-heading-1 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-4").removeClass("show");
                        $("#panelsStayOpen-heading-4 button").addClass("collapsed");
                        $(this).toggleClass('active');
                        $('html,body').animate({
                                scrollTop: $("#panelsStayOpen-heading-3").offset().top - 130},
                            'fast');
                        break;
                    case "4":
                        // add show
                        $("#panelsStayOpen-collapse-4").addClass("show");
                        $("#panelsStayOpen-heading-4 button").removeClass("collapsed");
                        // remove show
                        $("#panelsStayOpen-collapse-2").removeClass("show");
                        $("#panelsStayOpen-heading-2 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-0").removeClass("show");
                        $("#panelsStayOpen-heading-0 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-1").removeClass("show");
                        $("#panelsStayOpen-heading-1 button").addClass("collapsed");
                        $("#panelsStayOpen-collapse-3").removeClass("show");
                        $("#panelsStayOpen-heading-3 button").addClass("collapsed");
                        $(this).toggleClass('active');
                        $('html,body').animate({
                                scrollTop: $("#panelsStayOpen-heading-4").offset().top - 130},
                            'fast');
                        break;
                    case "review":
                        $('html,body').animate({
                                scrollTop: $(".evaluate").offset().top - 130},
                            'fast');
                        $(this).toggleClass('active');
                }
            });

            

            var swiper10 = new Swiper(".mySwiper10", {
                // loop: true,
                direction: "vertical",
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true
            });
            new Swiper(".mySwiper9", {
                loop: true,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                thumbs: {
                    swiper: swiper10
                }
            });
            new Swiper(".mySwiper11", {
                slidesPerView: "auto",
                spaceBetween: 30,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
            new Swiper(".mySwiper12", {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                        resistanceRatio: 0.85
                    },
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                        resistanceRatio: 0.85
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                        resistanceRatio: 0.85
                    },
                    980: {
                        slidesPerView: 4,
                        spaceBetween: 40,
                        resistanceRatio: 0.85
                    },
                    1280: {
                        slidesPerView: 5,
                        spaceBetween: 50,
                        resistanceRatio: 0
                    }
                }
            });
            new Swiper(".mySwiper14", {
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

        });
</script>
@endsection