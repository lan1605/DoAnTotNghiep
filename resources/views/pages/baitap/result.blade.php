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
                            <form action="/baitap/{{$baitap->slug}}" method="post" id="formSubmit">
                                @csrf
                            <div class="card-body">
                                <div class="row g-2 mt-1">
                                    <div class="col-12" id="contents">
                                        @if (count($dscauhoi)==0)
                                            {{'Không có thông tin hiển thị'}}
                                        @else
                                        <?php $dem = 0;?>
                                            @foreach ($dscauhoi as $item)
                                                <?php $dem = $dem +1; ?>
                                            @foreach ($danhsach as $item_lbt)
                                                @if ($item->id ===$item_lbt->id_cauhoi)
                                                    <div class="mt-2 " id="quest-{{$item->id}}">
                                                        <h5><strong>Câu {{$dem}}</strong>: {{$item->noi_dung}}</h5>
                                                        <div class="question-answer fs-6">
                                                            <div class="answer">
                                                                
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="{{$item->id}}" value="{{trim($item->dap_an_1)}}" > A. {{$item->dap_an_1}}
                                                                
                                                            </div>
                                                            <div class="answer">
                                                                
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="{{$item->id}}" value="{{trim($item->dap_an_2)}}"> B. {{$item->dap_an_2}}
                                                               
                                                            </div>
                                                            <div class="answer">
                                                                
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="{{$item->id}}" value="{{trim($item->dap_an_3)}}"> C. {{$item->dap_an_3}}
                                                               
                                                            </div>
                                                            <div class="answer">
                                                               
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="{{$item->id}}"value="{{trim($item->dap_an_4)}}"> D. {{$item->dap_an_4}}
                                                                
                                                                   
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endif
                                            @endforeach
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
                                    <p class="my-0"><strong>Chủ đề: </strong>
                                        @php
                                            $chude = App\Models\BaiHoc::find($baitap->id_baihoc)->id_chude;
                                            
                                        @endphp
                                        {{App\Models\ChuDe::find($chude)->ten_chude}}
                                    </p>
                                    <p class="my-0"><strong>Số lượng câu hỏi: </strong>{{$baitap->soluong_cauhoi}} câu</p>
                                    <p class="my-0"><strong>Thời gian làm bài: </strong>{{$thoigian}} phút</p>
                                    <div class="d-flex mt-2 justify-content-center">
                                        <button type="submit" class="btn btn-success" >Nộp bài</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-2">
                                            <span  id="timer" name="time"></span>
                                        </div>
                                        @php
                                            $demds =0;
                                        @endphp
                                        @foreach ($danhsach as $item_ds)
                                        <?php $demds = $demds +1; ?>
                                                <div class="col-2 mt-2">
                                                    <a href="#quest-{{$item_ds->id_cauhoi}}" class="menu-link btn btn-white d-flex justify-content-center">{{$demds}}</a>
                                                </div>
                                        @endforeach
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
@endsection