@extends('admin.layout.index')
@section('content')
<main class="page-content">
    @include('layouts.breadcrumb')
    <form action="/dashboard/baihoc/them" method="post" enctype="multipart/form-data">
        @csrf
    @include('layouts.notication')
    <div class="row">
        <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header py-3 bg-transparent"> 
            <div class="d-sm-flex align-items-center">
                <h5 class="mb-2 mb-sm-0">Thêm bài học mới</h5>
                <div class="ms-auto">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                    <button type="reset" class="btn btn-secondary">Làm mới</button>
                </div>
            </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-none bg-light border">
                    <div class="card-body">
                        <div class="col-12">
                            <label class="form-label">Nội dung bài học</label>
                            <textarea id="editor" class="form-control @error('noi_dung') is-invalid  @enderror" name="noi_dung" rows="10" placeholder="Nội dung"></textarea>
                            @error('noi_dung')
                            <span class="invalid-feedback" role="alert" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div> 
                    </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card shadow-none bg-light border">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                            <label class="form-label">Tên bài học</label>
                            <input type="text" class="form-control @error('ten_baihoc') is-invalid  @enderror" placeholder="Tên bài học..." name="ten_baihoc">
                            @error('ten_baihoc')
                            <span class="invalid-feedback" role="alert" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            </div>
                            <div class="col-12">
                            <label class="form-label">Chủ đề</label>
                            <select name="chude" id="" class="form-select @error('chude') is-invalid @enderror">
                                <?php
                                    $chudes = App\Models\ChuDe::all();
                                ?>
                                @foreach ($chudes as $item)
                                    <option value="{{$item->id_chude}}" >{{$item->ten_chude}}</option>
                                @endforeach
                            </select>
                            @error('chude')
                            <span class="invalid-feedback" role="alert" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            </div>
                            <div class="col-12 ">
                                <label class="form-label">Tình trạng</label>
                                <div class="d-flex  gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tinh_trang" id="flexRadioDefault1" value="0">
                                        <label class="form-check-label" for="flexRadioDefault1">Không hiển thị</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tinh_trang" id="flexRadioDefault1" value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">Hiển thị</label>
                                    </div>
                                </div>
                                </div>
                                @error('tinh_trang')
                            <span class="invalid-feedback" role="alert" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            </div>
                            <div class="col-12 ">
                                <label class="form-label">Video bài học</label>
                                <label class="form-label btn btn-primary" for="video" >
                                    Tải lên
                                </label>
                                <input type="file" name="video" id="video" accept="video/mp4" hidden>
                                <div class="card card-video w-100" style= "display: none">
                                    <div class="card-body ">
                                        <video controls id="video-tag" width="100%" height="200">
                                            <source id="video-source" src="splashVideo">    
                                        </video>
                                    </div>
                                </div>
                                <script>
                                    const videoSrc = document.querySelector("#video-source");
                                    const videoTag = document.querySelector("#video-tag");
                                    const inputTag = document.querySelector("#video");
                                    const cardVideo = document.querySelector(".card-video");

                                    inputTag.addEventListener('change',  readVideo)

                                    function readVideo(event) {
                                    console.log(event.target.files)
                                    if (event.target.files && event.target.files[0]) {
                                        var reader = new FileReader();
                                        cardVideo.style='display: block';
                                        reader.onload = function(e) {
                                        console.log('loaded')
                                        
                                        videoSrc.src = e.target.result
                                        videoTag.load()
                                        }.bind(this)

                                        reader.readAsDataURL(event.target.files[0]);
                                    }
                                    }
                                </script>
                                </div>
                            </div>
                            
                        </div><!--end row-->
                    </div>
                    </div>  
                </div>
            </form>
                </div><!--end row-->
            </div>
            </div>
        </div>
    </div><!--end row-->

</main>
<!--end page main-->
@endsection