<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../../assets/images/favicon-32x32.png" type="image/png" />
  <!-- Bootstrap CSS -->
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../../assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="../../assets/css/style.css" rel="stylesheet" />
  <link href="../../assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

  {{-- <title>Snacked - Bootstrap 5 Admin Template</title> --}}
</head>

<body class="bg-white">

  <!--start wrapper-->
  <div class="wrapper">
       <header>
          <div class="container mb-2 mt-2">
            <div class="d-flex align-items-center w-100">
              <div class="phone">
                Số điện thoại:
              </div>
              <div class="ms-2">
                Email:
              </div>
              <div class="d-flex ms-3 gap-3">
                @yield('menu')
              </div>
            </div>
          </div>
          <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
          
            <div class="container">	<a class="navbar-brand" href="#"><img src="../../assets/images/logo-dai-hoc-nha-trang.png" width="40" alt=""/> SEO for A</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent3" aria-controls="navbarSupportedContent3" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent3">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item"> <a class="nav-link active text-uppercase" aria-current="page" href="#"><i class='bx bx-home-alt me-1'></i>Trang chủ</a>
                  </li>
                  <li class="nav-item"> <a class="nav-link text-uppercase" href="#"><i class='bx bx-user me-1'></i>Bài học</a>
                  </li>
                  <li class="nav-item"> <a class="nav-link text-uppercase" href="#"><i class='bx bx-category-alt me-1'></i>Bài tập</a>
                  </li>
                  <li class="nav-item"> <a class="nav-link text-uppercase" href="#"><i class='bx bx-category-alt me-1'></i>Góc hỏi đáp</a>
                  </li>
                  <li class="nav-item"> <a class="nav-link text-uppercase" href="#"><i class='bx bx-microphone me-1'></i>Liên hệ</a>
                  </li>
                </ul>
                @if (Auth::check())
                  @include('layouts.layout.logout')
                @else
                    {{''}}
                @endif
              </div>
            </div>
          </nav>
       </header>
    
       <!--start content-->
       
        @yield('content')
   
        
       <!--end page main-->

       

  </div>
  <!--end wrapper-->

  @include('layouts.layout.footer')
  <!-- Bootstrap bundle JS -->
  <script src="../../assets/js/bootstrap.bundle.min.js"></script>

  <!--plugins-->
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/js/pace.min.js"></script>


</body>

</html>