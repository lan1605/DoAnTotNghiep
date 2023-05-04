@extends('admin.layout.index')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    @include('layouts.breadcrumb')
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-header py-3">
            <div class="card-body">
                <div class="row">
                    @include('layouts.notication')
            <div class="col-12 col-lg-8">
                <div class="card border shadow-none w-100">
                <div class="card-body">
                <h3 class="text-center">Danh sách câu hỏi</h3>
                    @if (count($cauhois)==0)
                        {{'Không có thông tin hiển thị'}}
                    @else
                    <?php $dem = 0;?>
                        @foreach ($cauhois as $item)
                        <?php $dem = $dem +1; ?>
                            <div class="mt-2">
                                <span><strong>Câu {{$dem}}</strong>: {{$item->noi_dung}}</span>
                                <div class="{{$item->dap_an_1==$item->dap_an_dung ? 'text-success' : ""}}">
                                    <input type="radio" name="" id="" {{$item->dap_an_1==$item->dap_an_dung ? 'checked' : ""}} disabled> A. {{$item->dap_an_1}}
                                </div>
                                <div class="{{$item->dap_an_2==$item->dap_an_dung ? 'text-success' : ""}}">
                                    <input type="radio" name="" id="" {{$item->dap_an_2==$item->dap_an_dung ? 'checked' : ""}} disabled> B. {{$item->dap_an_2}}
                                </div>
                                <div class="{{$item->dap_an_3==$item->dap_an_dung ? 'text-success' : ""}}">
                                    <input type="radio" name="" id="" {{$item->dap_an_3==$item->dap_an_dung ? 'checked' : ""}} disabled> C. {{$item->dap_an_3}}
                                </div>
                                <div class="{{$item->dap_an_4==$item->dap_an_dung ? 'text-success' : ""}}">
                                    <input type="radio" name="" id="" {{$item->dap_an_4==$item->dap_an_dung ? 'checked' : ""}} disabled> D. {{$item->dap_an_4}}
                                </div>
                            </div>
                        @endforeach
                    @endif
            </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card border shadow-none w-100">
                    <div class="card-body">
                        <form class="row g-3" method="post" action="/dashboard/baitap/{{$baitap->id_baitap}}">
                            @csrf
                            <div class="col-12 mb-2 ">
                                <label class="form-label">Tên bài tập: </label>
                                <input type="text" class="form-control @error('ten_baitap') is-invalid  @enderror" placeholder="Tên bài tập..." name="ten_baitap" value="{{ $baitap->ten_baitap }}">
                                @error('ten_baitap')
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-2 ">
                                <label class="form-label">Đường dẫn tĩnh: </label>
                                <input type="text" class="form-control " placeholder="" name="ten_baitap" value="{{ $baitap->slug }}" disabled readonly>
                                
                            </div>
                                <div class="col-6">
                                    <label class="form-label">Số lượng câu hỏi: </label>
                                    <input type="text" class="form-control @error('soluong') is-invalid  @enderror" placeholder="Số lượng câu hỏi..." name="soluong" value="{{ $baitap->soluong_cauhoi }}">
                                    @error('soluong')
                                        <span class="invalid-feedback" role="alert" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Thời gian làm bài: </label>
                                    <input type="text" class="form-control @error('thoigian') is-invalid  @enderror" placeholder="Thời gian làm bài..." name="thoigian" value="{{ $baitap->thoigian_lambai }}">
                                    @error('thoigian')
                                        <span class="invalid-feedback" role="alert" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mt-2">
                                <label class="form-label">Bài học: </label>
                                <select name="id_baihoc" id="chude" class="form-select">
                                    <option value="">-Chọn bài học-</option>
                                    <?php 
                                        $baihoc = App\Models\BaiHoc::all();
                                    ?>
                                    @if (isset($baihoc))
                                    @foreach ($baihoc as $item)
                                        <option value="<?php echo $item->id_baihoc?>" {{$baitap->id_baihoc == $item->id_baihoc ? 'selected' : false}}><?php echo $item->ten_baihoc?></option>
                                    @endforeach
                                        
                                    @endif
                                </select>
                                @error('id_baihoc')
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-primary">Thay đổi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
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
{{-- @section('javascript')

<script type="text/javascript">
    $(document).ready(function () {
            $('#chude').on('change', function () {
                var chudeID = this.value;
                $('#baihoc').html('');
                $.ajax({
                    url: '{{ route('ajax.baitap') }}?id_chude='+chudeID,
                    type: 'get',
                    success: function (res) {
                        $('#baihoc').html('<option value="0">Tất cả</option>');
                        $.each(res, function (key, value) {
                            $('#baihoc').append('<option value="' + value
                                .id_baihoc + '">' + value.ten_baihoc + '</option>');
                        });
                    }
                    
                });
            });
        })
  </script>
@endsection --}}