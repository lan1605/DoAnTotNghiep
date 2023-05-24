<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../../assets/images/logo-dai-hoc-nha-trang.png" type="image/png" />
  <!-- Bootstrap CSS -->
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../../assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="../../assets/css/style.css" rel="stylesheet" />
  <link href="../../assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="../../assets/plugins/ckeditor5/build/ckeditor.js"></script>

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
            <div class="d-flex align-items-center justify-content-between w-100">
              <div class="d-flex">
                <div class="phone">
                  Số điện thoại:
                </div>
                <div class="ms-2">
                  Email:
                </div>
              </div>
              @yield('login-for-users')
            
            </div>
          </div>
          <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
          
            <div class="container">	<a class="navbar-brand" href="/"><img src="../../assets/images/logo-dai-hoc-nha-trang.png" width="40" alt=""/> NTU</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent3" aria-controls="navbarSupportedContent3" aria-expanded="false" aria-label="Toggle navigation">
                @yield('menu-nav')
              </div>
            </div>
          </nav>
       </header>
    
       <!--start content-->
       
        @yield('content')
   
        
       <!--end page main-->

       
       <a href="javaScript:;" class="back-to-top mb-5"><i class='bx bxs-up-arrow-alt'></i></a>
  </div>
  <!--end wrapper-->

  @include('layouts.layout.footer')
  <script src="../../assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="../../assets/plugins/metismenu/js/metisMenu.min.js"></script>
  <script src="../../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="../../assets/js/pace.min.js"></script>
  <script src="../../assets/plugins/chartjs/js/Chart.min.js"></script>
  <script src="../../assets/plugins/chartjs/js/Chart.extension.js"></script>
  <script src="../../assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
   <!-- Vector map JavaScript -->
   <script src="../../assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
   <script src="../../assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!--app-->
  <script src="../../assets/js/app.js"></script>
  <script src="../../assets/js/index.js"></script>

  @yield('javascript')
</body>

</html>