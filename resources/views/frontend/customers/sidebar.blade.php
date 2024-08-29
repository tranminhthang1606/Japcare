@php
    $customer= null;
    if(\Illuminate\Support\Facades\Auth::guard('customer')->check()){
        $customer =  Auth::guard('customer')->user();
    }
@endphp

<nav class="nav profile-info user-nav sidebar bg-white mb-3">
    <div class="avatar">
        @if($customer->avatar)
            <img src="{{asset($customer->avatar)}}" alt="avatar">
        @else
            <img src="{{asset('frontend/images/default-avatar-1.png')}}" alt="avatar">
        @endif
    </div>
    <h3 class="profile-name">{{ $customer->full_name }}</h3>
    <p class="profile-gender">Giới tính: <span>{{ $customer->sex }}</span></p>
</nav>
<nav class="nav user-nav sidebar bg-white mb-3">
    <a class="nav-link{{ $link == 'info' ? ' active' : '' }}" href="{{ route('customer.info') }}">
        <span>Thông tin chung</span>
{{--        <i class="fa-solid fa-arrow-right" style="color: #ee3c96;"></i>--}}
    </a>
    <a class="nav-link{{ $link == 'profile' ? ' active' : '' }}" href="{{ route('profile') }}">
        <span>Cập nhật hồ sơ</span>
    </a>
    <a class="nav-link " href="">
        <span>Sổ địa chỉ</span>
    </a>
    <a class="nav-link" href="{{ route('purchase_history') }}">
        <span>Lịch sử mua hàng</span>
    </a>
    <a class="nav-link" href="{{ route('logout') }}">
        <span>Đăng xuất</span>
    </a>
</nav>

