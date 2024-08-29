<!--Footer PC-->
<footer id="footer" class="block-footer block-footer footer-pc">
    <div class="main-footer bg-white py-4 py-lg-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-3 ft-col">
                    <a href="{{ route('home') }}">
                        <img class="bct" width="150" src="{{ asset($generalsetting->admin_logo) }}" alt="">
                    </a>
                </div>
                <div class="col-lg-3 mb-3 ft-col info-foo">
                    <p class="fz-20 mb-3 fw-bold">{{ $generalsetting->st_name_site}}</p>
                    <p class="d-flex">
                        <span class="col-1">
                            <i class="fa-solid fa-phone"></i>
                        </span>
                        <span class="ms-auto">
                            <a href="tel:{{$generalsetting->phone}}">{{$generalsetting->phone}}</a>
                        </span>
                    </p>
                    <p class="d-flex">
                        <span class="col-1">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <span class="ms-auto">
                            <a href="mailto:{{ $generalsetting->email }}">{{ $generalsetting->email }}</a>
                        </span>
                    </p>
                    <p class="d-flex">
                        <span class="col-1">
                            <i class="fa-solid fa-location-dot"></i>
                        </span>
                        <span class="ms-auto">{{ $generalsetting->address }}</span>
                    </p>
                    <p class="d-flex">
                        <span class="col-1">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </span>
                        <span class="ms-auto">{!! $generalsetting->footer_about !!}</span>
                    </p>
                </div>
                <div class="col-lg-3 mb-3 ft-col ps-lg-5">
                    <div class="button view-more-footer">
                        <p class="fz-20 mb-3 fw-bold">Chính sách</p>
                        <ul class="nav flex-column">
                            <li>
                                <a href="{{route('termOfService')}}" rel="nofollow" class="nav-link px-0">Hướng dẫn mua
                                    hàng</a>
                            </li>
                            <li>
                                <a href="{{route('privacyPolicy')}}" rel="nofollow" class="nav-link px-0">Chính sách bảo mật thông tin</a>
                            </li>
                            <li>
                                <a href="{{route('sellPolicy')}}" rel="nofollow" class="nav-link px-0">Chính sách bán hàng</a>
                            </li>
                            <li>
                                <a href="{{route('warrantyExchange')}}" rel="nofollow" class="nav-link px-0">Chính sách đổi/ trả hàng</a>
                            </li>
                            <li>
                                <a href="{{route('deliveryPolicy')}}" rel="nofollow" class="nav-link px-0">Chính sách vận chuyển</a>
                            </li>
                            <li>
                                <a href="{{route('purchasePay')}}" rel="nofollow" class="nav-link px-0">Chính sách
                                    thanh
                                    toán</a>
                            </li>
                            <li>
                                <a href="{{route('pricePolicy')}}" rel="nofollow" class="nav-link px-0">Chính sách
                                    kiểm hàng</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-12 mb-3 ft-col ps-lg-5">
                    <p class="fz-20 mb-3 fw-bold">Liên kết nhanh</p>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('aboutus') }}" rel="nofollow" class="nav-link px-0">Về chúng tôi</a>
                        </li>
                    </ul>
                    <section id="register-japcare">
                        <p class="register-japcare">Đăng ký theo dõi</p>
                        <p>Để nhận các thông tin hữu ích nhất</p>
                        <div class="input-group mb-3">
                            <input type="email" required="" class="form-control" name="subscribe_email"
                                   placeholder="Nhập email của bạn" aria-label="Nhập email của bạn"
                                   aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary btn-submit-email-register" type="button" id="button-addon2">
                                <img src="{{ asset('frontend/images/email-footer_1.png') }}" alt="icon">
                            </button>
                        </div>
                    </section>
                    <div class="d-flex mt-4 justify-content-center">
                        <a href="{{ $generalsetting->tiktok }}" target="_blank" class="me-3">
                            <img src="{{ asset('frontend/images/tiktok.svg') }}" alt="">
                        </a>
                        <a href="{{ $generalsetting->facebook }}" target="_blank" class="me-3">
                            <img src="{{ asset('frontend/images/facebook.svg') }}" alt="">
                        </a>
                        <a href="{{ $generalsetting->instagram }}" target="_blank" class="me-3">
                            <img src="{{ asset('frontend/images/instagram.svg') }}" alt="">
                        </a>
                        <a href="{{ $generalsetting->youtube }}" target="_blank" class="">
                            <img src="{{ asset('frontend/images/youtube.svg') }}" alt="">
                        </a>
                    </div>
                    <div class="d-flex ecommerce pt-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        {!! $generalsetting->copyright !!}
    </div>

    <div class="modal fade" id="confirmSubscribe" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông báo đăng ký theo dõi</h5>
                </div>
                <div class="modal-body">
                    Đăng ký theo dõi thành công!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>