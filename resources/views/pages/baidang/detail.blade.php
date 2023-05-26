@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('title')
    <title>
        {{$baidang->ten_baidang}}
    </title>
@endsection
@guest
@section('content')
@include('layouts.layout.breadcrumb')
<main >
    <div style="background-color: white">
        <div class="container mt-2">
            
            <div class="row my-5">
                <div class="col-12 col-lg-9">
                    <div class="card w-100 mb-1" >
                        <div class="card-body" style="cursor: pointer" title="{{$baidang->ten_baidang}}">
                            <div class="d-flex gap-3">
                                <div class="product-box">
                                    <img src="<?php
                                    $user = App\Models\User::find($baidang->id_hocvien);
                                    if ($user->img_admin==NULL){
                                        echo "../../assets/images/icons/user.svg";
                                    }
                                    else {
                                        
                                        echo "../admins/$user->img_admin";
                                    }
                                    ?>" alt="">
                                </div>
                                <div class="d-flex w-100 flex-column">
                                    <div class="d-flex justify-content-between align-baidangs-center w-100">
                                        <div class="float-start">
                                            <h5 class="py-0 text-primary">{{$baidang->ten_baidang}}</h5>
                                            <p class="py-0"><strong>{{App\Models\ChuDe::find($baidang->id_chude)->ten_chude}}</strong></p>
                                        </div>
                                        <div class="d-flex">
                                            <p class="py-0 mx-2"><strong><i class="bx bx-user"></i></strong>
                                                @php
                                                    $nguoidang = App\Models\User::find($baidang->id_hocvien);
                                                @endphp
                                                {{$nguoidang->name}}
                                            </p>
                                            <p class="py-0"><strong><i class="bx bx-calendar"></i></strong>
                                                {{$baidang->created_at}}
                                            </p>
                                            <p class="py-0 mx-2"><strong><i class="bx bx-message-rounded"></i></strong>
                                                @php
                                                    $cmt = App\Models\BinhLuan::where('id_baidang',$baidang->id)->get();
                                                @endphp
                                                {{count($cmt)}}
                                            </p>
                                            
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        
                                        {!! $baidang->noidung_baidang !!}
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <h4 class="mt-2">Bình luận</h4>
                    @include('pages.binhluan.display', ['comments' => $baidang->binhluan, 'post_id' => $baidang->id])
                    <div class="card rounded overflow-hidden shadow-none bg-white border mb-5" >
                        <div class="card-body text-center">
                            <p class="py-0">Vui lòng <span><a href="/login">đăng nhập</a></span> hoặc <span><a href="/register">tạo một tài khoản</a></span> để bình luận. </p>
                        </div>
                    </div>
                    
                </div>
                <div class="col-12 col-lg-3">
                    <div class="sticky-top">
                        <div class="card">
                            <div class="card-header">
                                <h5>Cùng chủ đề</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($cungchude as $item)
                                    <a href="/goc-hoi-dap/{{$item->slug}}">
                                        <p class="mb-0 product--title">{{$item->ten_baidang}}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Cùng tác giả</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($cungtacgia as $item)
                                    <a href="/goc-hoi-dap/{{$item->slug}}">
                                        <p class="mb-0 product--title">{{$item->ten_baidang}}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</main>
@endsection
@else
@section('content')
@include('layouts.layout.breadcrumb')
    <main >
        @if (session('success'))
            <script>
                Lobibox.notify('success', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    icon: 'bx bx-check-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    msg: '{{session('success')}}'
                });
            </script>
        @endif
        @if (session('error'))
            <script>
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    icon: 'bx bx-x-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    msg: '{{session('error')}}'
                });
            </script>
        @endif
        <div style="background-color: white">
            <div class="container mt-2">
                
                <div class="row my-5">
                    <div class="col-12 col-lg-9">
                        <div class="card w-100 mb-1" >
                            <div class="card-body" style="cursor: pointer" title="{{$baidang->ten_baihoc}}">
                                <div class="d-flex gap-3">
                                    <div class="product-box">
                                        <img src="<?php
                                        $user = App\Models\User::find($baidang->id_hocvien);
                                        if ($user->img_admin==NULL){
                                            echo "../../assets/images/icons/user.svg";
                                        }
                                        else {
                                            
                                            echo "../admins/$user->img_admin";
                                        }
                                        ?>" alt="">
                                    </div>
                                    <div class="d-flex w-100 flex-column">
                                        <div class="d-flex justify-content-between align-baidangs-center w-100">
                                            <div class="float-start">
                                                <h5 class="py-0 text-primary">{{$baidang->ten_baidang}}</h5>
                                                <p class="py-0"><strong>{{App\Models\ChuDe::find($baidang->id_chude)->ten_chude}}</strong></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="py-0 mx-2"><strong><i class="bx bx-user"></i></strong>
                                                    @php
                                                        $nguoidang = App\Models\User::find($baidang->id_hocvien);
                                                    @endphp
                                                    {{$nguoidang->name}}
                                                </p>
                                                <p class="py-0"><strong><i class="bx bx-calendar"></i></strong>
                                                    {{$baidang->created_at}}
                                                </p>
                                                <p class="py-0 mx-2"><strong><i class="bx bx-message-rounded"></i></strong>
                                                    @php
                                                        $cmt = App\Models\BinhLuan::where('id_baidang',$baidang->id)->get();
                                                    @endphp
                                                    {{count($cmt)}}
                                                </p>
                                                
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            
                                            {!! $baidang->noidung_baidang !!}
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <h4 class="mt-2">Bình luận</h4>
                        @include('pages.binhluan.display', ['comments' => $baidang->binhluan, 'post_id' => $baidang->id])
                        <div class="card rounded overflow-hidden shadow-none bg-white border mb-5" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal">
                            <div class="card-body">
                                <div class="d-flex gap-3">
                                    <div class="product-box">
                                        <img src="<?php
                                        $user = App\Models\User::find(Auth::user()->id);
                                        if ($user->img_admin==NULL){
                                            echo "../../assets/images/icons/user.svg";
                                        }
                                        else {
                                            
                                            echo "../admins/$user->img_admin";
                                        }
                                        ?>" alt="">
                                    </div>
                                    
                                    <div class="d-flex w-100 flex-column">
                                        Thêm đóng góp của bạn...
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="modal fade" id="exampleExtraLargeModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Thêm bình luận</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('comment.add') }}">
                                            @csrf
                                                <textarea class="form-control rounded-0 border-0" name="noi_dung" id='ckeditor'></textarea>
                                                <input type="hidden" name="post_id" value="{{ $baidang->slug }}" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <input type="submit" class="btn btn-primary mt-2 float-end" value="Thêm" />
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="sticky-top">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Cùng chủ đề</h5>
                                </div>
                                <div class="card-body">
                                    @foreach ($cungchude as $item)
                                        <a href="/goc-hoi-dap/{{$item->slug}}">
                                            <p class="mb-0 product--title">{{$item->ten_baidang}}</p>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Cùng tác giả</h5>
                                </div>
                                <div class="card-body">
                                    @foreach ($cungtacgia as $item)
                                        <a href="/goc-hoi-dap/{{$item->slug}}">
                                            <p class="mb-0 product--title">{{$item->ten_baidang}}</p>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </main>
@endsection
@section('javascript')
<script src="../../assets/plugins/notifications/js/lobibox.min.js"></script>
<script src="../../assets/plugins/notifications/js/notifications.min.js"></script>
<script src="../../assets/plugins/notifications/js/notification-custom-script.js"></script>
<script src="../../assets/js/pace.min.js"></script>
<script>

    ClassicEditor
        .create( document.querySelector( '#ckeditor' ), {
            ckfinder:{
                uploadUrl: '{{ route('images.upload').'?_token='.csrf_token() }}',
            },
            // More configuration options.
            // ...
            
        } )
        .then( editor => {
            // console.log( error );
            editor.ui.view.editable.element.style.height = '100px';
        } )
        .catch( error => {
            console.log( error );
        } );
        
        
    </script>
@endsection

@endguest