@extends('admin.layout.index')

@section('content')
@if (Auth::user()->role_id==1)
    <main  class="page-content">
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
                     <h4 class="mb-0">9853</h4>
                     <a href="/dashboard/quantrivien">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
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
            <div class="col">
                <div class="card rounded-4">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1">Câu hỏi</p>
                        <h4 class="mb-0">{{$truycap}}</h4>
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