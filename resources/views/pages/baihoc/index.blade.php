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
        <div style="background-color: #f7f8fa">
            <div class="container">
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
            </div>
        </div>
        <div style="background-color: white">
            <div class="container mt-2">
                
                <div class="row my-5">
                    <div class="col-12 col-lg-7 ">
                        <div class="card ">
                            <div class="card-header py-2 d-flex justify-content-between">
                                <h6 class="mb-0">Bài học</h6>
                               
                            </div>
                            <div class="card-body">
                                <p class=" text-right">
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
                                <div class="row g-2">
                                    @foreach ($baihocs as $item)
                                        <div class="col-12 my-0">
                                            <div class="card w-100">
                                                <div class="card-body" style="cursor: pointer" title="{{$item->ten_baihoc}}">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <a href="/baihoc/{{$item->slug}}">
                                                                <h6 class="mb-0 product--title">{{$item->ten_baihoc}}</h6>
                                                            </a>
                                                            <p class="mb-0">Chủ đề: <span>
                                                                <?php
                                                                    $chude = App\Models\ChuDe::find($item->id_chude);
                                                                    echo $chude->ten_chude;
                                                                    ?>
                                                            </span></p>
                                                        </div>
                                                        {{-- <div class="mb-0">
                                                            <a href="#" title='Lưu bài học' class="text-danger"><i class="lni lni-heart-filled"></i></a>
                                                            <i class="bx bx-heart"></i>
                                                        </div> --}}
                                                    </div>
                                                    
                                                </div>
                                        </div>
                                </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h3>Bài học mới nhất</h3>
                                @foreach ($baihocmoinhat as $item)
                                <div class="card">
                                    <div class="card-body" style="cursor: pointer" title="{{$item->ten_baihoc}}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <a href="baihoc/{{$item->slug}}">
                                                    <h6 class="mb-0 product--title">{{$item->ten_baihoc}}</h6>
                                                </a>
                                                <p class="mb-0">Chủ đề: <span>
                                                    <?php
                                                        $chude = App\Models\ChuDe::find($item->id_chude);
                                                        echo $chude->ten_chude;
                                                        ?>
                                                </span></p>
                                            </div>
                                            {{-- <div class="mb-0">
                                                <a href="#" title='Lưu bài học' class="text-danger"><i class="lni lni-heart-filled"></i></a>
                                                <i class="bx bx-heart"></i>
                                            </div> --}}
                                        </div>
                                        
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