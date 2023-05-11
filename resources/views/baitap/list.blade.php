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
                    {{-- THÊM MỚI BÀI TẬP --}}
                        <div class="modal fade" id="exampleModal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa bài học</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($route)
                                        <form class="row g-3" method="post" action="/dashboard/baitap/">
                                            @csrf
                                                <div class="col-6">
                                                    <label class="form-label">Tên bài tập: </label>
                                                <input type="text" class="form-control @error('ten_baitap') is-invalid  @enderror" placeholder="Tên bài tập..." name="ten_baitap" value="{{ old('ten_baitap') }}">
                                                @error('ten_baitap')
                                                    <span class="invalid-feedback" role="alert" >
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Số lượng câu hỏi: </label>
                                                    <input type="text" class="form-control @error('soluong') is-invalid  @enderror" placeholder="Số lượng câu hỏi..." name="soluong" value="{{ old('soluong') }}">
                                                    @error('soluong')
                                                        <span class="invalid-feedback" role="alert" >
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                
                                                <div class="col-12 mt-2">
                                                <label class="form-label">Chủ đề: </label>
                                                <select name="" id="chude" class="form-select">
                                                    <option value="">-Chọn chủ đề-</option>
                                                    <?php 
                                                        $chude = App\Models\ChuDe::all();
                                                    ?>
                                                    @if (isset($chude))
                                                    @foreach ($chude as $item)
                                                        <option value="<?php echo $item->id_chude?>" {{request()->id_chude==$item->id_chude ? 'selected' : false}}><?php echo $item->ten_chude?></option>
                                                    @endforeach
                                                        
                                                    @endif
                                                </select>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <label for="" class="form-label">Bài học</label>
                                                    <select name="id_baihoc" id="baihoc" class="form-select @error('id_baihoc') is-invalid  @enderror">
                                                        <option value="">-Chọn bài học-</option>
                                                    </select>
                                                <script>
                                                    $(document).ready(function () {
                                                    $('#chude').on('change', function () {
                                                        var chudeID = this.value;
                                                        $.ajax({
                                                            url: '{{ route('ajax.cauhoi') }}?id_chude='+chudeID,
                                                            type: 'get',
                                                            success: function (res) {
                                                                $('#baihoc').html('<option value="">-Chọn bài học-</option>');
                                                                $.each(res, function (key, value) {
                                                                    $('#baihoc').append('<option value="' + value
                                                                        .id_baihoc + '">' + value.ten_baihoc + '</option>');
                                                                });
                                                            }
                                                            
                                                        });
                                                    });
                                                });
                        
                                                </script>
                                                @error('id_baihoc')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                                </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary">Thêm bài tập</button>
                                                </div>
                                            </div>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- end --}}
                    {{-- HIỂN THỊ DANH SÁCH --}}
                        <div class="col-12 col-lg-12 d-flex">
                            <div class="card border shadow-none w-100">
                            <div class="card-body">
                            <form action="" method="get" class="d-sm-flex mb-3">
                                <div class="mb-2 mb-sm-0 ms-2">
                                    <?php
                                        $role = App\Models\ChuDe::all();    
                                    ?>
                                    <select name="find_cate" id="chude" class="form-select">
                                        <option value="0">Tất cả</option>
                                        @if (isset($role))
                                        @foreach ($role as $item)
                                            <option value="<?php echo $item->id_chude?>" {{request()->find_cate==$item->id_chude ? 'selected' : false}}><?php echo $item->ten_chude?></option>
                                        @endforeach
                                            
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-2 mb-sm-0 ms-2">
                                    <div class="ms-auto position-relative">
                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                                        <input class="form-control ps-5" type="text" placeholder="tìm kiếm bài tập..."name="key_find" value="{{Request()->key_find}}">
                                    </div>
                                </div>
                                <div class="mb-2 mb-sm-0 ms-2">
                                    <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                                </div>
                                <div class="ms-auto">
                                    <a href="#" class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-create"><i class="bi bi-plus-square-fill me-2"></i>Thêm mới</a>
                                    <a href="#" class="btn btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-deleteAll"><i class="bi-trash-fill me-2"></i>Xóa</a>
                                </div>
                            </form>
                            @if (count($baitaps)==0)
                                {{"Không có thông tin hiển thị"}}   
                            @else  
                            <div class="table-responsive">
                                <table class="table align-middle table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="select_all">
                                                </div>
                                        </th>
                                        <th>Tên bài tập</th>
                                        <th>Đường dẫn tĩnh</th>
                                        <th>Chủ đề</th>
                                        <th>Số lượng câu hỏi</th>
                                        <th>Thời gian làm bài (phút)</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                    
                                    @foreach ($baitaps as $baitap)
                                        <tr id="baitap_ids{{$baitap->id_baitap}}">
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox-item " type="checkbox" name="ids" value="{{$baitap->id_baitap}}">
                                                </div>
                                            </td>
                                            <td><span>{{$baitap->ten_baitap}}</span></td>
                                            <td><span>{{$baitap->slug}}</span></td>
                                            <td><span>
                                                <?php
                                                    $id_baihoc = $baitap->id_baihoc;
                                                    $chude = App\Models\BaiHoc::find($id_baihoc);
                                                    $id_chude = App\Models\ChuDe::find($chude->id_chude);
                                                    if ($id_chude==null){
                                                        echo "_";
                                                    }
                                                    else {
                
                                                        echo $id_chude->ten_chude;
                                                    }
                                                ?>
                                            </span></td>
                                            <td>
                                            <span>{{$baitap->soluong_cauhoi}}</span>
                                            </td>
                                            <td>
                                            <span>{{$baitap->thoigian_lambai}}</span>
                                            </td>
                                    
                                            
                                            <td>
                                                <div class="d-flex align-items-center gap-3 fs-6">
                                                    <i class="bi bi-pencil-fill text-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-edit{{$baitap->id_baitap}}" aria-label="Chỉnh sửa"></i>
                                                    {{-- <a href="/dashboard/baitap/{{$baitap->id_baitap}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-pencil-fill"></i></a> --}}
                                                    <i class="bi bi-trash-fill text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$baitap->id_baitap}}" aria-label="Delete" style="cursor: pointer"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="exampleModal-{{$baitap->id_baitap}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Xóa bài học</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">Bạn có chắc muốn xóa bài tập "{{$baitap->ten_baitap}}"?</div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <a href="/dashboard/baitap/xoa/{{$baitap->id_baitap}}" class="btn btn-danger">Xóa bài tập</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- THAY ĐỔI THÔNG TIN --}}
                                        <div class="modal fade" id="exampleModal-edit{{$baitap->id_baitap}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thay đổi thông tin bài tập</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <form class="row g-2" method="get" action="/dashboard/baitap/{{$baitap->id_baitap}}">
                                                                @csrf
                                                                    <div class="col-6">
                                                                        <label class="form-label">Tên bài tập: </label>
                                                                    <input type="text" class="form-control @error('ten_baitapEdit') is-invalid  @enderror" placeholder="Tên bài tập..." name="ten_baitapEdit" value="{{ $baitap->ten_baitap }}">
                                                                    @error('ten_baitapEdit')
                                                                        <span class="invalid-feedback" role="alert" >
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label class="form-label">Số lượng câu hỏi: </label>
                                                                        <input type="text" class="form-control @error('soluongEdit') is-invalid  @enderror" placeholder="Số lượng câu hỏi..." name="soluongEdit" value="{{ $baitap->soluong_cauhoi }}">
                                                                        @error('soluongEdit')
                                                                            <span class="invalid-feedback" role="alert" >
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    
                                                                    <div class="col-12 mt-2">
                                                                    <label class="form-label">Chủ đề: </label>
                                                                    <select name="" id="chude{{$baitap->id_baitap}}" class="form-select">
                                                                        <option value="">-Chọn chủ đề-</option>
                                                                        <?php 
                                                                            $chude_baitap = App\Models\BaiHoc::where('id_baihoc', $baitap->id_baihoc)->first();
                                                                            $chude = App\Models\ChuDe::all();
                                                                        ?>
                                                                        @if (isset($chude))
                                                                        @foreach ($chude as $item)
                                                                            <option value="<?php echo $item->id_chude?>" {{$chude_baitap->id_chude==$item->id_chude ? 'selected' : false}}><?php echo $item->ten_chude?></option>
                                                                        @endforeach
                                                                            
                                                                        @endif
                                                                    </select>
                                                                    </div>
                                                                    <div class="col-12 mt-2">
                                                                        <label for="" class="form-label">Bài học</label>
                                                                        <select name="id_baihocEdit" id="baihoc{{$baitap->id_baitap}}" class="form-select @error('id_baihocEdit') is-invalid  @enderror">
                                                                            <option value="{{$baitap->id_baihoc}}">{{$chude_baitap->ten_baihoc}}</option>
                                                                        </select>
                                                                    <script>
                                                                        $(document).ready(function () {
                                                                        $('#chude{{$baitap->id_baitap}}').on('change', function () {
                                                                            var chudeID = this.value;
                                                                            $.ajax({
                                                                                url: '{{ route('ajax.cauhoi') }}?id_chude='+chudeID,
                                                                                type: 'get',
                                                                                success: function (res) {
                                                                                    $('#baihoc{{$baitap->id_baitap}}').html('<option value="">-Chọn bài học-</option>');
                                                                                    $.each(res, function (key, value) {
                                                                                        $('#baihoc{{$baitap->id_baitap}}').append('<option value="' + value
                                                                                            .id_baihoc + '"{{$baitap->id_baihoc=='.value.id_baihoc.' ? "selecetd" : false}}>' + value.ten_baihoc + '</option>');
                                                                                    });
                                                                                }
                                                                                
                                                                            });
                                                                        });
                                                                    });
                                            
                                                                    </script>
                                                                    @error('id_baihocEdit')
                                                                    <span class="invalid-feedback" role="alert" >
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                    </div>
                                                                <div class="col-12">
                                                                    <div class="d-grid">
                                                                        <button class="btn btn-primary">Thêm bài tập</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                            {{ $baitaps->links('pagination.custom') }}
                            <div class="float-start mt-2">
                                Hiển thị {{ $baitaps->firstItem() }} đến {{ $baitaps->lastItem() }} trong tổng số {{$baitaps->total()}} dòng
                            </div>
                            <div class="modal fade" id="exampleModal-deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xóa bài tập</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">Bạn có chắc muốn xóa bài tập này?</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <a href="#" id="deleteAll" class="btn btn-danger">Xóa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    @endif
                
                        </div>
                    {{-- end --}}
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
        $(function(e){
            $("#select_all").click(function(){
                $('.checkbox-item').prop('checked', $(this).prop('checked'));
            });
        $('#deleteAll').click(function(e){
            e.preventDefault();
            var all_ids =[];
            $('input:checkbox[name=ids]:checked').each(function(){
                all_ids.push($(this).val());
            });

            $.ajax({
                url:'{{ route('baitap.delete.all')}}',
                type:'DELETE',
                data:{
                    ids: all_ids,
                    _token: '{{ csrf_token() }}',
                },
                success:function(response){
                    $.each(all_ids, function(key, val){
                        $('#baitap_ids'+val).remove();
                    })
                    location.reload();
                }
            });
        });
        });
    </script>
@endsection