@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('content')
@include('layouts.layout.breadcrumb')
    <main>
        <div style="background-color: white">
            <div class="container mt-2">
                
                <div class="row my-5">
                    <div class="col-12 col-lg-9">
                        <div class="card w-100 mb-1" onclick="location.href='/goc-hoi-dap/{{$baidang->slug}}'">
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
                        <div class="card rounded overflow-hidden shadow-none bg-white border mt-3 mb-5">
                            <div class="card-body" style="cursor: pointer">
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
                    </div>
                </div>
            </div>
            
        </div>

    </main>
@endsection
