@extends('frontend.layouts.master')
@section('title', 'Trang chủ')

@section('content')
    @include('frontend.main_'.$_isDerive, ['slider_home' => $slider_home])
@endsection
