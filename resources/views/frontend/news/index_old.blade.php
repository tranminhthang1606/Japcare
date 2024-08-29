@extends('frontend.layouts.master')
@section('title', isset($cateInfo) ? $cateInfo->title : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('description', isset($cateInfo) ? $cateInfo->description : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('keywords', isset($cateInfo) ? $cateInfo->title : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('meta_keywords', isset($cateInfo) ? $cateInfo->meta_title : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')
@section('meta_description', isset($cateInfo) ? $cateInfo->meta_description : 'Cổng thông tin sự kiện, tin tức của Japcare.vn')

@section('content')
    <main id="main" class="site-main" role="main">
        <div class="pageAbout-us">
            <div class="wrapper-row pd-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 pd5  ">
                            <div class="sidebar-blog">
                                <div class="news-latest">
                                    <div class="sidebarblog-title title_block1">
                                        <h2>Bài viết mới nhất<span class="fa fa-angle-down"></span></h2>
                                    </div>
                                    @foreach($newList as $new)
                                        <div class="item-article clearfix">
                                            <div class="post-image">
                                                <a href="{{route('news-detail', $new->slug)}}">
                                                    <img class="lazyloaded" title="{{$new->title}}" src="{{asset($new->thumbnail)}}" alt="{{$new->title}}"></a>
                                            </div>
                                            <div class="post-content">
                                                <div class="post-title">
                                                    <span class="title">
                                                        <a href="{{route('news-detail', $new->slug)}}">{{$new->title}}</a>
                                                    </span>
                                                </div>
                                                <div class="author">
                                                    <span>{{$new->user->name}}</span><br>
                                                    <span class="date">{{ \Carbon\Carbon::parse($new->created_at)->format('H:i:s d/m/Y')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="menu-blog">
                                    <div class="group-menu">
                                        <div class="sidebarblog-title title_block2">
                                            <h2>Danh mục blog<span class="fa fa-angle-down"></span></h2>
                                        </div>
                                        <div class="layered layered-category">
                                            <div class="layered-content">
                                                <ul class="tree-menu">
                                                    <li class="tree-title">
                                                        <a class="" href="/" title="Trang chủ" target="_self">
                                                            Trang chủ
                                                        </a>
                                                    </li>
                                                    <li class="tree-title">
                                                        <span class="tree-title-shop">Shop - </span>
                                                        <ul class="tree-menu-sub">
                                                            @each('frontend.inc.nav', $menuProdList, 'menuProd')
                                                        </ul>
                                                    </li>
                                                    <li class="tree-title">
                                                        <a href="/san-pham-khuyen-mai" title="Khuyến Mãi" target="_self">
                                                            Khuyến Mãi
                                                        </a>
                                                    </li>
                                                    <li class="tree-title">
                                                        <a href="{{ route('aboutus') }}" title="Giới thiệu" target="_self">
                                                            Giới thiệu
                                                        </a>
                                                    </li>
                                                    @each('frontend.inc.news_menu', $menuList, 'menu')
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($cateInfo)
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 pd5  ">
                            <div class="heading-page clearfix">
                                <h1>{{ $cateInfo->title }}</h1>
                            </div>
                            <div class="blog-content">
                                <div class="list-article-content blog-posts">
                                    <!-- Begin: Nội dung blog -->
                                    @foreach($newList as $new)
                                        <article class="blog-loop mt-3">
                                            <div class="blog-post row">
                                                <div class="col-md-4 col-xs-12 col-sm-12">
                                                    <a href="{{route('news-detail', $new->slug)}}"
                                                       class="blog-post-thumbnail"
                                                       title="{{$new->title}}"
                                                       rel="nofollow">
                                                        <img class=" lazyloaded" data-src=""
                                                             src="{{asset($new->thumbnail)}}"
                                                             alt="{{$new->title}}">
                                                    </a>
                                                </div>
                                                <div class="col-md-8 col-xs-12 col-sm-12">
                                                    <h3 class="blog-post-title">
                                                        <a href="{{route('news-detail', $new->slug)}}"
                                                           title="{{$new->title}}">{{$new->title}}</a>
                                                    </h3>
                                                    <div class="blog-post-meta">
                                                        <span class="author vcard">{{$new->user->name}}</span>
                                                        <span class="date-a">
                                                            <time pubdate=""
                                                                  datetime="2023-01-07">{{$new->created_at}}</time>
                                                        </span>
                                                    </div>
                                                    <p class="entry-content">{{$new->description}}</p>
                                                    <a class="read-more" href="{{route('news-detail', $new->slug)}}">Xem
                                                        thêm</a>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                                <nav class="accessory-pagination">
                                    {{$newList->links('frontend.inc.pagination')}}
                                </nav>
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
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection
