<div id="button-contact-vr">
    <div id="zalo-vr" class="button-contact">
        <div class="phone-vr">
            <div class="phone-vr-circle-fill"></div>
            <div class="phone-vr-img-circle">
                <a target="_blank" href="https://zalo.me/{{ $generalsetting->hotline }}">
                    <img src="{{asset('frontend/img/icon-zalo.png')}}" alt="liên hệ qua zalo" />
                </a>
            </div>
        </div>
    </div>

    <div id="phone-vr" class="button-contact">
        <div class="phone-vr">
            <div class="phone-vr-circle-fill"></div>
            <div class="phone-vr-img-circle">
                <a href="tel:{{ $generalsetting->hotline }}">
                    <img src="{{asset('frontend/img/icon-phone-help.png')}}" alt="liên hệ qua hotline" />
                </a>
            </div>
        </div>
    </div>
</div>
