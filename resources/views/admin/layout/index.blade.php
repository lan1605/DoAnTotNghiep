<!doctype html>
<html lang="vi" class="semi-dark">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{asset('assets/images/logo-dai-hoc-nha-trang.png')}}" type="image/png" />
  <!--plugins-->
  <link href="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
  <link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{asset('assets/plugins/notifications/css/lobibox.min.css')}}" />
  <!-- loader-->
	<link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />

  <!--Theme Styles-->
  <link href="{{asset('assets/css/dark-theme.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/light-theme.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/semi-dark.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/header-colors.css')}}" rel="stylesheet" />
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script  src="{{asset('assets/plugins/ckeditor5/build/ckeditor.js')}}"></script>
  <script  src="{{asset('assets/plugins/notifications/js/lobibox.min.js')}}"></script>
  <script  src="{{asset('assets/plugins/notifications/js/notifications.min.js')}}"></script>
  <script  src="{{asset('assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
  <script src="{{asset('assets/js/pace.min.js')}}"></script>
  <title>
    @if (isset($titlePage))
        {{$titlePage}}
    @else
        {{'Quản lý hệ thống ứng dụng hỗ trợ Tin học đại cương A.'}}
    @endif
  </title>
  <style>
    .ck-editor__editable {min-height: 500px;}
    .preview-img {
  width: 300px;
  margin: 50px 0;
  max-height: 300px;
  object-fit: cover;
}
  </style>
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
    @include('admin.layout.header')
       <!--end top header-->

        <!--start sidebar -->
        @include('admin.layout.sidebar')
       <!--end sidebar -->

       <!--start content-->
       
    @yield('content')
       <!--end page main-->

      @include('admin.layout.footer')

  </div>
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
  <!--plugins-->
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
  <script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
  <script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('assets/js/pace.min.js')}}"></script>
  <script src="{{asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
  <script src="{{asset('assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
  <script src="{{asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
   <!-- Vector map JavaScript -->
   <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
   <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!--app-->
  <script src="{{asset('assets/js/app.js')}}"></script>
  <script src="{{asset('assets/js/index.js')}}"></script>


  @yield('javascript')
<script>
  
ClassicEditor
    .create( document.querySelector( '#editor' ), {
        ckfinder:{
            uploadUrl: '{{ route('images.upload').'?_token='.csrf_token() }}',
        },
        // More configuration options.
        // ...
        
    } )
    .then( editor => {
        // console.log( error );
        editor.ui.view.editable.element.style.height = '500px';
    } )
    .catch( error => {
        console.log( error );
    } );
    
    
</script>


</body>

</html>