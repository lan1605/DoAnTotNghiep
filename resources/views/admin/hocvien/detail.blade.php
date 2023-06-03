@extends('admin.layout.index')
    @section('content')
    <main class="page-content">
      @include('layouts.notificationLogin')
        <!--breadcrumb-->
        @include('layouts.breadcrumb')
        <!--end breadcrumb-->
        {{-- <div class="profile-cover bg-dark"></div> --}}

        <div class="row">
          <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
              <div class="card-body">
                  <h5 class="mb-0">Hoạt động của học viên</h5>
                  <hr>
                  <div class="card shadow-none border">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h6 class="mb-0">Bài tập đã làm</h6>
                      @if (count($thongtin)==0)
                          
                      @else
                        <i class="bi-trash-fill me-2 btn btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-deleteAllBT" ></i>
                      @endif
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table align-middle ">
                          <thead class="table-light">
                          <tr>
                            <th>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="select_all_bt">
                                  </div>
                              </th>
                              <th>STT</th>
                              <th>Tên bài tập</th>
                              <th>Chủ đề</th>
                              <th>Số lần làm bài</th>
                              <th>Tùy chọn</th>
                          </tr>
                          </thead>
                          <tbody>
                              @php
                                  $dem = 0;
                              @endphp
                              @foreach ($thongtin as $item=>$value)
                              @php
                                  $dem = $dem +1;
                              @endphp
                                  <tr id="bt_ids{{$item}}">
                                    <td>
                                      <input type="checkbox" name="ids_BT" id="" class="form-check-input checkbox_BT" value="{{$item}}">
                                    </td>
                                      <td>
                                          <span>
                                              {{$dem}}
                                          </span>
                                      </td>
                                      <td>
                                          <span>
                                              @php
                                                  $baitap = App\Models\BaiTap::find($item);
                                                  // dd($baitap);
                                              @endphp
                                              {{$baitap->ten_baitap}}
                                          </span>
                                      </td>
                                      <td>
                                          <span>
                                              @php
                                                  $baihoc = App\Models\BaiHoc::find($baitap->id_baihoc);
                                                  $chude = App\Models\ChuDe::find($baihoc->id_chude);
                                                  echo $chude->ten_chude;
                                              @endphp
                                          </span>
                                      </td>
                                      <td>
                                          <span>
                                              {{-- @php
                                                  $count = 0;
                                                  foreach($value as $user_kq) {
                                                      $count++;
                                                  }
                                              @endphp --}}
                                              {{count($value)}}
                                          </span>
                                      </td>
                                      <td>
                                          <span>
                                              <a href="/dashboard/thongtinlambai/{{$baitap->slug}}/{{$user->id}}">Xem chi tiết </a>

                                          </span>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                        </table>
                        @include('admin.hocvien.deleteBT')
                    </div>
                    </div>
                  </div>
                  <div class="card shadow-none border">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h6 class="mb-0">Bài đăng</h6>
                      
                      @if (count($baidang)==0)
                          
                      @else
                        <i class="bi-trash-fill me-2 btn btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-deleteAllBD" ></i>
                      @endif
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table align-middle ">
                          <thead class="table-light">
                            <tr>
                              <th>
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox"  id="select_all_bd">
                                  </div>
                              </th>
                              <th>Tên bài đăng</th>
                              <th>Chủ đề</th>
                              <th>Thời gian đăng</th>
                              <th>Bình luận</th>
                              {{-- <th>Tùy chọn</th> --}}
                          </tr>
                          </thead>
                        <tbody>
                            
                            @foreach ($baidang as $item)
                                <tr id="bd_ids{{$item->id}}">
                                  <td>
                                    <input type="checkbox" name="ids_BD" id="" class="form-check-input checkbox_BD" value="{{$item->id}}">
                                  </td>
                                  <td><span>{{$item->ten_baidang}}</span>
                                  </td>
                                  <td>
                                    <span>
                                      <?php
                                          $chude = App\Models\ChuDe::find($item->id_chude);
                                          echo $chude->ten_chude;
                                        ?>
                                    </span>
                                  </td>
                                  <td>
                                    <span>
                                      {{$item->created_at}}
                                    </span>
                                  </td>
                                  <td>
                                    <span>
                                      <?php
                                      $id = $item ->id;
                                          $binhluan = App\Models\BinhLuan::where('id_baidang',$id)->get();
                                          echo count($binhluan);
                                        ?>
                                    </span>
                                  </td>
                                  <td>
                                    <span>

                                    </span>
                                  </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                        @include('admin.hocvien.deleteBD')
                    </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
              <div class="card-body">
                  <div class="profile-avatar text-center">
                    <img src="../../assets/images/icons/user.svg" class="rounded-circle shadow" width="120" height="120" alt="">
                  </div>
                  <div class="d-flex align-items-center justify-content-around mt-5 gap-3">
                    <div class="text-center">
                    <h4 class="mb-0"> 
                        @php
                            $baitap = App\Models\KetQua::where('id_hocvien', $user->id)->orderBy('created_at')->get()->groupBy(function($data) {
                                return $data->id_baitap;
                            });
                        @endphp
                        {{count($baitap)}}
                    </h4>
                    <p class="mb-0 text-secondary ">
                        Bài tập đã làm
                    </p>
                    </div>
                    <div class="text-center">
                    <h4 class="mb-0">
                        @php
                        $baihoc = App\Models\ThoiGianHoc::where('id_hocvien', $user->id)->get();
                        @endphp
                        {{count($baihoc)}}
                    </h4>
                    <p class="mb-0 text-secondary ">Bài học đã học</p>
                    </div>
                    <div class="text-center">
                    <h4 class="mb-0">
                        @php
                        $baidang = App\Models\BaiDang::where('id_hocvien', $user->id)->get();
                        @endphp
                        {{count($baidang)}}
                    </h4>
                    <p class="mb-0 text-secondary ">Bài viết đã đăng</p>
                    </div>
                </div>
                <div class="text-center mt-4 ">
                <h4 class="mb-1">{{$user->name}}</h4>
                <div class="mt-4">{{'Học viên'}}</div>
                <p class="mb-0 text-secondary">{{$user->email}}</p>
                <p class="mb-0 text-secondary">Trường Đại học Nha Trang</p>
                </div>
                
                <hr>
                  
                  <div class="text-start ">
                    <h5 class="">Chi tiết về tài khoản học viên</h5>
                  </div>
              </div>
              <ul class="list-group list-group-flush ">
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                  Ngày tạo
                  <span class=" ">{{$user->created_at}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                  Giới tính
                  <span class=" ">
                    <?php
                      if ($user->gioi_tinh==0){
                    echo "Nam";
                }
                else{
                    echo "Nữ";
                }  
                    ?>
                  </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                  Địa chỉ
                  <span class=" ">
                    @if (isset($user->dia_chi))
                                {{$user->dia_chi}}
                            @else
                                {{"_"}}
                            @endif
                  </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                  Số điện thoại
                  <span class=" ">
                    @if (isset($user->sdt))
                                {{$user->sdt}}
                            @else
                                {{"_"}}
                            @endif
                  </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                  Trạng thái hoạt động
                  @if ($user->truy_cap >= now()->subMinutes(1))
                      <span class="badge rounded-pill bg-success">Đang hoạt động</span>
                  @else
                  <span class="badge rounded-pill bg-danger">Không hoạt động</span>
                  @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                  Kích hoạt tài khoản
                  <?php
                                $check=$user->email_verified_at;
                                if ($check==NULL){
                                    echo '<span class="badge rounded-pill bg-danger">
                                      Chưa kích hoạt
                  </span>';
                                }
                                else {
                                  echo '<span class="badge rounded-pill bg-success">
                                      Đã kích hoạt
                  </span>';
                                }
                            ?>
                </li>
              </ul>
              <div class="text-start mt-4 d-flex justify-content-center mb-4">
                <button type="button" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$user->id}}">Xóa học viên</button>
              </div>
            </div>
          </div>
        </div><!--end row-->
        <div class="modal fade" id="exampleModal-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Xóa tài khoản của học viên</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">Bạn có chắc muốn xóa tài khoản này?</div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                      <a href="/dashboard/hocvien/xoa/{{$user->id}}" class="btn btn-danger">Xóa tài khoản</a>
                  </div>
              </div>
          </div>
      </div>
      </main>

    @endsection