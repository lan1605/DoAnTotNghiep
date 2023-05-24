@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('content')

    <main>
        <div style="background-color: #f7f8fa">
            <div class="container">
                <div class="row g-3 d-flex align-items-center mt-0 ">
                    <div class="d-sm-flex mb-3 justify-content-center gap-2">
                        <a href="/goc-hoi-dap" class="btn btn-white mb-3 mb-lg-0">Tất cả</a>
                        <a href="/goc-hoi-dap/danh-sach" class="btn btn-primary mb-3 mb-lg-0">Bài đăng của bạn</a>
                        <a href="/goc-hoi-dap/them-moi" class="btn btn-white mb-3 mb-lg-0">Thêm mới</a>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.layout.breadcrumb')
        <div style="background-color: white">
            <div class="container mt-2">
                @include('layouts.notication')
                <div class="row my-2">
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Chỉnh sửa bài viết</h5>
                                </div>
                                <hr/>
                                <form action="/goc-hoi-dap/{{$baidang->slug}}/chinh-sua" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Tên bài viết</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('ten_baidangEdit') is-invalid  @enderror" id="inputEnterYourName" name="ten_baidangEdit" placeholder="Tên bài viết..." value="{{$baidang->ten_baidang}}">
                                            @error('ten_baidangEdit')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Chủ đề</label>
                                        <div class="col-sm-9">
                                            <select name="id_chudeEdit" id="" class="form-select @error('id_chudeEdit') is-invalid  @enderror">
                                                <option value="0">-Chọn chủ đề-</option>
                                                @php
                                                    $chude = App\Models\ChuDe::all();
                                                @endphp
                                                @foreach ($chude as $item)
                                                    <option value="{{$item->id_chude}}" {{$baidang->id_chude === $item->id_chude ? 'selected' : ""}}>{{$item->ten_chude}}</option>
                                                @endforeach
                                            </select>
                                            @error('id_chudeEdit')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputAddress4" class="col-sm-3 col-form-label">Nội dung bài viết</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('noi_dungEdit') is-invalid  @enderror" id="ckeditor" rows="3" placeholder="Nội dung" name="noi_dungEdit">{{$baidang->noidung_baidang}}</textarea>
                                            @error('noi_dungEdit')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary px-5">Thay đổi</button>
                                        </form>
                                        
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
@section('javascript')
<script>
    ClassicEditor
        .create( document.querySelector( '#ckeditor' ), {
            ckfinder:{
                uploadUrl: '{{ route('images.upload').'?_token='.csrf_token() }}',
            },
            // More configuration options.
            // ...
            
        } )
        .then( editor => {
            // console.log( error );
            editor.ui.view.editable.element.style.height = '500px';
        } )
        .catch( error => {
            console.log( error );
        } );
        
        
    </script>
@endsection