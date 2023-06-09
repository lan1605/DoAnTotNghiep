@extends('admin.layout.index')

@section('content')
<main class="page-content">
    @include('layouts.notificationLogin')
<!--breadcrumb-->
@include('layouts.breadcrumb')
<!--end breadcrumb-->
<form action="/dashboard/quantrivien/{{$user->id_admin}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12 mx-auto">
        <div class="card">
        <div class="card-header py-3 bg-transparent"> 
            <div class="d-sm-flex align-items-center">
            <h5 class="mb-2 mb-sm-0">Chỉnh sửa thông tin</h5>
            <div class="ms-auto">
                <button type="submit" class="btn btn-primary">Thay đổi</button>
            </div>
            </div>
            </div>
            @include('layouts.notication')
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-lg-8">
                <div class="card shadow-none bg-light border">
                    <div class="card-body">
                        <div class="col-12 ">
                        <label class="form-label">Họ tên quản trị viên: </label>
                        <input type="text" class="form-control @error('name') is-invalid  @enderror" placeholder="Họ tên quản trị viên..." name="name" id="name" value="{{ $user->name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="col-12 mt-2">
                        <label class="form-label">Email quản trị viên: </label>
                        <input type="email" class="form-control @error('email') is-invalid  @enderror" placeholder="Email quản trị viên..." name="email" value="{{ $user->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="col-12 mt-2">
                            <label class="form-label">Số điện thoại: </label>
                            <input type="text" class="form-control @error('sdt') is-invalid  @enderror" placeholder="Số điện thoại..." name="sdt" value="{{ $user->sdt }}">
                            @error('sdt')
                                <span class="invalid-feedback" role="alert" >
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="col-12 mt-2">
                            <label class="form-label">Địa chỉ: </label>
                            <input type="text" class="form-control @error('dia_chi') is-invalid  @enderror" placeholder="Địa chỉ..." name="dia_chi" value="{{ $user->dia_chi }}">
                            @error('dia_chi')
                                <span class="invalid-feedback" role="alert" >
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        <div class="col-12 mt-2 d-flex gap-2 ">
                        <label class="form-label ml-3">Quyền: </label>
                        <br>
                        @if (Auth::user()->id_admin==$user->id_admin)
                            {{ ('Bạn không có quyền tự đổi quyền của chính mình')}}
                        @else
                        <div>
                        <?php
                        $roles=App\Models\Role::all();
                        ?>
                        @foreach ($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role_id" id="flexRadioDefault1" value="{{$role->id}}"
                                @if ($role->id==$user->role_id)
                                    {{'checked'}}
                                @else
                                    {{''}}
                                @endif
                                >
                                <label class="form-check-label" for="flexRadioDefault1">{{$role->ten_quyen}}</label>
                            </div>
                        @endforeach
                        @endif
                        </div>
                        </div>
                        <div class="col-12 mt-2 d-flex gap-2">
                        <label class="form-label ml-3">Giới tính: </label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gioi_tinh" id="flexRadioDefault1" value="0"
                                    @if ($user->gioi_tinh==0)
                                        {{'checked'}}
                                    @else
                                        {{''}}
                                    @endif>
                                    <label class="form-check-label" for="flexRadioDefault1">Nam</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gioi_tinh" id="flexRadioDefault1" value="1"
                                    @if ($user->gioi_tinh==1)
                                        {{'checked'}}
                                    @else
                                        {{''}}
                                    @endif>
                                    <label class="form-check-label" for="flexRadioDefault1">Nữ</label>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                </div>

                <div class="col-12 col-lg-4">
                <div class="card shadow-none bg-light border">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Ảnh đại diện</label>
                                <div class="image-preview" align="center">
                                    <img src="<?php
                                        if ($user->img_admin==NULL){
                                            echo "../../assets/images/icons/user.svg";
                                        }
                                        else {
                                            echo "../../admins/$user->img_admin";
                                        }
                                        ?>" alt="" id="img" class="preview-img">
                                    <input type="hidden" name="imgName" id="imgName" >
                                    <input type="file" name="img_admin" title="" value="{{$user->img_admin}}" id="img_admin" style="display:none" accept="image/png, image/gif, image/jpeg" >
                                    <label for="img_admin" class="btn btn-outline-dark px-5"><i class="bi bi-upload "></i> Chọn ảnh</label>
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
                                </div>
                        
                            </div>
                        </div>

                        </div><!--end row-->
                    </div>
                </div>  
            </div>

            </div><!--end row-->
            </div>
        </div>
        </div>
    </div><!--end row-->

</main>
<script>
    

</script>
@endsection