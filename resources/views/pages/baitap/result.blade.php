@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('title')
    <title>
        Kết quả của bài tập {{App\Models\BaiHoc::find($baitap->id_baihoc)->ten_baihoc}}
    </title>
@endsection
@section('content')
{{-- @include('layouts.layout.breadcrumb') --}}
    <main>
        <div style="background-color: white">
            <div class="container mt-2">
                
                <div class="row my-5">
                    <div class="col-12 col-lg-8 ">
                        <div >
                            <div class="card-header py-2 " >
                                <h2 class="fw-500 text-primary">Danh sách câu trả lời</h2>
                            </div>
                            <div class="card-body">
                                <div class="row g-2 mt-1">
                                    <div class="col-12" id="contents">
                                        @if (count($cauhoi)==0)
                                            {{'Không có thông tin hiển thị'}}
                                        @else
                                        <?php $dem = 0;?>
                                            @foreach ($cauhoi as $item)
                                                <?php $dem = $dem +1; ?>
                                                @foreach ($danhsach as $item_lbt)
                                                    @if ($item->id ===$item_lbt->id_cauhoi)
                                                        <div class="mt-2 " id="quest-{{$item->id}}">
                                                            <h5><strong>Câu {{$dem}}</strong>: {{$item->noi_dung}}</h5>
                                                            <div class="question-answer fs-6">
                                                                <div class="answer">
                                                                    @if ((trim($item_lbt->dapan_hocvien)===trim($item->dap_an_dung)) && (trim($item_lbt->dapan_hocvien)===trim($item->dap_an_1)))
                                                                        <input type="radio" name="" id="" checked value="{{trim($item->dap_an_1)}}" disabled > <span class="text-success">A. {{$item->dap_an_1}}</span>
                                                                    @else
                                                                        @if ((trim($item_lbt->dapan_hocvien)!==trim($item->dap_an_dung)) && (trim($item_lbt->dapan_hocvien)===trim($item->dap_an_1)))
                                                                            <input type="radio" name="" id="" checked value="{{trim($item->dap_an_1)}}" disabled > <span class="text-danger">A. {{$item->dap_an_1}}</span>
                                                                        @else
                                                                            @if ((trim($item->dap_an_1)===trim($item->dap_an_dung)))
                                                                                <input type="radio" name="" id="" checked value="{{trim($item->dap_an_1)}}" disabled > <span class="text-success">A. {{$item->dap_an_1}}</span>
                                                                            @else
                                                                                <input type="radio" name="" id="" value="{{trim($item->dap_an_1)}}" disabled > A. {{$item->dap_an_1}}
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="answer">
                                                                    @if ((trim($item_lbt->dapan_hocvien)===trim($item->dap_an_dung)) && (trim($item_lbt->dapan_hocvien)===trim($item->dap_an_2)))
                                                                        <input type="radio" name="" id="" checked value="{{trim($item->dap_an_2)}}" disabled > <span class="text-success">B. {{$item->dap_an_2}}</span>
                                                                    @else
                                                                        @if ((trim($item_lbt->dapan_hocvien)!==trim($item->dap_an_dung)) && (trim($item_lbt->dapan_hocvien)===trim($item->dap_an_2)))
                                                                            <input type="radio" name="" id="" checked value="{{trim($item->dap_an_2)}}" disabled > <span class="text-danger">B. {{$item->dap_an_2}}</span>
                                                                        @else
                                                                            @if ((trim($item->dap_an_2)===trim($item->dap_an_dung)))
                                                                                <input type="radio" name="" id="" checked value="{{trim($item->dap_an_2)}}" disabled > <span class="text-success">B. {{$item->dap_an_2}}</span>
                                                                            @else
                                                                                <input type="radio" name="" id="" value="{{trim($item->dap_an_2)}}" disabled > B. {{$item->dap_an_2}}
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="answer">
                                                                    @if ((trim($item_lbt->dapan_hocvien)===trim($item->dap_an_dung)) && (trim($item_lbt->dapan_hocvien)===trim($item->dap_an_3)))
                                                                        <input type="radio" name="" id="" checked value="{{trim($item->dap_an_3)}}" disabled > <span class="text-success">C. {{$item->dap_an_3}}</span>
                                                                    @else
                                                                        @if ((trim($item_lbt->dapan_hocvien)!==trim($item->dap_an_dung)) && (trim($item_lbt->dapan_hocvien)===trim($item->dap_an_3)))
                                                                            <input type="radio" name="" id="" checked value="{{trim($item->dap_an_3)}}" disabled > <span class="text-danger">C. {{$item->dap_an_3}}</span>
                                                                        @else
                                                                            @if ((trim($item->dap_an_3)===trim($item->dap_an_dung)))
                                                                                <input type="radio" name="" id="" checked value="{{trim($item->dap_an_3)}}" disabled > <span class="text-success">C. {{$item->dap_an_3}}</span>
                                                                            @else
                                                                                <input type="radio" name="" id="" value="{{trim($item->dap_an_3)}}" disabled > C. {{$item->dap_an_3}}
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="answer">
                                                                    @if ((trim($item_lbt->dapan_hocvien)===trim($item->dap_an_dung)) && (trim($item_lbt->dapan_hocvien)===trim($item->dap_an_4)))
                                                                        <input type="radio" name="" id="" checked value="{{trim($item->dap_an_4)}}" disabled > <span class="text-success">D. {{$item->dap_an_4}}</span>
                                                                    @else
                                                                        @if ((trim($item_lbt->dapan_hocvien)!==trim($item->dap_an_dung)) && (trim($item_lbt->dapan_hocvien)===trim($item->dap_an_4)))
                                                                            <input type="radio" name="" id="" checked value="{{trim($item->dap_an_4)}}" disabled > <span class="text-danger">D. {{$item->dap_an_4}}</span>
                                                                        @else
                                                                            @if ((trim($item->dap_an_4)===trim($item->dap_an_dung)))
                                                                                <input type="radio" name="" id="" checked value="{{trim($item->dap_an_4)}}" disabled > <span class="text-success">D. {{$item->dap_an_4}}</span>
                                                                            @else
                                                                                <input type="radio" name="" id="" value="{{trim($item->dap_an_4)}}" disabled > D. {{$item->dap_an_4}}
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="alert border-0 bg-light-success alert-dismissible fade show py-2">
                                                                <strong>Đáp án đúng:</strong> {{$item->dap_an_dung}}
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
                                    <p class="my-0"><strong>Thời gian làm bài: </strong>{{$baitap->thoigian_lambai}} phút</p>
                                    <p class="my-0"><strong>Số lượng câu hỏi: </strong>{{$baitap->soluong_cauhoi}} câu</p>
                                    <p class="my-0"><strong>Số câu đúng: </strong>{{$ketqua->soluong_caudung}}/{{$baitap->soluong_cauhoi}}</p>
                                    <p class="my-0"><strong>Điểm: </strong>{{$ketqua->tong_diem}}</p>
                                    <p class="my-0"><strong>Số lần làm bài: </strong>{{$solanlambai}}</p>
                                    <div class="d-flex mt-2 justify-content-center">
                                        @if ($solanlambai === 3)
                                                
                                        @else
                                            <a href="/bai-tap/{{$baitap->slug}}" class="btn btn-primary">Làm lại bài tập</a>
                                        @endif
                                        
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
                                        @foreach ($cauhoi as $itemch)
                                        <?php $demds = $demds +1; ?>
                                            @foreach ($danhsach as $item_ds)
                                                @if ($itemch->id === $item_ds->id_cauhoi)
                                                    <div class="col-2 mt-2">
                                                        <a href="#quest-{{$item_ds->id_cauhoi}}" class="menu-link btn {{trim($itemch->dap_an_dung) === trim($item_ds->dapan_hocvien) ? 'btn-success' : 'btn-danger'}} d-flex justify-content-center">{{$demds}}</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
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
