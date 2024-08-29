@extends('frontend.layouts.master')
@section('title', 'Chi tiết khuyến mại')

@section('content')

    <section class="banner">
        <img src="{{ asset('frontend/upload/images/post/banner_news.jpg') }}" alt="Chi tiết khuyến mại"/>
    </section>

    <section class="news">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(isset($sale_off))
                        <div class="header">
                            <div class="left">
                                <h1 class="title_news">{{$sale_off->title}}</h1>
                            </div>
                            <div class="right">
                                <span class="author_date"><i class="fa fa-user" aria-hidden="true"></i> {{$sale_off->user->name}}</span>
                                <span class="author_date"><i class="fa fa-calendar"
                                                             aria-hidden="true"></i> {{date_format($sale_off->created_at, 'd/m/y')}}</span>
                                {{--                                <span class="author_date"><i class="fa fa-eye" aria-hidden="true"></i> 979</span>--}}
                            </div>
                        </div>
                        <div class="detail_news">
                            {!! html_entity_decode($sale_off->content) !!}
                        </div>
                        <hr/>
                    @endif
                </div>
                <div class="col-md-4 detail_sidebar">
                    <div class="sidebar">
                        <h3 class="title_sidebar">Bài viết liên quan</h3>
                        <div class="list_news">
                            <div class="item_news">
                                <a href="#" class="box_image">
                                    <img
                                        src="{{ asset('frontend/upload/images/post/Web%20-%20Th%c6%b0%20m%e1%bb%9di%20-%20H%e1%bb%99i%20ch%e1%bb%a3%20Ambiente%20Frankfurt%202020.jpg')}}"
                                        alt="Eco"
                                    />
                                </a>
                                <h4>
                                    <a href="#">Eco Bamboo Việt Nam có mặt tại Hội chợ Ambiente Frankfurt 2020 từ 7/2/2020 - 11/2/2020
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="partner">
        <div class="container">
            <div class="title">
                <h3>Đối tác - Khách hàng</h3>
            </div>
            <div id="logo_partner">
                <a class="item" href="#" target="_blank">
                    <img src="{{ asset('frontend/upload/images/partner/mainfreight.png')}}" alt="Mainfreight Vietnam "/>
                </a>
                <a class="item" href="#" target="_blank">
                    <img src="{{ asset('frontend/upload/images/ups%20freight.png')}}" alt="Ups"/>
                </a>
                <a class="item" href="#" target="_blank">
                    <img src="{{ asset('frontend/upload/images/VCCI.png')}}"
                         alt="Vietnam Chamber of Commerce and Industry (VCCI)"/>
                </a>
                <a class="item" href="#" target="_blank">
                    <img src="{{ asset('frontend/upload/images/oxfam_logo_horizontal_green_rgb.png')}}" alt="Oxfam"/>
                </a>
            </div>
        </div>
    </section>

@endsection
