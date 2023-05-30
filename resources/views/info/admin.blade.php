@extends('admin.layout.index')
    @section('content')
    <main class="page-content">
      
      @include('layouts.breadcrumb')
      @include('layouts.notication')

        <div class="row">
          <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
              <div class="card-body">
                  <h5 class="mb-0">Tài khoản của tôi</h5>
                  <hr>
                  <div class="card shadow-none border">
                    <div class="card-header">
                      <h6 class="mb-0">Thông tin cá nhân</h6>
                    </div>
                    <div class="card-body">
                      <form class="row g-3" action="/dashboard/profile" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-6">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control @error('name') is-invalid  @enderror" value="{{$user->name}}" name='name' id="name">
                            @error('name')
                              <span class="invalid-feedback" role="alert" >
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror 
                        </div>
                        <div class="col-6">
                          <label class="form-label">Địa chỉ email</label>
                          <input type="text" class="form-control @error('email') is-invalid  @enderror" value="{{$user->email}}" name="email">
                          @error('email')
                              <span class="invalid-feedback" role="alert" >
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror 
                        </div>
                          <div class="col-6">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control @error('sdt') is-invalid  @enderror" value="{{$user->sdt}}" name="sdt">
                            @error('sdt')
                              <span class="invalid-feedback" role="alert" >
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror 
                        </div>
                        <div class="col-6">
                            <label class="form-label">Giới tính</label>
                            <select name="gioi_tinh" id="" class="form-control @error('gioi_tinh') is-invalid  @enderror">
                              <option value="0" {{$user->gioi_tinh==0 ? 'selected' : " "}}>Nam</option>
                              <option value="1" {{$user->gioi_tinh==1 ? 'selected' : " "}}>Nữ</option>
                            </select>
                            @error('gioi_tinh')
                              <span class="invalid-feedback" role="alert" >
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror 
                        </div>
                        <div class="col-12">
                          <label class="form-label">Địa chỉ</label>
                          <input type="text" class="form-control @error('dia_chi') is-invalid  @enderror" value="{{$user->dia_chi}}" name="dia_chi">
                          @error('dia_chi')
                              <span class="invalid-feedback" role="alert" >
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror 
                        </div>
                    </div>
                  </div>
                  <div class="card shadow-none border">
                    <div class="card-header">
                      <h6 class="mb-0">Thay đổi mật khẩu</h6>
                    </div>
                    <div class="card-body">
                      <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label">Mật khẩu hiện tại</label>
                            <div class="ms-auto position-relative">
                              <input class="form-control ps-5 @error('name') is-invalid  @enderror" type="password" placeholder="mật khẩu hiện tại"name="old_password" value="" id='old_pw'>
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3 fs-5"><i class="bx bx-show" id='ic_old'></i></div>
                          </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Mật khẩu mới</label>
                            <div class="ms-auto position-relative">
                              <input class="form-control ps-5" type="password" placeholder="mật khẩu mới"name="new_password" value="" id='new_pw'>
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3 fs-5"><i class="bx bx-show" id='ic_new'></i></div>
                          </div>
                        </div>
                        <script>
                          function changeType(id_pw, ic){
                            if (id_pw.type=='password'){
                              ic.classList.remove('bx-show');
                              id_pw.setAttribute('type', 'text');
                              ic.classList.add('bx-hide');
                            }
                            else {
                              ic.classList.remove('bx-hide');
                              id_pw.setAttribute('type', 'password');
                              ic.classList.add('bx-show');
                            }
                          }
                          const icOld = document.getElementById('ic_old');
                          const icNew = document.getElementById('ic_new');
                          const idOld = document.getElementById('old_pw');
                          const idNew = document.getElementById('new_pw');
                          icOld.addEventListener('click', function(){
                            changeType(idOld, icOld);
                          });
                          icNew.addEventListener('click', function(){
                            changeType(idNew, icNew)
                          });

                        </script>
                      </div>
                    </div>
                  </div>
                  <div class="text-start">
                    <button type="submit" class="btn btn-primary px-4">Lưu thay đổi</button>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
              <div class="card-body">
                  <div class="profile-avatar text-center  position-relative " >
                    <img src="<?php
                    if ($user->img_admin==NULL){
                        echo "../../assets/images/icons/user.svg";
                    }
                    else {
                        echo "../../admins/$user->img_admin";
                    }
                    ?>" alt="" id="img" class=" rounded-circle shadow " width="120" height="120">
                                    <input type="hidden" name="imgName" id="imgName" >
                                    <input type="file" name="img_admin" title="" value="{{$user->img_admin}}" id="img_admin" style="display:none" accept="image/png, image/gif, image/jpeg" >
                                    <label for="img_admin" class="bg-white hover-btn position-absolute px-2 py-1 rounded-circle shadow" ><i class="bi bi-upload "></i></label>
                                    <style>
                                      .hover-btn{
                                        left: 55%;
                                        top: 70%;
                                        cursor: pointer;
                                      }
                                    </style>
                                    @error('img_admin')
                            <span class="invalid-feedback" role="alert" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                                    <script>
                                        function locdau (str) {
                                            str= str.toLowerCase();
                                            str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
                                            str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
                                            str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
                                            str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
                                            str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
                                            str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
                                            str= str.replace(/đ/g,"d");
                                            str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-");
                                            /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
                                            str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
                                            str= str.replace(/^\-+|\-+$/g,"");
                                            //cắt bỏ ký tự - ở đầu và cuối chuỗi
                                            return str;
                                        }
                                        const nameStr = document.querySelector("#name");
                                        
                                        const btnUpdateImg = document.querySelector("#img_admin");
                                            btnUpdateImg.addEventListener("change", function() {
                                                const img = document.querySelector("#img");
                                                const imgName = document.querySelector("#imgName");
                                                imgName.value = locdau(nameStr.value);
                                                img.src = window.URL.createObjectURL(btnUpdateImg.files[0]);
                                            });
                                    </script>
                  </div>
                </form>
                  <div class="d-flex align-items-center justify-content-around mt-5 gap-3">
                      <div class="text-center">
                        <h4 class="mb-0"> 
                          @php
                            $cauhoi = App\Models\CauHoi::where('id_admin', $user->id_admin)->get();
                          @endphp
                          {{count($cauhoi)}}
                      </h4>
                        <p class="mb-0 text-secondary">
                          Câu hỏi
                        </p>
                      </div>
                      <div class="text-center">
                        <h4 class="mb-0">
                          @php
                            $baihoc = App\Models\BaiHoc::where('id_admin', $user->id_admin)->get();
                          @endphp
                          {{count($baihoc)}}
                        </h4>
                        <p class="mb-0 text-secondary">Bài học</p>
                      </div>
                      {{-- <div class="text-center">
                        <h4 class="mb-0">86</h4>
                        <p class="mb-0 text-secondary">Comments</p>
                      </div> --}}
                  </div>
                  <div class="text-center mt-4">
                    <h4 class="mb-1">{{$user->name}}, 27</h4>
                    <div class="mt-4"></div>
                    <h6 class="mb-1">
                      @php
                          $role = App\Models\Role::find($user->role_id);
                      @endphp
                      {{$role->ten_quyen}}
                    </h6>
                    <p class="mb-0 text-secondary">Trường Đại học Nha Trang</p>
                  </div>
                  <hr>
                  
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                  Trạng thái hoạt động
                  @if ($user->truy_cap >= now()->subMinutes(1))
                      <span class="badge rounded-pill bg-success">Đang hoạt động</span>
                  @else
                  <span class="badge rounded-pill bg-danger">Không hoạt động</span>
                  @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                  Ngày tạo tài khoản
                  <span class="badge bg-primary rounded-pill">
                    {{$user->created_at}}
                  </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                  Lần thay đổi gần nhất
                  <span class="badge bg-primary rounded-pill">
                    {{$user->updated_at}}
                  </span>
                </li>
              </ul>
              <div class="d-flex align-items-center justify-content-around mt-3 mb-3 gap-3">
                <button type="button" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Xóa tài khoản</button>
              </div>
            </div>
          </div>
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa tài khoản cá nhân</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Bạn có chắc muốn xóa tài khoản này?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <a href="/dashboard/profile/xoa" class="btn btn-danger">Xóa tài khoản</a>
                    </div>
                </div>
            </div>
        </div>
        </div><!--end row-->

      </main>

    @endsection