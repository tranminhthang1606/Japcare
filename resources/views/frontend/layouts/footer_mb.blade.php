<!--Footer Mobile-->
<footer id="footer" class="block-footer block-footer footer-mobile">
    <div class="main-footer footer-mobile">
        <div class="container-fluid">
            <section class="register-japcare-text">
                <p class="register-japcare">Đăng ký theo dõi bestme</p>
                <p>Để nhận các thông tin hữu ích nhất</p>
                <div class="input-group mb-3">
                    <input type="email" required="" class="form-control" name="subscribe_email"
                           placeholder="Nhập email của bạn" aria-label="Nhập email của bạn" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary btn-submit-email-register" type="button" id="button-addon2">
                        <img style="width: 16px; height: 16px" src="{{ asset('frontend/images/email-footer_1.png') }}"
                             alt="icon">
                    </button>
                </div>
            </section>
            <div class="row">
                <div class="col-sm-12 footer-title-address">
                    <div class="d-flex phone-mail pt-3" style="justify-content: space-between;">
                        <p class="d-flex font-weight-bold">
                            <span>
                                <img width="15" height="15" class="pr-3" src="{{ asset('frontend/images/phone-footer_1.png') }}" alt="icon">
                            </span>
                            <span>
                                <a class="font-weight-bold" href="tel:{{ $generalsetting->phone }}">{{ $generalsetting->phone }}</a>
                            </span>
                        </p>
                        <p class="d-flex font-weight-bold">
                            <span><img width="15" height="15" class="pr-3" src="{{ asset('frontend/images/email-footer_1.png') }}" alt="icon">
                                <a class="font-weight-bold" href="mailto:{{ $generalsetting->email }}">{{ $generalsetting->email }}</a>
                            </span>
                        </p>
                    </div>
                    <p class="d-flex info-foo">
                        <span class="col-1">
                            <img width="30" height="30" src="{{ asset('frontend/images/address-footer_1.png') }}" alt="icon">
                        </span>
                        <span class="ms-auto">Địa chỉ: 18 Tôn Thất Thuyết, Mỹ Đình, Hà Nội</span>
                    </p>
                    <p class="d-flex">
                        <img class="img-fluid" src="{{ asset('frontend/images/cart-footer.png') }}"
                             alt="icon" style="width: 18px; height: 18px;margin-right: 10px;">
                        <span>
                            Bestme được DHC Việt Nam ủy quyền phân phối sản phẩm
                            <a rel="dofollow" class="link-dhc" target="_blank" href="#">
                                DHC
                            </a> chính hãng
                        </span>
                    </p>
                </div>
                <div class="view-show-footer policy-footer-title">
                    <div class="col-lg-3 mb-3 ft-col ps-lg-5">
                        <ul class="nav flex-column">
                            <li>
                                <a rel="nofollow" href="#"
                                   class="nav-link px-0">Hướng dẫn mua hàng</a>
                            </li>
                            <li>
                                <a rel="nofollow" href="#"
                                   class="nav-link px-0">Chính sách bảo mật thông tin</a>
                            </li>
                            <li>
                                <a rel="nofollow" href="#" class="nav-link px-0">Chính sách bán hàng</a>
                            </li>
                            <li>
                                <a rel="nofollow" href="#"
                                   class="nav-link px-0">Chính sách đổi/ trả hàng</a>
                            </li>
                            <li>
                                <a rel="nofollow" href="#"
                                   class="nav-link px-0">Chính sách vận chuyển</a>
                            </li>
                            <li>
                                <a rel="nofollow" href="#"
                                   class="nav-link px-0">Chính sách thanh toán</a>
                            </li>
                            <li>
                                <a rel="nofollow" href="#"
                                   class="nav-link px-0">Chính sách kiểm hàng</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-12 mb-3 ft-col ps-lg-5">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('aboutus') }}" class="nav-link px-0">Về chúng tôi</a>
                            </li>
                        </ul>
                        <div class="d-flex mt-4 justify-content-center">
                            <a href="#" class="me-3">
                                <img src="{{ asset('frontend/images/facebook.svg') }}" alt="">
                            </a>
                            <a href="#" class="me-3">
                                <img src="{{ asset('frontend/images/instagram.svg') }}" alt="">
                            </a>
                            <a href="#" class="me-3">
                                <img src="{{ asset('frontend/images/youtube.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <button class="view-more-footer open-show">Xem thêm</button>
                <button class="view-more-footer close-show">Thu gọn</button>
            </div>
            <div class="row">
                <div class="col-lg-3 mb-3 ft-col">
                    <div class="text-center">
                        <a href="{{ route('home') }}">
                            <img class="logo"  src="{{ asset('frontend/images/logowhite.png') }}" title="" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p style="margin-bottom: 0">Thông tin trên website bestme.vn chỉ mang tính chất tham khảo, không phải và
            không thay thế cho tư vấn, chẩn đoán hoặc điều trị y khoa.
            Khi gặp vấn đề về sức khỏe, khách hàng hãy liên hệ với bác sĩ hoặc cơ sở y tế gần nhất!</p>
        <span>
            Giấy chứng nhận đăng kí kinh doanh số 0109863389 do Sở kế hoạch và đầu tư Thành phố Hà Nội cấp ngày
            20/12/2021
        </span>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>