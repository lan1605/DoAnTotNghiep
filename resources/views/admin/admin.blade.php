@extends('admin.layout.index')

@section('content')
@if (Auth::user()->role_id==1)
    <main  class="page-content">
      @include('layouts.notificationLogin')
      
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
            <div class="col">
             <div class="card rounded-4">
               <div class="card-body">
                 <div class="d-flex align-items-center">
                   <div class="">
                     <p class="mb-1">Quản trị viên</p>
                     <h4 class="mb-0">{{$admin}}</h4>
                     <a href="/dashboard/quantrivien">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
                   </div>
                   <div class="ms-auto widget-icon bg-primary text-white">
                     <i class=" bi bi-people-fill"></i>
                   </div>
                 </div>
                
               </div>
             </div>
            </div>
            <div class="col">
             <div class="card rounded-4">
               <div class="card-body">
                 <div class="d-flex align-items-center">
                   <div class="">
                     <p class="mb-1">Học viên</p>
                     <h4 class="mb-0">{{$hocvien}}</h4>
                     <a href="/dashboard/hocvien">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
                   </div>
                   <div class="ms-auto widget-icon bg-orange text-white">
                     <i class="bx bx-user"></i>
                   </div>
                 </div>
               </div>
             </div>
            </div>
            <div class="col">
                <div class="card rounded-4">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1">Bài đăng</p>
                        <h4 class="mb-0">{{$baidang}}</h4>
                        <a href="/dashboard/baidang">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
                      </div>
                      <div class="ms-auto widget-icon bg-success text-white">
                        <i class=" bx bx-happy"></i>
                      </div>
                    </div>
                  </div>
                </div>
               </div>
            <div class="col">
             <div class="card rounded-4">
               <div class="card-body">
                 <div class="d-flex align-items-center">
                   <div class="">
                     <p class="mb-1">Liên hệ</p>
                     <h4 class="mb-0">{{$lienhe}}</h4>
                     <a href="/dashboard/lienhe">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
                   </div>
                   <div class="ms-auto widget-icon bg-info text-white">
                     <i class="bi bi-people-fill"></i>
                   </div>
                 </div>
               </div>
             </div>
            </div>
            <div class="col">
             <div class="card rounded-4">
               <div class="card-body">
                 <div class="d-flex align-items-center">
                   <div class="">
                     <p class="mb-1">Bài học</p>
                     <h4 class="mb-0">{{$baihoc}}</h4>
                     <a href="/dashboard/baihoc">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
                   </div>
                   <div class="ms-auto widget-icon bg-info text-white">
                     <i class="bx bx-book"></i>
                   </div>
                 </div>
               </div>
             </div>
            </div>
            <div class="col">
             <div class="card rounded-4">
               <div class="card-body">
                 <div class="d-flex align-items-center">
                   <div class="">
                     <p class="mb-1">Bài tập</p>
                     <h4 class="mb-0">{{$baitap}}</h4>
                     <a href="/dashboard/baitap">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
                   </div>
                   <div class="ms-auto widget-icon bg-orange text-white">
                     <i class=" bx bx-note"></i>
                   </div>
                 </div>
               </div>
             </div>
            </div>
            <div class="col">
                <div class="card rounded-4">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1">Câu hỏi</p>
                        <h4 class="mb-0">{{$cauhoi}}</h4>
                        <a href="/dashboard/cauhoi">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
                      </div>
                      <div class="ms-auto widget-icon bg-success text-white">
                        <i class=" bx bx-question-mark"></i>
                      </div>
                    </div>
                  </div>
                </div>
               </div>
            
        </div>
        <div class="row">
          <div class="col d-flex">
            <div class="card rounded-4 w-100">
             <div class="card-body">
               <div class="d-flex align-items-center mb-3">
                 <h6 class="mb-0">Lượng truy cập</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center">
                  <thead>
                    <th>
                      Tổng lượt truy cập
                    </th>
                    <th>
                      Lượng truy cập tháng trước
                    </th>
                    <th>
                      Lượng truy cập tháng này
                    </th>
                    <th>
                      Đang hoạt động
                    </th>
                  </thead>
                  <tbody>
                    <tr>
                      <td><span>{{$truycap}}</span></td>
                      <td><span>{{$tong_thangtruoc}}</span></td>
                      <td><span>{{$tong_thangnay}}</span></td>
                      <td><span>{{$truycap_hientai}}</span></td>
                    </tr>
                </tbody></table>
                </div>
             </div>
            </div>
          </div>
          
        </div>
        <div class="row row-cols-1 row-cols-lg-2">
          <div class="col d-flex">
            <div class="card rounded-4 w-100">
             <div class="card-body">
               <div class="d-flex align-items-center mb-3">
                 <h6 class="mb-0">Bài viết xem nhiều</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center">
                  <tbody>
                    @foreach ($baidang_truycap as $item)
                        <tr>
                          <td>
                            <span>{{$item->ten_baidang}}</span>
                          </td>
                          <td>
                            <span class="py-0">{{$item->truy_cap}}</span>
                          </td>
                        </tr>
                    @endforeach
                </tbody></table>
                </div>
             </div>
            </div>
          </div>
          <div class="col d-flex">
            <div class="card rounded-4 w-100">
             <div class="card-body">
               <div class="d-flex align-items-center mb-3">
                 <h6 class="mb-0">Bài học xem nhiều</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center">
                  <tbody>
                    @foreach ($baihoc_truycap as $item)
                        <tr>
                          <td>
                            <span>{{$item->ten_baihoc}}</span>
                          </td>
                          <td>
                            <span class="py-0">{{$item->luotxem}}</span>
                          </td>
                        </tr>
                    @endforeach
                </tbody></table>
                </div>
             </div>
            </div>
          </div>
          
        </div>
    </main>                     
@else
<main class="page-content">
    <div class="col">
        <div class="card rounded-4">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="">
                <p class="mb-1">Bài học</p>
                <h4 class="mb-0">{{$baihoc}}</h4>
                <a href="/dashboard/baihoc">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
              </div>
              <div class="ms-auto widget-icon bg-info text-white">
                <i class="bx bx-book"></i>
              </div>
            </div>
          </div>
        </div>
       </div>
       <div class="col">
        <div class="card rounded-4">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="">
                <p class="mb-1">Bài tập</p>
                <h4 class="mb-0">{{$baitap}}</h4>
                <a href="/dashboard/baitap">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
              </div>
              <div class="ms-auto widget-icon bg-orange text-white">
                <i class=" bx bx-note"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
          <div class="card rounded-4">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="">
                  <p class="mb-1">Câu hỏi</p>
                  <h4 class="mb-0">{{$cauhoi}}</h4>
                  <a href="/dashboard/cauhoi">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="ms-auto widget-icon bg-success text-white">
                  <i class=" bx bx-question-mark"></i>
                </div>
              </div>
            </div>
          </div>
      </div>
      
</main>
@endif
@endsection