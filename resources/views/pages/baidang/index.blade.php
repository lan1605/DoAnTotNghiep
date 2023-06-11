@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('title')
    <title>
        Bài viết
    </title>
@endsection
@section('content')
{{-- @include('layouts.layout.breadcrumb') --}}
<main>
    @include('layouts.layout.breadcrumb')
        <div style="background-color: #f7f8fa">
            <div class="container">
                <div class="row g-3 d-flex align-items-center mt-0 ">
                    <div class="d-sm-flex mb-3 justify-content-center gap-2">
                        <a href="/goc-hoi-dap" class="btn btn-primary mb-3 mb-lg-0">Tất cả</a>
                        <a href="/goc-hoi-dap/danh-sach" class="btn btn-white mb-3 mb-lg-0">Bài viết của bạn</a>
                        <a href="/goc-hoi-dap/them-moi" class="btn btn-white mb-3 mb-lg-0">Thêm mới</a>
                    </div>
                   
                </div>
            </div>
        </div>
        <div style="background-color: white">
            <div class="container mt-2 mb-5">
                <p class=" text-right mt-2">
                    <form action="" method="get" class="d-sm-flex mb-3 justify-content-center">
                        <div class="col-lg-4 col-12 col-md-12 mb-2 mb-sm-0 ms-2">
                            <?php
                                    $role = App\Models\ChuDe::all();    
                                ?>
                                <select name="find_cate" id="" class="form-select">
                                    <option value="0">Tất cả</option>
                                    @if (isset($role))
                                    @foreach ($role as $item)
                                        <option value="<?php echo $item->id_chude?>" {{request()->find_cate==$item->id_chude ? 'selected' : false}}><?php echo $item->ten_chude?></option>
                                    @endforeach
                                    
                                    @endif
                                </select>
                          </div>
                        <div class=" col-lg-6 col-12 col-md-12 mb-2 mb-sm-0 ms-2">
                            <div class="ms-auto position-relative">
                                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                                <input class="form-control ps-5" type="text" placeholder="tìm kiếm..."name="key_find" value="{{Request()->key_find}}">
                            </div>
                        </div>
                        <div class="mb-2 mb-sm-0 ms-2">
                            <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                        </div>
                    </form>
                    @if (!empty(request()->find_cate))
                            @if (!empty(request()->key_find))
                            <?php
                                $cate = App\Models\ChuDe::find(request()->find_cate);
                            ?>
                            {{count($baidangs).' bài viết liên quan chủ đề "'.$cate->ten_chude.'" được tìm thấy với từ khóa "'.request()->key_find.'"'}}
                            @else
                            <?php
                                $cate = App\Models\ChuDe::find(request()->find_cate);
                            ?>
                            {{count($baidangs).' bài viết liên quan chủ đề "'.$cate->ten_chude.'" được tìm thấy '}}
                            @endif
                    @else
                            @if (!empty(request()->key_find))
                            {{count($baidangs).' bài viết liên quan được tìm thấy với từ khóa "'.request()->key_find.'"'}}
                            @else
                           
                            @endif
                    @endif
                </p>
                
                <div class="row my-2">
                    <div class="col-12 col-lg-12">
                                @foreach ($baidangs as $item)
                                    <div class="card w-100 mb-1" onclick="location.href='/goc-hoi-dap/{{$item->slug}}'" title="{{$item->ten_baidang}}">
                                        <div class="card-body" style="cursor: pointer" title="{{$item->ten_baihoc}}">
                                            <div class="d-flex gap-3">
                                                <div class="product-box">
                                                    <img src="<?php
                                                    $user = App\Models\User::find($item->id_hocvien);
                                                    if ($user->img_admin==NULL){
                                                        echo "../../assets/images/icons/user.svg";
                                                    }
                                                    else {
                                                        
                                                        echo "../admins/$user->img_admin";
                                                    }
                                                    ?>" alt="">
                                                </div>
                                                <div class="d-flex w-100 flex-column">
                                                    <div class="d-flex justify-content-between align-items-center w-100">
                                                        <div class="float-start">
                                                            <h5 class="py-0 text-primary">
                                                                @php
                                                                    $ten = $item->ten_baidang;
                                                                    echo Str::limit($ten, 100, ' ...');
                                                                @endphp
                                                            </h5>
                                                        </div>
                                                        <div class="d-flex">
                                                            <p class="py-0 mx-2"><strong><i class="bx bx-user"></i></strong>
                                                                @php
                                                                    $nguoidang = App\Models\User::find($item->id_hocvien);
                                                                @endphp
                                                                {{$nguoidang->name}}
                                                            </p>
                                                            <p class="py-0"><strong><i class="bx bx-calendar"></i></strong>
                                                                {{$item->created_at->format('d-m-Y h:i:s')}}
                                                            </p>
                                                            <p class="py-0 mx-2"><strong><i class="bx bx-message-rounded"></i></strong>
                                                                @php
                                                                    $cmt = App\Models\BinhLuan::where('id_baidang',$item->id)->get();
                                                                @endphp
                                                                {{count($cmt)}}
                                                            </p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        @php
                                                            $body = $item->noidung_baidang;
                                                            echo Str::limit($body, 200, ' ...');
                                                        @endphp
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                        {{ $baidangs->links('pagination.custom') }}
                    </div>
                </div>
            </div>
            
        </div>

    </main>
@endsection