@section('menu-nav')
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent3">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item"> <a class="nav-link text-uppercase "  href="/"><i class='bx bx-home-alt me-1'></i>Trang chủ</a>
    </li>
    <li class="nav-item"> <a class="nav-link text-uppercase"  href="/baihoc"><i class='bx bx-user me-1'></i>Bài học</a>
    </li>
    {{-- <li class="nav-item"> <a class="nav-link text-uppercase"  href="#"><i class='bx bx-category-alt me-1'></i>Bài tập</a>
    </li> --}}
    <li class="nav-item"> <a class="nav-link text-uppercase"  href="/goc-hoi-dap"><i class='bx bx-category-alt me-1'></i>Góc hỏi đáp</a>
    </li>
    <li class="nav-item"> <a class="nav-link text-uppercase"  href="/lien-he"><i class='bx bx-microphone me-1'></i>Liên hệ</a>
    </li>
  </ul>
  @if (Auth::check())
    @include('layouts.layout.logout')
  @else
      {{''}}
  @endif
@endsection