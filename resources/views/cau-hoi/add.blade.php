@extends('admin.layout.index')
@section('content')
<main class="page-content">
    @include('layouts.breadcrumb')
    @include('layouts.notificationLogin')
    <form action="/dashboard/cauhoi/them" method="post" enctype="multipart/form-data">
        @csrf
    @include('layouts.notication')
    <div class="row">
        <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header py-3 bg-transparent"> 
            <div class="d-sm-flex align-items-center">
                <h5 class="mb-2 mb-sm-0">Thêm câu hỏi mới</h5>
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
                            <label class="form-label">Nội dung câu hỏi</label>
                            <textarea id="editor" class="form-control @error('noi_dung') is-invalid  @enderror" name="noi_dung" rows="10" placeholder="Nội dung"></textarea>
                            @error('noi_dung')
                            <span class="invalid-feedback" role="alert" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div> 
                    </div>
                    </div>
                    <div class="card shadow-none bg-light border">
                    <div class="card-body">
                        <div class="col-12">
                            <label class="form-label">Đáp án 1</label>
                            <textarea id='editor-1' class=" form-control" name="dap_an_1" rows="20" cols="20" placeholder="Đáp án 1"></textarea>
                        </div> 
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <label class="form-label">Đáp án 2</label>
                            <textarea id='editor-2' class=" form-control" name="dap_an_2" rows="10" placeholder="Đáp án 2"></textarea>
                        </div> 
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <label class="form-label">Đáp án 3</label>
                            <textarea id='editor-3' class="form-control" name="dap_an_3" rows="10" placeholder="Đáp án 3"></textarea>
                        </div> 
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <label class="form-label">Đáp án 4</label>
                            <textarea id='editor-4' class="form-control" name="dap_an_4" rows="10" placeholder="Đáp án 4"></textarea>
                        </div> 
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <label class="form-label">Đáp án đúng</label>
                            <textarea id="editor-5" class="form-control @error('dap_an_dung') is-invalid @enderror" name="dap_an_dung" rows="10" placeholder="Đáp án đúng"></textarea>
                            @error('dap_an_dung')
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
                            <label class="form-label">Tên câu hỏi</label>
                            <input type="text" class="form-control @error('ten_cauhoi') is-invalid  @enderror" placeholder="Tên câu hỏi..." name="ten_cauhoi" id="ten_cauhoi" readonly>
                            @error('ten_cauhoi')
                            <span class="invalid-feedback" role="alert" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            </div>
                            <div class="col-12">
                            <label class="form-label">Loại câu hỏi</label>
                            <select name="id_loaicauhoi" id="" class="form-select @error('id_loaicauhoi') is-invalid @enderror">
                                <?php
                                    $loaicauhois = App\Models\LoaiCauHoi::all();
                                ?>
                                @foreach ($loaicauhois as $item)
                                    <option value="{{$item->id}}" >{{$item->ten_loaicauhoi}}</option>
                                @endforeach
                            </select>
                            @error('id_loaicauhoi')
                            <span class="invalid-feedback" role="alert" >
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Chủ đề</label>
                                <select name="id_chude" id="chude" class="form-select">
                                    <option value="0">-Chọn chủ đề-</option>
                                    <?php
                                        $chudes = App\Models\ChuDe::all();
                                        
                                    ?>
                                    @foreach ($chudes as $item)
                                        <option value="{{$item->id_chude}}"  >{{$item->ten_chude}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="col-12">
                                <label class="form-label">Bài học</label>
                                <select name="id_baihoc" id="baihoc" class="form-select @error('id_baihoc') is-invalid @enderror">
                                    <option value="0">-Chọn bài học-</option>
                                </select>
                                @error('id_baihoc')
                                <span class="invalid-feedback" role="alert" >
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                <script>
                                    $(document).ready(function () {
                                        $('#chude').on('change', function () {
                                            var chudeID = this.value;
                                            $.ajax({
                                                url: '{{ route('ajax.cauhoi') }}?id_chude='+chudeID,
                                                type: 'get',
                                                success: function (res) {
                                                    $('#baihoc').html('<option value="0">-Chọn bài học-</option>');
                                                    $.each(res, function (key, value) {
                                                        $('#baihoc').append('<option value="' + value
                                                            .id_baihoc + '">' + value.ten_baihoc + '</option>');
                                                    });
                                                }
                                                
                                            });
                                        });
                                    });
                                    $(document).ready(function () {
                                        $('#baihoc').on('change', function () {
                                            var chudeID = this.value;
                                            $.ajax({
                                                url: '{{ route('ajax.tencauhoi') }}?baihoc='+chudeID,
                                                type: 'get',
                                                success: function (res) {
                                                    $('#ten_cauhoi').val(res);
                                                    
                                                }
                                                
                                            });
                                        });
                                    });
                                </script>
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
@section('javascript')
    
    @endsection