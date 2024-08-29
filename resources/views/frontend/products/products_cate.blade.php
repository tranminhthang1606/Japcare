@extends('frontend.layouts.master')
@section('title','Shop')
@section('content')
    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                <li class="breadcrumb-item active" aria-current="page">Thực phẩm chức năng</li>
            </ol>
        </nav>
    </div>
    <div class="container product_main-content product-cate-main">
        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar_content-wrap">
                    <div class="sidebar-content">
                        <div class="sidebar-content-type">
                            <p class="block-title">Loại sản phẩm</p>
                            <div class="cate-filter">
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a class="a-normal" href="#">Thực phẩm chức năng</a>
                                        <ul class="sub_menu-child">
                                            <li class="">
                                                <a href="#">Hỗ trợ sức khoẻ</a>
                                                <ul class="sub_menu-child">
                                                    <li class="">
                                                        <a href="#">Bổ não, tăng cường trí nhớ Bổ não, tăng cường trí
                                                            nhớ</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#">Giảm đường huyết</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#">Tăng cường đề kháng</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="">
                                                <a href="#">Hỗ trợ làm đẹp</a>
                                                <ul class="sub_menu-child">
                                                    <li class="">
                                                        <a href="#">Chống lão hoá</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#">Dưỡng ẩm</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="">
                                                <a href="#">Lối sống lành mạnh</a>
                                                <ul class="sub_menu-child">
                                                    <li class="">
                                                        <a href="#">Giảm cân / Ăn kiêng </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="a-normal" href="#">Mỹ phẩm</a>
                                        <ul class="sub_menu-child">
                                            <li class="">
                                                <a href="#">Chăm sóc da</a>
                                                <ul class="sub_menu-child">
                                                    <li class="">
                                                        <a href="#">Chống nắng</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#">Dưỡng ẩm da mặt</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#">Dưỡng môi</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="">
                                                <a href="#">Chăm sóc cơ thể</a>
                                                <ul class="sub_menu-child">
                                                    <li class="">
                                                        <a href="#">Dưỡng thể</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="">
                                                <a href="#">Chăm sóc tóc</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-content-brands">
                            <p class="block-title">Thương hiệu</p>
                            <div class="product-brands">
                                <a href="#">CIRACLE</a>
                                <a href="#">DEVE MEN</a>
                                <a href="#">DHC</a>
                                <a href="#">PHARMAACT</a>
                                <a href="#">REIHAKU HATOMUGI</a>
                                <a href="#">SALON LINK</a>
                                <a href="#">SHIKIORIORI</a>
                            </div>
                        </div>
                        <div class="siderbar-content-price">
                            <h5>Khoảng giá</h5>
                            <div class="price-range d-flex align-items-center">
                                <input type="number" min="0">
                                <span>đ</span>
                                <span class="m-2">-</span>
                                <input type="number" min="0">
                                <span>đ</span>
                            </div>
                            <span class="d-block mt-3">0đ - 3,000,000đ</span>
                        </div>
                        <button class="btn_product-filter">LỌC</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="view-header">
                    <div class="txt-info">
                        <h1 class="title-category">Thực phẩm chức năng</h1>
                        <span class="fw-300">(173 sản phẩm)</span>
                    </div>
                    <div class="fil_wrap">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.9298 30.7495C14.4498 30.7495 13.9698 30.6296 13.5298 30.3896C12.6398 29.8896 12.1098 28.9995 12.1098 27.9895V22.6396C12.1098 22.1296 11.7798 21.3795 11.4698 20.9895L7.6698 16.9995C7.0398 16.3695 6.5498 15.2695 6.5498 14.4595V12.1396C6.5498 10.5296 7.76982 9.26953 9.31982 9.26953H22.6598C24.1898 9.26953 25.4298 10.5096 25.4298 12.0396V14.2596C25.4298 15.3096 24.7998 16.5195 24.1998 17.1095C23.9098 17.3995 23.4298 17.3995 23.1398 17.1095C22.8498 16.8195 22.8498 16.3395 23.1398 16.0495C23.5098 15.6795 23.9298 14.8496 23.9298 14.2596V12.0396C23.9298 11.3396 23.3598 10.7695 22.6598 10.7695H9.31982C8.60982 10.7695 8.0498 11.3696 8.0498 12.1396V14.4595C8.0498 14.8295 8.34981 15.5596 8.73981 15.9496L12.5898 19.9995C13.0998 20.6295 13.5998 21.6896 13.5998 22.6396V27.9895C13.5998 28.6495 14.0498 28.9695 14.2498 29.0795C14.6798 29.3195 15.1898 29.3095 15.5898 29.0695L16.9898 28.1696C17.2798 27.9996 17.5598 27.4495 17.5598 27.0795C17.5598 26.6695 17.8998 26.3295 18.3098 26.3295C18.7198 26.3295 19.0598 26.6695 19.0598 27.0795C19.0598 27.9795 18.4998 29.0095 17.7898 29.4395L16.3998 30.3395C15.9498 30.6095 15.4398 30.7495 14.9298 30.7495Z"
                                fill="#17204D"></path>
                            <path
                                d="M16.24 22.89H19.72V24H14.86V17.4H16.24V22.89ZM22.918 18.9C23.4246 18.9 23.868 19.0033 24.248 19.21C24.6346 19.4167 24.9346 19.7133 25.148 20.1C25.368 20.4867 25.478 20.9533 25.478 21.5C25.478 22.04 25.368 22.5067 25.148 22.9C24.9346 23.2867 24.6346 23.5833 24.248 23.79C23.868 23.9967 23.4246 24.1 22.918 24.1C22.418 24.1 21.9746 23.9967 21.588 23.79C21.2013 23.5833 20.898 23.2867 20.678 22.9C20.4646 22.5067 20.358 22.04 20.358 21.5C20.358 20.9533 20.4646 20.4867 20.678 20.1C20.898 19.7133 21.2013 19.4167 21.588 19.21C21.9746 19.0033 22.418 18.9 22.918 18.9ZM22.918 19.92C22.6646 19.92 22.448 19.98 22.268 20.1C22.0946 20.2133 21.9613 20.3867 21.868 20.62C21.7746 20.8533 21.728 21.1467 21.728 21.5C21.728 21.8533 21.7746 22.1467 21.868 22.38C21.9613 22.6133 22.0946 22.79 22.268 22.91C22.448 23.0233 22.6646 23.08 22.918 23.08C23.1646 23.08 23.3746 23.0233 23.548 22.91C23.728 22.79 23.8646 22.6133 23.958 22.38C24.0513 22.1467 24.098 21.8533 24.098 21.5C24.098 21.1467 24.0513 20.8533 23.958 20.62C23.8646 20.3867 23.728 20.2133 23.548 20.1C23.3746 19.98 23.1646 19.92 22.918 19.92ZM22.918 26.2C22.6646 26.2 22.468 26.1333 22.328 26C22.188 25.8733 22.118 25.6967 22.118 25.47C22.118 25.2367 22.188 25.0567 22.328 24.93C22.468 24.8033 22.6646 24.74 22.918 24.74C23.178 24.74 23.378 24.8033 23.518 24.93C23.658 25.0567 23.728 25.2367 23.728 25.47C23.728 25.6967 23.658 25.8733 23.518 26C23.378 26.1333 23.178 26.2 22.918 26.2ZM28.8943 18.9C29.341 18.9 29.7176 18.9667 30.0243 19.1C30.3376 19.2267 30.5876 19.4033 30.7743 19.63C30.9676 19.85 31.1043 20.0967 31.1843 20.37L29.9043 20.83C29.8376 20.53 29.7243 20.3033 29.5643 20.15C29.4043 19.9967 29.1876 19.92 28.9143 19.92C28.661 19.92 28.4443 19.98 28.2643 20.1C28.0843 20.2133 27.9476 20.39 27.8543 20.63C27.761 20.8633 27.7143 21.1567 27.7143 21.51C27.7143 21.8633 27.761 22.1567 27.8543 22.39C27.9543 22.6233 28.0943 22.7967 28.2743 22.91C28.461 23.0233 28.6776 23.08 28.9243 23.08C29.1243 23.08 29.2943 23.0467 29.4343 22.98C29.5743 22.9067 29.6876 22.8033 29.7743 22.67C29.8676 22.5367 29.931 22.3767 29.9643 22.19L31.2043 22.59C31.131 22.89 30.9943 23.1533 30.7943 23.38C30.5943 23.6067 30.3376 23.7833 30.0243 23.91C29.711 24.0367 29.3476 24.1 28.9343 24.1C28.421 24.1 27.9676 23.9967 27.5743 23.79C27.181 23.5833 26.8776 23.2867 26.6643 22.9C26.451 22.5133 26.3443 22.0467 26.3443 21.5C26.3443 20.9533 26.451 20.4867 26.6643 20.1C26.8776 19.7133 27.1776 19.4167 27.5643 19.21C27.951 19.0033 28.3943 18.9 28.8943 18.9Z"
                                fill="#17204D"></path>
                        </svg>
                        <div class="select-filter">
                            <span>Sắp xếp theo: </span>
                            <div class="order-by">
                                <select name="" id="">
                                    <option value="1">Mới nhất</option>
                                    <option value="2">A-Z</option>
                                    <option value="3">Z-A</option>
                                    <option value="4">Giá giảm dần</option>
                                    <option value="5">Giá tăng dần</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="txt-text">
                    <span class="name-product">Loại sản phẩm:</span>
                    <span class="name-product-use">Thực phẩm chức năng</span>
                </div>
                <div class="all-product">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="new_product-card">
                                <div class="wrap">
                                    <a href="javascript:void(0)"><img
                                            src="{{ asset('frontend/images/') }}/new-product-1.jpg" alt=""></a>
                                    <div class="new_product-content w-100 p-2">
                                        <span class="new_product-gift">Tặng sample dầu tẩy trang 30ml trị giá
                                            150k</span>
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
                        </div>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="description-shop">
                    <div class="content-wrap">
                        <p>Thực phẩm chức năng là những sản phẩm được thiết kế để bổ sung chức năng dinh dưỡng hoặc giảm
                            thiểu các vấn đề nhất định của cơ thể.
                            Các thành phần dinh dưỡng thường có trong thực phẩm chức năng là vitamin, khoáng chất, axit
                            amin
                            và các loại chất chống oxy hóa,
                            cũng như các loại thảo dược và các chất bổ sung khác.</p>
                        <p>Thông thường, thực phẩm chức năng sẽ được điều chế dưới 3 dạng:
                            Dạng viên uống: Đây là dạng thực phẩm chức năng phổ biến nhất. Trong dạng viên uống sẽ có 3
                            loại: viên nang cứng, viên nang mềm và viên nén.
                            Dạng nước uống: Thường được đựng vào trong chai lọ thủy tinh để đảm bảo chất lượng sản phẩm.
                            So
                            với dạng viên uống thì dạng nước sẽ được cơ thể dễ hấp thụ hơn và đem lại hiệu quả nhanh
                            hơn.
                            Dạng thực phẩm chức năng khác: Có nhiều loại thực phẩm chức năng dạng khác như dạng bột,
                            dạng
                            thạch,...
                            Hiện tại, Bestme đang cung cấp các sản phẩm thực phẩm chức năng của thương hiệu DHC Nhật Bản
                            với
                            nhiều dòng như:
                            Hỗ trợ làm đẹp: Các viên uống giúp cải thiện một số vấn đề của da như dưỡng ẩm, chống lão
                            hóa,
                            dưỡng trắng, tốt cho tóc và móng,... chứa các thành phần làm đẹp như collagen, vitamin E,
                            nhau
                            thai, ý dĩ,...
                            Hỗ trợ sức khỏe: Các viên uống giúp bổ sung dưỡng chất cho cơ thể, tăng cường đề kháng, hỗ
                            trợ
                            tiêu hóa, tốt cho xương khớp,... chứa các thành phần tốt cho sức khỏe như vitamin C, vitamin
                            tổng hợp, kẽm, khoáng chất,...
                            Hỗ trợ lối sống lành mạnh: Các viên uống giúp tăng cường chức năng gan, hỗ trợ giảm cân khỏe
                            mạnh với các thành phần như chiết xuất nghệ,
                            chiết xuất gan, chiết xuất Forskohlii,...</p>
                        <p>Lưu ý khi sử dụng thực phẩm chức năng:
                            Sử dụng thực phẩm chức năng sẽ ảnh hưởng một phần không nhỏ đến sức khỏe của bạn. Do đó bạn
                            cần
                            phải có quyết định mua sắm thông minh,
                            lựa chọn được sản phẩm phù hợp và chất lượng.
                            Luôn nhớ kiểm tra kỹ nhãn hiệu cũng như các loại tem nhãn của sản phẩm để đảm bảo rằng nó
                            được
                            cung cấp bởi địa chỉ uy tín, đáng tin cậy.</p>
                        <img src="{{asset('frontend/images/product-cate.jpg')}}" alt="images product-cate">
                    </div>
                </div>
                <div class="btn-product-cate">
                    <button class="view-more open">Xem thêm</button>
                    <button class="view-more close">Thu gọn</button>
                </div>
            </div>
        </div>
    </div>
    <!-- product_main-content end -->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            if ($('.cate-filter ul li:has(ul.sub_menu-child)')) {
                $('.cate-filter ul li:has(ul.sub_menu-child)').addClass('has-aft');
            }
            ;
            $('.fil_wrap svg').on('click', function () {
                $('.sidebar_content-wrap').show('1000');
            });
            $('.sidebar_content-wrap').on('click', function (e) {
                if ($(e.target).closest('.sidebar-content').length == 0) {
                    $(this).hide(1000);
                }
            });
            let heightContent = $('.description-shop').height();
            if($('.content-wrap').height() > heightContent) {
                $('.view-more.open').show();
            }
            $('.view-more.open').on('click', function() {
                $('.description-shop').height('auto');
                $(this).hide();
                $('.view-more.close').show();
            });
            $('.view-more.close').on('click', function() {
                $('.description-shop').height(heightContent);
                $(this).hide();
                $('.view-more.open').show();
            })
        });
    </script>
@endsection


