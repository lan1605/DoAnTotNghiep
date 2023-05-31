@extends('layouts.app')

@section('title')
    <title>
        Gửi liên kết thay đổi mật khẩu dành cho học viên
    </title>
@endsection
@section('content')
<div class="container">
    <div class="authentication-card">
        <div class="card shadow rounded-5 overflow-hidden">
            <div class="row">
                <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                    <img src="https://img.freepik.com/free-vector/man-thinking-concept-illustration_114360-7990.jpg?w=740&t=st=1662791646~exp=1662792246~hmac=a0cee1f7c7f898b2b47bfafc0c477f3f0ef9151e3488056c41b74ae4a3e6acb9" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title">{{ __('Bạn quên mật khẩu?') }}</h5>
                        <p class="card-text mb-5">{{ __('Vui lòng nhập địa chỉ email để thay đổi mật khẩu')}}</p>
                        @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
        
                            @if (isset($route))
                                <form method="POST" action="{{ $route }}" class="form-body">    
                            @else
                                <form method="POST" action="{{ route('password.email') }}" class="form-body">
                            @endif
                                @csrf
        
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="email" class="col-md-4 col-form-label">{{ __('Địa chỉ Email') }}</label>
                                        <input id="email" type="email" class="form-control-lg radius-30 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="Địa chỉ email...">
                                    </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert" style="display:block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <div class="col-12">
                                        <div class="d-grid gap-3">
                                            <button type="submit" class="btn btn-lg btn-primary radius-30">{{ __('Gửi tới Email') }}</button>
                                            @if (Route::has('login'))
                                            <a  href="{{ route('login') }}" class="btn btn-lg btn-light radius-30">{{ __('Trở về trang đăng nhập') }}</a>
                                        @endif
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
@endsection
