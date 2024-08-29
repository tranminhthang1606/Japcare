<h1>Lấy lại mật khẩu</h1>
<p>Xin chào {{$full_name}}</p>
<p>
    Quý khách đã gửi yêu cầu lấy lại mật khẩu tại
    <a href="{{route('home')}}">Japcare.vn</a>
</p>
<p>
    Vui lòng nhấn vào link: <a href="{{ route('showResetPasswordForm', $token)
    }}"><strong>{{ route('showResetPasswordForm', $token)
    }}</strong></a>
    để hoàn tất việc thiết lập lại mật khẩu.
</p>
<p>
    Mọi ý kiến và thắc mắc xin vui lòng liên hệ bộ phận hỗ trợ của <strong>Japcare.vn</strong>
    để được giải đáp lắng nghe những góp ý từ Bạn.
</p>
<p>Trân trọng cảm ơn!</p>

