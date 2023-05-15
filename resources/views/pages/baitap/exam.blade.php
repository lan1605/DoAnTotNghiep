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
                                                                @if (trim($item_lbt->dapan_hocvien===trim($item->dap_an_1)))
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="" checked value="{{trim($item->dap_an_1)}}" > A. {{$item->dap_an_1}}
                                                                @else
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="" value="{{trim($item->dap_an_1)}}" > A. {{$item->dap_an_1}}
                                                                @endif
                                                            </div>
                                                            <div class="answer">
                                                                @if (trim($item_lbt->dapan_hocvien===trim($item->dap_an_2)))
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="" checked value="{{trim($item->dap_an_2)}}"> B. {{$item->dap_an_2}}
                                                                @else
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="" value="{{trim($item->dap_an_2)}}" > B. {{$item->dap_an_2}}
                                                                @endif
                                                            </div>
                                                            <div class="answer">
                                                                @if (trim($item_lbt->dapan_hocvien===trim($item->dap_an_3)))
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="" checked value="{{trim($item->dap_an_3)}}"> C. {{$item->dap_an_3}}
                                                                @else
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="" value="{{trim($item->dap_an_3)}}" > C. {{$item->dap_an_3}}
                                                                @endif
                                                            </div>
                                                            <div class="answer">
                                                                @if (trim($item_lbt->dapan_hocvien===trim($item->dap_an_4)))
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="" checked value="{{trim($item->dap_an_4)}}"> D. {{$item->dap_an_4}}
                                                                @else
                                                                    <input type="radio" name="dapan_hocvien[{{$item->id}}]" id="" value="{{trim($item->dap_an_4)}}" > D. {{$item->dap_an_4}}
                                                                @endif
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
                                            <span  id="timer"></span>
                                        </div>
                                        @php
                                            $demds =0;
                                        @endphp
                                        @foreach ($danhsach as $item_ds)
                                        <?php $demds = $demds +1; ?>
                                            @if (trim($item_ds->dapan_hocvien) != null)
                                                <div class="col-2 mt-2">
                                                    <a href="#quest-{{$item_ds->id_cauhoi}}" class="menu-link btn btn-primary d-flex justify-content-center">{{$demds}}<span class="tick" id="tick-{{$demds}}">✓</span></a>
                                                    
                                                </div>
                                            @else
                                                <div class="col-2 mt-2">
                                                    <a href="#quest-{{$item_ds->id_cauhoi}}" class="menu-link btn btn-white d-flex justify-content-center">{{$demds}}</a>
                                                    <div class="">
                                                    </div>
                                                </div>
                                            @endif
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
        <script>
        function startTimer(duration, display) {
var timer = duration, minutes, seconds;
setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + " " + ":"+ " " + seconds;

            if (--timer == 0) {
                // timer = duration;
                // window.location.href = "/baihoc";
                timer =0;
                document.querySelector('#formSubmit').submit();
            }
            
        console.log(parseInt(seconds))
        window.localStorage.setItem("seconds",seconds)
        window.localStorage.setItem("minutes",minutes)
        }, 1000);
        }

        window.onload = function () {
        sec  = parseInt(window.localStorage.getItem("seconds"))
        min = parseInt(window.localStorage.getItem("minutes"))
        
        if(parseInt(min*sec)){
            var fiveMinutes = (parseInt(min*60)+sec);
        }else{
            var fiveMinutes = 60 * {{$thoigian}};
        }
      
            // var fiveMinutes = 60 * 5;
        display = document.querySelector('#timer');
        startTimer(fiveMinutes, display);
        };


        </script>
    </main>
@endsection
