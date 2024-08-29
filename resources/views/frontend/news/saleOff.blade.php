@extends('frontend.layouts.master')
@section('title', 'Khuyến mại')

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
                <p>
                    <a href="{{route('home')}}">Trang chủ</a>
                    <span class="separator"> > </span>
                    <span class="last">Khuyến mại</span>
                </p>
            </nav>
        </div>
    </div>

    <section class="news">
        <div class="container">
            <div class="row">
                <div class="col-md-3 nav_left">
                    <h2 class="title_news_tuetam" style="background-color: #F6B024; color: white">Khuyến mại mới nhất</h2>
                    <ul class="list_news_tuetam">
                        @if(isset($sale_off_sidebar))
                            @foreach($sale_off_sidebar as $sale_of_sb)
                                <li>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{asset($sale_of_sb->photos)}}" alt="Thumbnail bài viết" style="width: 80px;height: 70px">
                                        </div>
                                        <div class="col-md-8">
                                            <a href="{{route('news-detail', $sale_of_sb->slug)}}">
                                                @if(strlen($sale_of_sb->title) < 30)
                                                    {{$sale_of_sb->title}}
                                                @else
                                                    {{substr($sale_of_sb->title, 0, 40)}}...
                                                @endif
                                            </a>
                                            <div style="font-size: 15px; color: #a9a9a9">
                                                <small>Admin - </small>
                                                <small>{{date_format($sale_of_sb->created_at, 'd/m/y')}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-9 nav_right">
                    <div class="list_product product_category row row5">
                        @if(isset($sale_off))
                            @foreach($sale_off as $sale)
                                <div class="col-xs-6 col-md-3">
                                    <div class="item_product">
                                        <div class="box_image">
                                            <a href="{{route('news-detail', $sale->slug)}}">
                                                <img src="{{asset($sale->photos)}}" alt=""/>
                                            </a>
                                        </div>
                                        <div class="detail_news_tuetam">
                                            <h3>
                                                <a href="{{route('news-detail', $sale->slug)}}">
                                                    {{$sale->title}}
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="pagination_wrapper">
                        <div class="pagination">
                            @if(isset($sale_off) && !empty($sale_off))
                                {{ $sale_off->appends(request()->query())->render('frontend.paginator.index') }}
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
