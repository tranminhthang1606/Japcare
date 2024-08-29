@extends('frontend.layouts.master')
@section('title', 'Liên hệ')

@section('content')
    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">Trang chủ</a>
                </li>
                <li class="breadcrumb-item">Liên hệ</li>
            </ol>
        </nav>
        <h1 class="title-page">Liên hệ</h1>
        <div class="main-content">
            <div class="row">
                <div class="col-lg col-12 order-lg-1">
                    <div class="contact-map mb-3">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.070984752633!2d105.77863616540232!3d21.02984554311606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31345536df57f8b5%3A0x7e8fb218dbee849d!2zVMOyYSBuaMOgIElETUMgTeG7uSDEkMOsbmggMQ!5e0!3m2!1sen!2s!4v1660293208758!5m2!1sen!2s"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 col-12 order-lg-0 ">
                    <form class="contact-form" action="{{ route('send_contact') }}" method="post">
                        @include ('frontend.partials.messages')
                        <div class="row mb-3">
                            <label for="your-name" class="col-12 mb-2 col-lg-3 mt-2 contact-label">Tên của bạn <span
                                    class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Nhập họ tên" id="your-name"
                                       name="full_name" data-parsley-required-message="Vui lòng nhập tên của bạn"
                                       required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="your-email" class="col-12 col-lg-3 mt-2 mb-2 contact-label">Email <span
                                    class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" placeholder="Nhập email" id="your-email"
                                       name="email" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="your-phone" class="col-12 col-lg-3 mt-2 mb-2 contact-label">Số điện thoại <span
                                    class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Nhập số điện thoại" id="your-phone" name="phone_number" required>
                                @if ($errors->has('phone_number'))
                                    <span class="error" style="color: red; font-size: 11px;">
                                        {{ $errors->first('phone_number') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="your-messenger" class="col col-lg-3 mt-2 mb-2 contact-label">Địa chỉ</label>
                            <div class="col-md-9">
                                <input class="form-control" id="your-messenger" type="text"
                                          placeholder="Nhập nội dung" name="address">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="your-messenger" class="col col-lg-3 mt-2 mb-2 contact-label">Nội dung <span
                                    class="text-danger"> *</span></label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="your-messenger" rows="3"
                                          placeholder="Nhập nội dung" name="content_data" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-9 ms-auto">
                                <button type="submit" class="btn btn-primary text-uppercase py-3 px-3 mt-3 w-100">
                                    GỬI LIÊN HỆ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('form').parsley();
            $('.btn_login').on('click', function (e) {
                let form = $('#login_form');
                form.parsley().validate();
                if (form.parsley().isValid()) {
                    $('.btn_login').prop('disabled', true)
                    form.submit();
                }
            });

            $.ajax({
                type: 'GET',
                url: "{{ route('reloadCaptcha') }}",
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });

            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection
