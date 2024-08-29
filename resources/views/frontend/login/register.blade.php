@extends('frontend.layouts.master')
@section('title', 'Tạo tài khoản')
@section('styles')

@endsection
@section('content')
    @php
        $banners = \App\Models\Banner::all();
    @endphp
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 d-none d-sm-flex align-items-center ">
                    @foreach($banners as $banner)
                        @if($banner && $banner->type_show == "1" & $banner->status == "1")
                            <img class="register-banner" src="{{ asset('frontend/images/') }}/banner-register.png"
                                 alt="Mua sản phẩm mỹ phẩm, thực phẩm chức năng chính hãng tại Japcare">
                        @endif
                    @endforeach
                </div>
                <div class="col-12 col-lg-6 login-box">
                    <h1>Japcare xin chào!</h1>
                    <p class="mb-3">Nhập các thông tin để đăng ký tài khoản</p>
                    <form action="{{route('registerPost')}}" method="post" class="form-register" id="register-form">
                        @csrf
                        @include ('frontend.partials.messages')
                        <div class="form-group">
                            <label for="fullname" class="form-label">Họ và tên<span
                                    class="text-danger"> *</span></label>
                            <input type="text" id="fullname" name="fullname" value="{{old('fullname')}}"
                                   placeholder="Họ &amp; tên (VD: Nguyễn Văn Anh)"
                                   class="form-control" data-parsley-required-message="Vui lòng nhập họ và tên"
                                   required>
                        </div>
                        <div class="gender mb-4 d-flex">
                            <div class="gender_male">
                                <input id="male" type="radio" name="sex"
                                       value="MALE" {{ old('sex') == 'MALE' ? 'checked' : ''}}>
                                <label for="male">Nam</label>
                            </div>
                            <div class="gender_female">
                                <input id="female" type="radio" name="sex"
                                       value="FEMALE" {{ old('sex') == 'FEMALE' ? 'checked' : ''}}>
                                <label for="female">Nữ</label>
                            </div>
                            <div class="gender_female">
                                <input id="unknow" type="radio" name="sex"
                                       value="UNKNOW" {{ old('sex') == 'UNKNOW' ? 'checked' : ''}}>
                                <label for="unknow">Không xác định</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="form-label">Số điện thoại
                                <span class="text-danger"> *</span>
                            </label>
                            <input id="phone_number" name="phone_number" type="text" class="form-control"
                                   placeholder="Số điện thoại"
                                   value="{{old('phone_number')}}"
                                   data-parsley-required-message="Vui lòng nhập số điện thoại"
                                   onChange="inputPhoneTyping()" required>
                        </div>
                        <div class="form-group position-relative">
                            <label for="your_pwd" class="form-label">
                                Mật khẩu<span class="text-danger"> *</span>
                            </label>
                            <div class="input-password-group">
                                <input type="password" name="password" placeholder="Mật khẩu (Tối thiểu 6 ký tự)"
                                       id="your_pwd"
                                       class="form-control" autocomplete="off" minlength="6" maxlength="20" required
                                       data-parsley-required-message="Vui lòng nhập mật khẩu"
                                       data-parsley-minlength-message="Mật khẩu có ít nhất 6 ký tự"
                                >
                                <a href="javascript:void(0)" class="show-password" type="button">
                                    <i class="far fa-eye" style="color: #969696;"></i>
                                    <i class="far fa-eye-slash" style="color: #000;"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group position-relative">
                            <label for="pwd_confirm" class="form-label">
                                Nhập lại mật khẩu<span class="text-danger"> *</span>
                            </label>
                            <div class="input-password-group">
                                <input type="password" name="password_confirm" placeholder="Nhập lại mật khẩu"
                                       id="pwd_confirm" class="form-control" autocomplete="off" required
                                       data-parsley-required-message="Vui lòng xác nhận mật khẩu"
                                       data-parsley-equalto="#your_pwd"
                                       data-parsley-equalto-message="Mật khẩu nhập lại không khớp"
                                >
                                <a href="javascript:void(0)" class="show-password" type="button">
                                    <i class="far fa-eye" style="color: #969696;"></i>
                                    <i class="far fa-eye-slash" style="color: #000;"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="your-email" class="form-label">Email</label>
                            <input id="your-email" type="email" name="email" class="form-control"
                                   value="{{old('email')}}"
                                   placeholder="Email (VD: anhnguyenvan@gmail.com)"
                                   data-parsley-email-message="Email không đúng định dạng">
                        </div>
                        <div class="form-group">
                            <label for="birthdate" class="form-label">Ngày sinh</label>
                            <input id="birthdate" type="date" name="birthdate" class="form-control"
                                   value="{{old('birthdate')}}"
                                   placeholder="1990/01/30">
                        </div>
                        <div class="form-group">
                            <label style="color: #454D71;">
                                <input id="agree_check" type="checkbox" name="agree_check" checked>
                                <span class="checkmark"></span>
                                <span>Tôi đồng ý và chấp nhận </span>
                                <a class="policy" href="#" target="_blank">chính sách thanh toán</a> và
                                <a class="policy" href="#" target="_blank">chính sách bảo mật thông tin</a>
                            </label>
                        </div>
                        <div class="form-group">
                            <button id="btn_register" class="btn btn-primary p-3 text-uppercase w-100" type="submit">
                                Đăng ký
                            </button>
                            <p class="text-center" style="padding-top: 10px">
                                Bạn đã có tài khoản?
                                <a href="{{ route('login') }}">
                                    <i class="fa-solid fa-hand-point-right"></i> Đăng nhập
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type='text/javascript' src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type='text/javascript'
            src="{{asset('frontend/js/bootstrap-datetimepicker.vi.js')}}?v={{ config('user.version') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('form').parsley();
            $('#btn_register').on('click', function (e) {
                let form = $('#register-form');
                form.parsley().validate();
                if (form.parsley().isValid()) {
                    $('#btn_register').prop('disabled', true)
                    form.submit();
                }
            });

            //birthdate
            $('#birthday').datepicker({
                dateFormat: 'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: '-73y:-15y',
                language: 'vi'
            });

            $('.show-password').on('click', function () {
                $(this).toggleClass('active');
                if ($(this).parent().find('input').attr('type') == 'password') {
                    $(this).parent().find('input').attr('type', 'text');
                } else {
                    $(this).parent().find('input').attr('type', 'password');
                }
            });

            $('#agree_check').change(function () {
                if (this.checked) {
                    $("#btn_register").prop("disabled", false);
                } else {
                    $("#btn_register").prop("disabled", true);
                }
            });

        });
    </script>
@endsection
