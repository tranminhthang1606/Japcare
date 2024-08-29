<!-- Top Bar Start -->
@php
    $generalsetting = \App\Models\Setting::first();
@endphp
<div class="topbar">
    <nav class="navbar-custom">
        <ul class="list-inline float-right mb-0">
            <!-- User-->
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    @if(isset(Auth::user()->avatar))
                        <img src="{{ asset(Auth::user()->avatar) }}" alt="user" class="rounded-circle" />
                    @else
                        <img src="{{asset('images/users/avatar-1.jpg')}}" alt="user" class="rounded-circle" />
                    @endif
                        <span>{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <a class="dropdown-item" href="{{ url('/admin/admin/' . Auth::user()->id ) . '/edit'}}">
                        <i class="dripicons-user text-muted"></i> Thông tin cá nhân
                    </a>
                    <a class="dropdown-item" href="{{ url('/admin/settings' ) }}"><i class="dripicons-gear text-muted"></i>Cài đặt hệ thống</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('auth.logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="dripicons-exit text-muted"></i> Đăng xuất
                    </a>

                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>

        <!-- Page title -->
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 id="btn-fullscreen" class="page-title ">
                    CMS {{ $generalsetting->st_name_site }}
                </h3>
            </li>
        </ul>

        <div class="clearfix"></div>
    </nav>

</div>
<!-- Top Bar End -->
