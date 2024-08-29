@extends('admins.layouts.masterlogin')

@section('content')
    @php
        $generalsetting = \App\Models\Setting::first();
    @endphp
    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center m-0">
                    <a href="{{ url('/') }}" class="logo logo-admin">
                        @if($generalsetting->admin_logo != null)
                            <img src="{{ asset($generalsetting->admin_logo) }}" class="brand-icon" alt="{{ $generalsetting->st_name_site }}" height="50px">
                        @endif
                    </a>
                </h3>

                <div class="p-3">
                    <h4 class="font-18 m-b-5 text-center">Welcome Back !</h4>
                    <p class="text-muted text-center">Sign in to continue to <b>{{ $generalsetting->st_name_site }}</b></p>

                    <form class="form-horizontal m-t-30" action="{{ route('auth.login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @if (Session::has('email'))
                            <div class="alert alert-info">{{ Session::get('email') }}</div>
                        @endif
                        <div class="form-group">
                            <label for="userpassword">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox form-check">
                                    <input class="custom-control-input form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div><!-- card-body -->
        </div>
    </div>
@endsection
