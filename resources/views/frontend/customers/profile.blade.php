@extends('frontend.layouts.master')
@section('title', 'Hồ sơ')

@section('content')
    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item promotion"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item promotion active"><span class="breadcrumb-item">Tài khoản</span></li>
                <li class="breadcrumb-item promotion active">Cập nhật hồ sơ</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12 col-lg-3">
                @include('frontend.customers.sidebar', ['link'=>'profile'])
            </div>
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel bg-white p-3">
                            <p class="fw-bold">
                                <span class="title fz-16 mr-2">Hồ sơ khách hàng</span>
                            </p>
                            <form class="row bv-form" action="" id="formEditInfoCustomer" method="post"
                                  enctype="multipart/form-data">
                                <div class="col-lg-6">
                                    <div class="col-lg-12 info-user">
                                        <label for="full_name" class="form-label profile">Họ và tên</label>
                                        <input type="text" name="full_name" data-value="Nguyễn Thành Chung"
                                               class="form-control" value="{{$customer->full_name}}" id="full_name"
                                               placeholder="Vui lòng nhập họ và tên">
                                    </div>
                                    <div class="gender mb-4 d-flex">
                                        <div class="gender_male">
                                            <input id="male" type="radio" name="sex"
                                                   value="MALE" {{$customer->sex == 'MALE' ? 'checked' : ''}}>
                                            <label for="male">Nam</label>
                                        </div>
                                        <div class="gender_female">
                                            <input id="female" type="radio" name="sex" value="FEMALE"
                                                {{$customer->sex == 'FEMALE' ? 'checked' : '' }}>
                                            <label for="female">Nữ</label>
                                        </div>
                                        <div class="gender_female">
                                            <input id="unknow" type="radio" name="sex" value="UNKNOW"
                                                {{$customer->sex == 'UNKNOW' ? 'checked' : ''}}>
                                            <label for="unknow">Không xác định</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 info-user">
                                        <label for="birthday" class="form-label profile">Ngày sinh</label>
                                        <input type="date" name="birthdate"
                                               value="{{$customer->birthdate}}"
                                               class="form-control"
                                               id="birthday" placeholder="Chọn ngày sinh của bạn"
                                               data-bv-field="birthday">
                                    </div>
                                    <div class="col-lg-12 info-user">
                                        <label for="email" class="form-label profile">Email</label>
                                        <input type="text" class="form-control" name="email"
                                               value="{{$customer->email}}"
                                               id="email" placeholder="Vui lòng nhập email">
                                    </div>
                                    <div class="col-lg-12 info-user">
                                        <label for="telephone" class="form-label profile">Số điện thoại</label>
                                        <input type="text" class="form-control input-disable"
                                               value="{{$customer->phone}}"
                                               id="telephone" disabled="">
                                    </div>
                                    <div class="col-12">
                                        <button style="border-radius: 8px" type="submit" disabled="disabled"
                                                class="btn btn-primary">Gửi
                                        </button>
                                    </div>
                                </div>

                                <div class="col-lg-6 profile-avatar-user">
                                    <div class="img-user">
                                        <label for="imgInp">
                                            <img id="blah" src="{{$customer->avatar}}" alt="your image"/>
                                        </label>
                                        <input type='file' id="imgInp" hidden/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function () {
            readURL(this);
        });
    </script>
@endsection
