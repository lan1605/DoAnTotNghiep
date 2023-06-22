@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('title')
    <title>
        Bài viết của bạn
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
                        <a href="/goc-hoi-dap" class="btn btn-white mb-3 mb-lg-0">Tất cả</a>
                        <a href="/goc-hoi-dap/danh-sach" class="btn btn-primary mb-3 mb-lg-0">Bài viết của bạn</a>
                        <a href="/goc-hoi-dap/them-moi" class="btn btn-white mb-3 mb-lg-0">Thêm mới</a>
                    </div>
                   
                </div>
            </div>
        </div>
        <div style="background-color: white">
            <div class="container mt-2">
                @include('layouts.notication')
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
                                <input class="form-control ps-5" type="text" placeholder="tìm kiếm bài viết..."name="key_find" value="{{Request()->key_find}}">
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
                @if (count($baidangs)==0)
                    <div class="card rounded overflow-hidden shadow-none bg-white border mt-5 mb-5">
                        <div class="row g-0 d-flex align-items-center justify-content-center">
                            <div class="col-12 order-1 col-xl-7 d-flex align-items-center justify-content-center border-end">
                                <img src="/assets/images/error/img-goc-hoi-dap.png" class="img-fluid" alt="">
                            </div>
                            <div class="col-12 col-xl-5 order-xl-2">
                                <div class="card-body p-4 p-sm-5 d-flex align-items-center justify-content-center flex-column">
                                    <p class="py-0">
                                        Có vẻ như bạn chưa có bài viết nào. Bạn có thể thêm bài viết đầu tiên của mình bằng cách nhấp vào nút "Thêm mới" ở dưới.
                                        Sau khi thực hiện xong, bạn có thể quay lại đây để truy cập tất cả các bài viết đã thêm trước đây của mình.
                                    </p>
                                    <a href="/goc-hoi-dap/them-moi" class="btn btn-primary mb-3 mb-lg-0">Thêm mới</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                <div class="row my-2">
                    <div class="col-12 col-lg-12 ">
                                @foreach ($baidangs as $item)
                                <div class="card w-100 mb-2" >
                                    <div class="card-body" style="cursor: pointer" title="{{$item->ten_baihoc}}">
                                        <a href="/goc-hoi-dap/{{$item->slug}}">
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
                                                                <h5 class="py-0 text-primary">{{$item->ten_baidang}}</h5>
                                                            </div>
                                                            <div class="d-flex text-black">
                                                                <p class="py-0 mx-2"><strong><i class="bx bx-user"></i></strong>
                                                                    @php
                                                                        $nguoidang = App\Models\User::find($item->id_hocvien);
                                                                    @endphp
                                                                    {{$nguoidang->name}}
                                                                </p>
                                                                <p class="py-0"><strong><i class="bx bx-calendar"></i></strong>
                                                                    {{$item->created_at}}
                                                                </p>
                                                                <p class="py-0 mx-2"><strong><i class="bx bx-message-rounded"></i></strong>
                                                                    @php
                                                                        $cmt = App\Models\BinhLuan::where('id_baidang',$item->id)->get();
                                                                    @endphp
                                                                    {{count($cmt)}}
                                                                </p>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="d-flex text-black flex-column">
                                                                @php
                                                                $body = $item->noidung_baidang;
                                                                echo Str::limit($body, 50, ' ...');
                                                                @endphp
                                                        </div>
                                                    </a>
                                                        <div>
                                                            <div class="d-flex justify-content-end" >
                                                             <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Tùy chọn
                                                              </a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->id}}" >Xóa</a>
                                                                    </li>
                                                                    <li><a href="/goc-hoi-dap/{{$item->slug}}/chinh-sua" class="dropdown-item">Chỉnh sửa</a>
                                                                    </li>
                                                                </ul>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Xóa bài viết</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">Bạn có chắc muốn xóa bài viết này?</div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <a href="/goc-hoi-dap/{{$item->slug}}/xoa" id="deleteAll" class="btn btn-danger">Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                        </div>
                        {{ $baidangs->links('pagination.custom') }}
                    </div>
                </div>
                @endif
            </div>
            
        </div>

    </main>
@endsection