@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('title')
    <title>
        Trang chủ
    </title>
@endsection
@if (Auth::check())

@section('content')
<main>
    <div class="container">
        <div class="card rounded-0 overflow-hidden border-0 shadow-none bg-white border mt-5 mb-5">
            <div class="row g-0 d-flex align-items-center justify-content-center">
                <div class="col-12 col-xl-5 order-xl-1">
                    <div class="card-body p-4 p-sm-5 d-flex align-items-center justify-content-center flex-column">
                        <h2 class="border-bottom text-primary">Giới thiệu học phần</h2>
                        <hr>
                        <p class="py-0 fs-6">
                            Học phần trang bị cho người học các kiến thức về Công nghệ thông tin (CNTT) bao gồm: Cách biểu diễn và xử lý thông tin trong máy tính điện tử, hệ thống máy tính, trí tuệ nhân tạo và ứng dụng; mạng máy tính và Internet, bộ công cụ ứng dụng Google apps, công nghệ dạy và học trực tuyến. Đồng thời, người học được trang bị khả năng mô tả bài toán dưới dạng giải thuật lập trình và minh họa giải thuật bằng ngôn ngữ lập trình C.
                        </p>
                        
                    </div>
                </div>
                <div class="col-12 order-2 col-xl-7 d-flex align-items-center justify-content-center ">
                    <img src="/assets/images/error/img-goc-hoi-dap.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
        <div class="card rounded-0 overflow-hidden border-0 shadow-none bg-white border mt-5 mb-5">
            <div class="row g-0 d-flex align-items-center justify-content-center">
                <div class="col-12 order-1 col-xl-7 d-flex align-items-center justify-content-center ">
                    <img src="/assets/images/error/img-goc-hoi-dap.png" class="img-fluid" alt="">
                </div>
                <div class="col-12 col-xl-5 order-xl-2">
                    <div class="card-body p-4 p-sm-5 d-flex align-items-center justify-content-center flex-column">
                        <h2 class="border-bottom text-primary">Bài học</h2>
                        <hr>
                        <p class="py-0 fs-6">
                            Khám phá các bài học hữu ích từ chúng tôi
                        </p>
                        <a href="/bai-hoc" class="btn btn-primary mb-3 mb-lg-0">Danh sách bài học</a>
                    </div>
                </div>
                
            </div>
        </div>
</div>
</main>

@endsection
@endif

