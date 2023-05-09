@extends('layouts.app')
@include('layouts.layout.menu')
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
                <div class="text-left mb-2">{{count($baihocs).' bài học được tìm thấy'}}</div>
                <div class="row">
                    @foreach ($baihocs as $item)
                    <div class="col-8 col-lg-8 d-flex">
                        <div class="card w-100">
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
                                    <div class="mb-0">
                                        <a href="#" title='Lưu bài học' class="text-danger"><i class="lni lni-heart-filled"></i></a>
                                        <i class="bx bx-heart"></i>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-4 col-lg-4 d-flex">
                        <div class="card">
                            <div class="card-body">
                                
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            
        </div>

    </main>
@endsection