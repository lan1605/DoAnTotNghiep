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