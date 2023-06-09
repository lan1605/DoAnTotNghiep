<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{asset('assets/images/logo-dai-hoc-nha-trang.png')}}" type="image/png" />
  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets/plugins/notifications/css/lobibox.min.css')}}" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> --}}
  <link href="{{asset('assets/css/bootstrap-icons.css')}}" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="{{asset('assets/plugins/ckeditor5/build/ckeditor.js')}}"></script>
  
  <script src="{{asset('assets/plugins/notifications/js/lobibox.min.js')}}"></script>
  <script src="{{asset('assets/plugins/notifications/js/notifications.min.js')}}"></script>
  <script src="{{asset('assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
  <script src="{{asset('assets/js/pace.min.js')}}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

        @yield('title')


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
                  <strong>Số điện thoại:</strong> 02583831149
                </div>
                <div class="ms-2">
                  <strong>Email:</strong> ntutinhocdaicuonga@gmail.com
                </div>
              </div>
              @yield('login-for-users')
            
            </div>
          </div>
          <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
          
            <div class="container">	<a class="navbar-brand" href="/"><img src="{{asset('assets/images/logo-dai-hoc-nha-trang.png')}}" width="40" alt=""/> TIN HỌC ĐẠI CƯƠNG A</a>
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
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
  <!--plugins-->
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
  <script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
  <script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('assets/js/pace.min.js')}}"></script>
   <!-- Vector map JavaScript -->
   <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
   <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

  <!--app-->
  <script src="{{asset('assets/js/app.js')}}"></script>
  <script src="{{asset('assets/js/index.js')}}"></script>
  <script>
    const main = document.querySelector('main');
    main.style = "min-height: 00px";
    // main.classList.add('mb-5');
    $(function(){

  var url = window.location.href, 
      urlRegExp = new RegExp(url.replace(/\$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
      // now grab every link from the navigation
      $('.nav-link').each(function(){
          // and test its normalized href against the url pathname regexp
          if(urlRegExp.test(this.href.replace(/\$/,''))){
              $(this).addClass('active');
          }
      });

  });
  const listImg = document.querySelectorAll("article img");
  if (document.body.clientWidth < 767){
    listImg.forEach(item => {
      item.classList.add('img-fluid');
    });
  }
  </script>

  @yield('javascript')
</body>

</html>