@extends('frontend.layouts.master')
@section('content')
    <div class="searchPage" id="layout-search">
        <div class="container">
            <div class="row pd-page">
                <div class="col-lg-12 col-md-12">
                    <div class="heading-page">
                        <h1>Tìm kiếm</h1>
                    </div>
                    <div class="search-field search-page">
                        <form class="search-page" action="/tim-kiem">
                            <input type="text" name="keyword" class="search_box" placeholder="Tìm kiếm" value="" required>
                            <button type=""><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="message-txt">
                        <p>Rất tiếc, chúng tôi không tìm thấy kết quả cho từ khóa của bạn</p>
                        <p>Vui lòng kiểm tra chính tả, sử dụng các từ tổng quát hơn và thử lại!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
