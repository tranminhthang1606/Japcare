@extends('frontend.layouts.master')
@section('title', isset($page) ? $page->title_page: 'Chính sách')
@section('description', isset($page) ? $page->meta_description: 'Chính sách')
@section('keywords', isset($page) ? $page->title_page: 'Chính sách')
@section('meta_keywords', isset($page) ? $page->meta_title: 'Chính sách')
@section('meta_description', isset($page) ? $page->meta_description: 'Chính sách')

@section('content')
    <main id="main-wrapper">
        <div class="main-content pb-3">
            <div class="page-banner my-lg-4 my-3 page-banner-with-image">
                <div class="container text-center text-white py-lg-4 py-3">
                    <h1 class="mt-lg-4 mt-3">{{$page->title_page}}</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb mx-auto d-block">
                        <ol class="breadcrumb policy">
                            <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$page->meta_title}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="wrap-auth-form col-12 col-lg-7 mx-auto mb-5">
                <div class="mail-success text-justify px-3 pb-4 px-lg-5 bg-white">
                    {!! html_entity_decode($page->content) !!}
                </div>
            </div>
        </div>
    </main>
@endsection

