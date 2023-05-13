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
                    <div class="col-12 col-lg-8 ">
                        <div >
                            <div class="card-header py-2 " >
                                <h2 class="fw-500 text-primary">Danh sách câu hỏi</h2>
                            </div>
                            
                            <div class="card-body">
                                <div class="row g-2 mt-1">
                                    <div class="col-12" id="contents">
                                        @if (count($dscauhoi)==0)
                                            {{'Không có thông tin hiển thị'}}
                                        @else
                                        <?php $dem = 0;?>
                                            @foreach ($dscauhoi as $item)
                                                <?php $dem = $dem +1; ?>
                                                    <div class="mt-2">
                                                        <span><strong>Câu {{$dem}}</strong>: {{$item->noi_dung}}</span>
                                                        <div class="">
                                                            @if (trim($ba->dapan_hocvien) == trim($item->answer_a))
                                                                
                                                            @else
                                                                
                                                            @endif
                                                        </div>
                                                        <div class="">
                                                            <input type="radio" name="" id=""  > B. {{$item->dap_an_2}}
                                                        </div>
                                                        <div class="">
                                                            <input type="radio" name="" id=""  > C. {{$item->dap_an_3}}
                                                        </div>
                                                        <div class="">
                                                            <input type="radio" name="" id=""  > D. {{$item->dap_an_4}}
                                                        </div>
                                                    </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="sticky-top">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                       <h3>Bài tập "{{App\Models\BaiHoc::find($baitap->id_baihoc)->ten_baihoc}}"</h3>
                                    </div>
                                    <p class="my-0"><strong>Số lượng câu hỏi: </strong>{{$baitap->soluong_cauhoi}}</p>
                                    <p class="my-0"><strong>Thời gian làm bài: </strong>{{$baitap->soluong_cauhoi}} phút</p>
                                    <p class="my-0"><strong>Thời gian làm bài: </strong>{{$baitap->soluong_cauhoi}} phút</p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        @for ($i = 0; $i < count($dscauhoi); $i++)
                                        @if ($dscauhoi[$i]->dapan_hocvien != "")
                                            <div class="col-2">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <a href="#quest-{{$i+1}}" class="menu-link">{{$i+1}}<span class="tick" id="tick-{{$i+1}}">✓</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                        <div class="col-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <a href="#quest-{{$i+1}}" class="menu-link">{{$i+1}}<span class="tick" id="tick-{{$i+1}}"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endfor
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
