@extends('layouts.app')
@section('title')
    <title>
        Thay đổi mật khẩu dành cho quản trị viên
    </title>
@endsection
@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="authentication-card">
        <div class="card shadow rounded-5 overflow-hidden">
            <div class="row g-0">
            <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                <img src="../../assets/images/error/forgot-password.svg" class="img-fluid" alt="Quên mật khẩu">
            </div>
            <div class="col-lg-6">
                <div class="card-body p-4 p-sm-5">
                <h5 class="card-title">{{ __('Thay đổi mật khẩu') }}</h5>
                <p class="card-text mb-5">{{ __('Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu của bạn. Vui lòng thay đổi mật khẩu để tiếp tục đăng nhập')}}</p>
                <form method="POST" action="{{ route('admin.password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="email" class="col-md-4 col-form-label">{{ __('Địa chỉ Email') }}</label>
                            <div class="ms-auto position-relative">
                                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div> 
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror radius-30 ps-5 " name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            </div>                              
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="display:block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                        <label for="password" class="form-label">{{ __('Mật khẩu mới')}}</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                            <input id="password" type="password" class=" radius-30 ps-5 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Nhập mật khẩu...">
                        </div>
                        @error('password')
                                    <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="col-12">
                        <label for="password-confirm" class="form-label">{{ __('Nhập lại mật khẩu')}}</label>
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                            <input id="password-confirm" type="password" class="form-control radius-30 ps-5" name="password_confirmation" required autocomplete="new-password" placeholder="Nhập lại mật khẩu..">
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary radius-30">{{ __('Đổi mật khẩu') }}</button>
                            {{-- <button type="submit" class="">Back to Login</button> --}}
                            
                        </div>
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
@endsection
