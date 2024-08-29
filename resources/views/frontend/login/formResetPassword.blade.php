@extends('frontend.layouts.master')
@section('title', 'Đặt lại mật khẩu')

@section('content')
    <div class="wraper-paper">
        <div class="forget-password">
            <div class="forget_title">
                <h1>ĐẶT LẠI MẬT KHẨU</h1>
            </div>
            <div class="form_forget">
                @if (\Session::has('error'))
                    <div class="error_message">
                        {!! \Session::get('error') !!}
                    </div>
                @endif
                @if (\Session::has('success'))
                    <div class="success_message">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
                <form class="form-reset-password" id="reset_form" method="POST" action="{{route('submitResetPasswordForm')
                }}">
                    <input type="hidden" name="token" value="{{$token}}"/>
                    <div class="password mb-4">
                        <input class="form-reset" value="{{old('password')}}" data-parsley-required-message="Vui lòng
                        nhập mật khẩu"
                               data-parsley-minlength-message="Mật khẩu có ít nhất 6 ký tự" type="password"
                               name="password" placeholder="Mật khẩu ..." data-parsley-minlength="6" required>
                    </div>
                    <div class="password mb-4">
                        <input class="form-reset value="{{old('password_confirmation')}}"
                        data-parsley-required-message="Vui lòng xác nhận mật khẩu"
                        data-parsley-minlength-message="Mật khẩu xác nhận có ít nhất 6 ký tự" type="password"
                        name="password_confirmation" data-parsley-minlength="6"
                        placeholder="Xác nhận mật khẩu ..." required>
                    </div>
                    <div class="capcha">
                        <p>This site is protected by reCAPTCHA and the Google <a href="#">Privacy Policy</a> and
                            <a href="#">Terms of
                                Service</a> apply.
                        </p>
                    </div>
                    <button type="button" class="btn_reset">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('form').parsley();
            $('.btn_reset').on('click', function (e) {
                let form = $('#reset_form');
                form.parsley().validate();
                if (form.parsley().isValid()) {
                    $('.btn_reset').prop('disabled', true)
                    form.submit();
                }
            })
        });
    </script>
@endsection
