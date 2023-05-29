@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('title')
    <title>
        Nộp bài
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
                                        @if (count($danhsach)==0)
                                            {{'Không có thông tin hiển thị'}}
                                        @else
                                        <div class="d-flex align-items-center">
                        
                                             
                                         </div>
                                         <div class="table-responsive mt-3">
                                           <table class="table align-middle">
                                             <thead class="table-secondary">
                                               <tr>
                                                <th>STT</th>
                                                <th>Câu hỏi</th>
                                                <th>Trạng thái</th>
                                               </tr>
                                             </thead>
                                             <tbody>
                                                @php
                                                    $dem = 0;
                                                @endphp
                                                @foreach ($danhsach as $item)
                                                    @php
                                                        $dem = $dem +1;
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            {{$dem}}
                                                        </td>
                                                        <td>
                                                            <span>
                                                                {{'Câu '.$dem}}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            
                                                                @if ($item->dapan_hocvien ==null)
                                                                    <span class="text-danger">Chưa trả lời</span>
                                                                @else
                                                                    <span class="text-success">Đã lưu câu trả lời</span>
                                                                @endif
                                                            
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            
                                             </tbody>
                                           </table>
                                         </div>
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
                                     <p class="my-0"><strong>Học viên: </strong>{{Auth::user()->name}}</p>
                                     <p class="my-0"><strong>Số lượng câu hỏi: </strong>{{$baitap->soluong_cauhoi}} câu</p>
                                     <p class="my-0"><strong>Thời gian làm bài: </strong>{{$baitap->thoigian_lambai}} phút</p>
                                     <div class="d-flex mt-2 justify-content-center">
                                         <a href="/baitap/{{$baitap->slug}}/ketqua" class="btn btn-success" >Xem kết quả</a>
                                     </div>
                                </div>
                            </div>
                            
                        {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </main>
@endsection
