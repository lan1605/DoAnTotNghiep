@if (isset($route))
    {{''}}
@else
    @section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @guest
        @if (Route::has('login'))
            <a class="btn btn-primary btn-sm px-4 radius-30" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
        @endif
        @if (Route::has('register'))
            <a class="btn btn-white btn-sm px-4 radius-30" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
        @endif
    @else
    {{''}}
    @endguest
      </div>
    @endsection
@extends('layouts.app')
@endif
@section('content')
<main class="authentication-content">
    <div class="container">
        <div class="mt-4">
            <div class="card rounded-0 overflow-hidden shadow-none border mb-5 mb-lg-0">
                <div class="row g-0">
                        <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
                        <img src="assets/images/error/auth-img-7.png" class="img-fluid" alt="">
                </div>
                <div class="col-12 col-xl-4 order-xl-2">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title">Đăng nhập</h5>
                        <p class="card-text mb-4">
                            @if (isset($title))
                            {{__($title)}}
                            @else
                                {{ __('Đăng nhập với tư cách người dùng')}}
                            @endif
                        </p>
                        {{-- <div class="card-header">{{ $title ?? "" }} {{ __('Login') }}</div> --}}
            
                                @if (isset($route))
                                <form method="POST" action="{{ $route }}">
                                @else
                                <form method="POST" action="{{ route('login') }}">
                                @endif
                                @csrf
                                {{-- Email --}}
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('Địa chỉ Email') }}</label>
            
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div> 
                                            <input id="email" type="email" class="radius-30 ps-5 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Nhập Email...">
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert" style="display:block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row g-3  mb-3">
                                    <div class="col-12">
                                        <label for="password" class="col-form-label text-md-start">{{ __('Mật khẩu') }}</label>
            
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                            <input id="password" type="password" class="radius-30 ps-5 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Nhập mật khẩu...">
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert" style="display:block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
            
                                <div class="row g-3 mb-5">
                                    <div class="col-7">
                                        <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                                        </div>
                                    </div>
                                    <div class="col-5 text-end">	
                                        @if  (isset($route))
                                        <a  href="{{ $route.'-password/reset' }}">
                                            {{ __('Quên mật khẩu?') }}
                                        </a>  
                                        @else
                                        <a  href="{{ Route('password.request') }}">
                                            {{ __('Quên mật khẩu?') }}
                                        </a> 
                                        @endif
                                    </div>
                                </div>
                                <div class="row g-3">    
                                    <div class="col-12">
                                        <div class="d-grid">
                                        <button type="submit" class="btn btn-primary radius-30">Đăng nhập</button>
                                        </div>
                                    </div>
                                    
                                    @if (isset($route))
                                    <div class="col-12 text-center">
                                        <p class="mb-0">
                                            
                                                <a  href="{{ '/' }}">{{ __('Trở về trang chủ ') }}</a>
                                            
                                        </p>
                                    </div>
                                    @else
                                    <div class="col-12 text-center">
                                        <p class="mb-0">Bạn chưa có tài khoản? 
                                            @if (Route::has('register'))
                                                <a  href="{{ route('register') }}">{{ __('Đăng ký ngay') }}</a>
                                            @endif
                                        </p>
                                    </div>
                                    @endif
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection