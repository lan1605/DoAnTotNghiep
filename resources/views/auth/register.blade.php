@extends('layouts.app')
@section('title')
{{__('Đăng ký người dùng')}}
@endsection
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @guest
        @if (Route::has('login'))
            <a class="btn btn-white btn-sm px-4 radius-30" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
        @endif
        @if (Route::has('register'))
            <a class="btn btn-primary btn-sm px-4 radius-30" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
        @endif
    @else
    {{''}}
    @endguest
      </div>
    @endsection
@section('content')
<main class="authentication-content">
    <div class="container">
        <div class="mt-4">
            <div class="card rounded-0 overflow-hidden shadow-none bg-white border">
                <div class="row g-0">
                    <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
                        <img src="assets/images/error/auth-img-register3.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-12 col-xl-4 order-xl-2">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title">{{ __('Đăng ký tài khoản') }}</h5>
                            <div class="card-body">
                                {{-- @isset($route)
                                
                                @else 
                                @endisset --}}
                                {{-- <form method="POST" action="{{ route('giang-vien.register-view') }}"> --}}
                                    <form method="POST" action="{{ route('register') }}">
                                    @csrf
            
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="name" class="form-label">{{ __('Tên người dùng') }}</label>
                                            <div class="ms-auto position-relative">
                                                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                                                <input id="name" type="text" class="radius-30 ps-5 form-control @error('name') is-invalid  @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nhập tên tài khoản...">
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="email" class="form-label">{{ __('Địa chỉ Email') }}</label>
                                            <div class="ms-auto position-relative">
                                                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                                                <input id="email" type="email" class="radius-30 ps-5 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Nhập địa chỉ email...">
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="password" class="form-label">{{ __('Mật khẩu') }}</label>
                                            <div class="ms-auto position-relative">
                                                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                                <input id="password" type="password" class="radius-30 ps-5 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Nhập mật khẩu...">
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert" style="display: block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="password-confirm" class="form-label">{{ __('Xác nhận mật khẩu') }}</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                            <input id="password-confirm" type="password" class="form-control radius-30 ps-5" name="password_confirmation" required autocomplete="new-password" placeholder="Nhập lại mật khẩu...">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="d-grid">
                                            <button type="submit" class="btn btn-primary radius-30">{{ __('Đăng ký tài khoản') }}</button>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="mb-0">Bạn đã có tài khoản?
                                                @if (Route::has('login'))
                                                    <a  href="{{ route('login') }}">{{ __('Đăng nhập ngay') }}</a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
