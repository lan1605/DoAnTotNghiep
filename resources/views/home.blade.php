@extends('layouts.app')
@section('menu')
    @guest
        @if (Route::has('login'))
            <a class="btn btn-primary btn-sm px-4 radius-30" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
        @endif
        @if (Route::has('register'))
            <a class="btn btn-white btn-sm px-4 radius-30" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
        @endif
    @else
        <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @endguest
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello User!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
