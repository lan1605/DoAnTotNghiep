@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('content')
<main>
    @include('layouts.layout.breadcrumb')
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
                <div class="text-center">
                    <h1>
                        Liên hệ
                    </h1>
                </div>
                <div class="card my-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="border p-3 rounded">
                                    <h6 class=" text-uppercase">Phản hồi, góp ý</h6>
                                    <hr/>
                                    <form class="row g-3" method="post" action="/lien-he">
                                        @csrf
                                        <div class="col-12">
                                            <label class="form-label">Họ tên</label>
                                            <input type="text" class="form-control @error('name') is-invalid  @enderror" name="name" value="{{isset(Auth::user()->id) ? Auth::user()->name : " "}}" placeholder="Họ tên...">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                        <label class="form-label">Địa chỉ Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid  @enderror" name="email" value="{{isset(Auth::user()->id) ? Auth::user()->email : " "}}" placeholder="Địa chỉ email..">
                                        @error('email')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                        <label class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control @error('sdt') is-invalid  @enderror" name="sdt" value="{{isset(Auth::user()->id) ? Auth::user()->sdt : " "}}" placeholder="Số điện thoại..">
                                        @error('sdt')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                        <label class="form-label">Nội dung liên hệ</label>
                                        <textarea class="form-control @error('noi_dung') is-invalid  @enderror " rows="4" cols="4" name="noi_dung" placeholder="Nội dung..."></textarea>
                                        @error('noi_dung')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Gửi liên hệ</button>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="border-0 p-3 rounded-0">
                                    <h6 class=" text-uppercase">Thông tin liên lạc</h6>
                                    <hr/>
                                        <div class="px-2">
                                            <div class="d-flex align-items-center">
                                                <div class="fs-3">	<i class="bx bx-building"></i>
                                                </div>
                                                <div class="ms-2 fs-6"> 02 Nguyễn Đình Chiểu, phường Vĩnh Thọ, Nha Trang, Khánh Hòa</div>
                                            </div>
                                        </div>
                                        <div class="px-2">
                                            <div class="d-flex align-items-center">
                                                <div class="fs-3">	<i class="bx bx-mail-send"></i>
                                                </div>
                                                <div class="ms-2 fs-6"> <a href="mailto:tinhocdaicuongantu@gmail.com">tinhocdaicuongantu@gmail.com</a></div>
                                            </div>
                                        </div>
                                        <div class="px-2">
                                            <div class="d-flex align-items-center">
                                                <div class="fs-3">	<i class="bx bx-phone-call"></i>
                                                </div>
                                                <div class="ms-2 fs-6"> <a href="tel:02583831149">02583831149</a></div>
                                            </div>
                                        </div>
                                        <div class="px-2" >
                                            <div class="border rounded" style="height: 250px">
                                                <div class="w-100" >
                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1949.3375204577465!2d109.19594759839475!3d12.270256200000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317067772799db0d%3A0xb6c0e98685b3960e!2zQ-G7lW5nIFRyxrDhu51uZyDEkOG6oWkgSOG7jWMgTmhhIFRyYW5n!5e0!3m2!1svi!2s!4v1685074704476!5m2!1svi!2s" class="w-100" style="height: 240px" style="border:0; height: 100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                </div>
                                            </div>
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