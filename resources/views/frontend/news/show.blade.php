@extends('frontend.layouts.master')
@section('title', $newsDetail->title)
@section('description', $newsDetail->description)
@section('keywords', $newsDetail->title)
@section('meta_keywords', $newsDetail->meta_title)
@section('meta_description', $newsDetail->meta_description)

@section('content')
    <main id="main" class="site-main" role="main">
        <div class="pageAbout-us">
            <div class="wrapper-row pd-page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 pd5">
                            <div class="sidebar-blog">
                                <div class="menu-blog">
                                    <div class="group-menu">
                                        <div class="sidebarblog-title title_block">
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
                                                        <a href="{{ route('aboutus') }}" title="Giới thiệu"
                                                           target="_self">
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
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 pd5">
                            <div class="content-page">
                                <div class="artice-content">
                                    <div class="box-article-heading clearfix">
                                        <div class="background-img">
                                            <img src="{{asset($newsDetail->photos)}}"
                                                 alt="{{$newsDetail->title}}">
                                        </div>
                                        <h1 class="sb-title-article">{{$newsDetail->title}}</h1>
                                        <ul class="article-info-more">
                                            <li>{{$newsDetail->user->name}} lúc
                                                <time pubdate=""
                                                      datetime="">{{$newsDetail->created_at}}</time>
                                            </li>
                                            <li>
                                                <i class="fa-regular fa-newspaper"></i>
                                                <a href="#">{{$newsDetail->articleCategory->title}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="article-pages">
                                        {!! html_entity_decode($newsDetail->content) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            $('.sidebarblog-title').on('click', function () {
                $('.layered ').toggle('500');
            })

            $('.shopdown').on('click', function () {
                $('.tree-menu-sub ').toggle('500');
            })

            $('.title_block1 ').on('click', function () {
                $('.item-article').toggle('500');
            })

            $('.title_block2').on('click', function () {
                $('.layered').toggle('500');
            })

            $('.tree-title-shop').on('click', function () {
                $('.tree-menu-sub').toggle('500');
            })
        })
    </script>
@endsection
