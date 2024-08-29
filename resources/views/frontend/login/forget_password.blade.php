@extends('frontend.layouts.master')
@section('title', 'Quên mật khẩu')
@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 d-none d-sm-flex align-items-center ">
                    <img class="forgetpw-img" src="{{ asset('frontend/images/') }}/banner-register.png"
                         alt="Mua sản phẩm mỹ phẩm, thực phẩm chức năng chính hãng tại Japcare">
                </div>
                <div class="ol-12 col-lg-6 login-box forget-pw">
                    <h3>Quên mật khẩu?</h3>
                    <p>Nhập Email đã đăng ký của bạn để nhận hướng dẫn đổi mật khẩu.</p>
                    <form action="{{route('sendMailUpdatePass')}}" method="post" class="form-register" id="form-forgot-password">
                        @csrf
                        @include ('frontend.partials.messages')

                        <div class="mb-3">
                            <input name="email" type="text" value="{{old('email')}}" class="form-control" data-parsley-required-message="Vui lòng nhập email"
                                   data-parsley-email-message="Email không đúng định dạng" parsley-type="email"
                                   placeholder="Email ..." required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button id="btn_forget" class="btn btn-primary p-3 mt-2 text-uppercase w-100" type="submit">
                                    CẤP LẠI MẬT KHẨU
                                </button>
                            </div>
                            <div class="col-lg-6">
                                <button type="reset" class="btn p-3 mt-2 w-100 close">
                                    Hủy bỏ
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
        jQuery(document).ready(function ($) {
            $('form').parsley();

            $('#btn_forget').on('click', function (e) {
                let form = $('#form-forgot-password');
                form.parsley().validate();
                if (form.parsley().isValid()) {
                    $('#btn_forget').prop('disabled', true)
                    form.submit();
                }
            })
        });
    </script>
@endsection
