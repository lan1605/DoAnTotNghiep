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

<body class="bg-surface">

  <!--start wrapper-->
  <div class="wrapper">
       <header>
          <nav class="navbar navbar-expand-lg navbar-light bg-white rounded-0 border-bottom">
            <div class="container">
              <a class="navbar-brand" href="#"><img src="../../assets/images/brand-logo-2.png" width="140" alt=""/></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                 
                </ul>
                <div class="d-flex ms-3 gap-3">
                    <!-- Authentication Links -->
                   @yield('menu')
                </div>
              </div>
            </div>
          </nav>
       </header>
    
       <!--start content-->
       <main class="py-4">
        @yield('content')
    </main>
        
       <!--end page main-->

       <footer class="bg-white border-top p-3 text-center fixed-bottom">
        <p class="mb-0">Copyright © 2023. All right reserved.</p>
      </footer>

  </div>
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
  <script src="../../assets/js/bootstrap.bundle.min.js"></script>

  <!--plugins-->
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/js/pace.min.js"></script>


</body>

</html>