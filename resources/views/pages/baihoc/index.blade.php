@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('title')
    <title>
        Danh sách bài học
    </title>
@endsection
@section('content')
@include('layouts.layout.breadcrumb')
    <main>
        <div style="background-color: #f7f8fa">
            <div class="container">
                <div class="row g-3 d-flex align-items-center mt-0 ">
                    <div class="d-sm-flex mb-3 justify-content-center gap-2">
                        <a href="/bai-hoc" class="btn btn-primary mb-3 mb-lg-0">Tất cả</a>
                        <a href="/bai-hoc/danh-sach-da-luu" class="btn btn-white mb-3 mb-lg-0">Bài học đã lưu</a>
                    </div>
                   
                </div>
            </div>
        </div>
        
        <div style="background-color: white">
            <div class="container mt-2">
                <div class="row g-3 d-flex align-items-center ">
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
                                <input class="form-control ps-5" type="text" placeholder="tìm kiếm bài học..."name="key_find" value="{{Request()->key_find}}">
                            </div>
                        </div>
                        <div class="mb-2 mb-sm-0 ms-2">
                            <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                        </div>
                    </form>
                    
                   
                </div>
                <p class=" text-right mt-2">
                    @if (!empty(request()->find_cate))
                            @if (!empty(request()->key_find))
                            <?php
                                $cate = App\Models\ChuDe::find(request()->find_cate);
                            ?>
                            {{count($baihocs).' bài học được tìm thấy theo chủ đề "'.$cate->ten_chude.'" với từ khóa "'.request()->key_find.'"'}}
                            @else
                            <?php
                                $cate = App\Models\ChuDe::find(request()->find_cate);
                            ?>
                            {{count($baihocs).' bài học được tìm thấy theo chủ đề "'.$cate->ten_chude.'"'}}
                            @endif
                    @else
                            @if (!empty(request()->key_find))
                            {{count($baihocs).' bài học được tìm thấy với từ khóa "'.request()->key_find.'"'}}
                            @else
                            {{count($baihocs).' bài học được tìm thấy'}}
                            @endif
                    @endif
                </p>
                <div class="row my-5">
                    <div class="col-12 col-lg-12 ">
                        @php
                            $chude = App\Models\ChuDe::all();
                        @endphp
                        @foreach ($chude as $itemcd)
                            <div class="card ">
                                <div class="card-header py-2 d-flex justify-content-between">
                                    @if (request()->find_cate==$itemcd->id_chude)
                                        <h5 class="mb-0 text-primary">
                                            @php
                                                $cate = App\Models\ChuDe::find(request()->find_cate);
                                            @endphp
                                            {{$cate->ten_chude}}
                                        </h5>
                                    @else
                                        <h5 class="mb-0 text-primary">{{$itemcd->ten_chude}}</h5>
                                    @endif
                                   
                                </div>
                                
                                <div class="pt-3">
                                    @foreach ($baihocs as $item)
                                    @if ($item->id_chude===$itemcd->id_chude)
                                    <div class="col-12 my-0 px-2">
                                        <div class="card w-100">
                                            <div class="card-body" style="cursor: pointer" title="{{$item->ten_baihoc}}">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <a href="/bai-hoc/{{$item->slug}}" class=" text-black">
                                                            <h6 class="mb-0 product--title">{{$item->ten_baihoc}}</h6>
                                                        </a>
                                                        
                                                    </div>
                                                    @php
                                                        $baihocdaluu = App\Models\LuuBaiHoc::all();

                                                        $arrid = [];
                                                        foreach ($baihocdaluu as $item_bh) {
                                                            $arrid[] = $item_bh->id_thoigianhoc;
                                                        }
                                                        $baihoc = App\Models\ThoiGianHoc::whereIn('id', $arrid)->get();
                                                        
                                                    @endphp
                                                    @foreach ($baihoc as $items)
                                                        @if (isset(Auth::user()->id) && Auth::user()->id === $items->id_hocvien)
                                                            @if ($items->id_baihoc === $item->id_baihoc)
                                                                <div class="mb-0 text-danger">
                                                                    <i class="lni lni-heart-filled" title="Đã luu bài học"></i>
                                                                </div>
                                                            @else
                                                                {{''}}
                                                            @endif
                                                        @else
                                                            {{''}}
                                                        @endif
                                                    @endforeach
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        
                                    @endif
                                @endforeach
                                </div>
                            </div>
                            @endforeach
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

    </main>
@endsection