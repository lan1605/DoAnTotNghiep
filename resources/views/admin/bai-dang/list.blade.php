@extends('admin.layout.index')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    @include('layouts.breadcrumb')
    <!--end breadcrumb-->
    @include('layouts.notificationLogin')
    <div class="card">
        <div class="card-header py-3">
            @include('layouts.notication')
            <div class="row align-items-center">
                <div class="d-sm-flex align-items-center">
                    <form action="" method="get" class="d-sm-flex">
                        <div class="mb-2 mb-sm-0 ms-2">
                            <?php
                                $role = App\Models\ChuDe::all();    
                            ?>
                            <select name="find_cate" id="" class="form-select">
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
                                <input class="form-control ps-5" type="text" placeholder="tìm kiếm bài viết..."name="key_find" value="{{Request()->key_find}}">
                            </div>
                        </div>

                        <div class="mb-2 mb-sm-0 ms-2">
                            <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                        </div>
                    </form>
                    <div class="ms-auto">
                        <a href="#" class="btn btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-deleteAll"><i class="bi-trash-fill me-2"></i>Xóa</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (count($baidangs)==0)
                {{"Không có thông tin hiển thị"}}   
            @else  
            <div class="table-responsive">
                <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="select_all">
                            </div>
                        </th>
                        <th>STT</th>
                        <th>Tên bài viết</th>
                        <th>Đường dẫn bài viết</th>
                        <th>Chủ đề</th>
                        <th>Người viết</th>
                        <th>Ngày viết</th>
                        <th>Ngày chỉnh sửa</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    $dem = 0;
                    ?>

                    @foreach ($baidangs as $baidang)
                    <?php $dem = $dem +1;?>
                        <tr id="baidang_ids{{$baidang->id}}">
                            <td>
                                <div class="form-check">
                                <input class="form-check-input checkbox-item" type="checkbox" name="ids" value="{{$baidang->id}}">
                                </div>
                            </td>
                            <td >
                                <span>{{$dem}}</span>
                            </td>
                            <td><span><h6 class="mb-0 product-title">{{$baidang->ten_baidang}}</h6></span></td>
                            <td><span>{{isset($baidang->slug) ? $baidang->slug : '_'}}</span></td>
                            <td><span>
                                <?php
                                    $chude = App\Models\ChuDe::find($baidang->id_chude);
                                    if (isset($chude)){
                                        echo $chude->ten_chude;
                                    }
                                    else {
                                        echo '_';
                                    }
                                ?>    
                            </span></td>
                            <td><span>
                                <?php
                                $hocvien = App\Models\User::find($baidang->id_hocvien);
                                if (isset($hocvien)){
                                    echo $hocvien->name;
                                }
                                else {
                                    echo '_';
                                }
                            ?> 
                                </span></td>
                            
                            <td><span>{{isset($baidang->created_at) ? $baidang->created_at : "_"}}</span></td>
                            <td><span>{{isset($baidang->updated) ? $baidang->updated : "_"}}</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="/dashboard/baiviet/{{$baidang->id}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-eye-fill"></i></a>
                                <i class="bi bi-trash-fill text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$baidang->id}}" aria-label="Xóa"></i>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal-{{$baidang->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa bài viết</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Bạn có chắc muốn xóa bài viết này?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <a href="/dashboard/baiviet/xoa/{{$baidang->id}}" class="btn btn-danger">Xóa bài viết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                </table>
            </div>

            {{ $baidangs->links('pagination.custom') }}
            Hiển thị {{ $baidangs->firstItem() }} đến {{ $baidangs->lastItem() }} trong tổng số {{$baidangs->total()}} dòng
</div>
</div>
            @endif
    

</div>
</div>
<div class="modal fade" id="exampleModal-deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa bài viết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Bạn có chắc muốn xóa bài viết này?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <a href="#" id="deleteAll" class="btn btn-danger">Xóa</a>
            </div>
        </div>
    </div>
</div>
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
            url:'{{ route('baidang.delete.all')}}',
            type:'DELETE',
            data:{
                ids: all_ids,
                _token: '{{ csrf_token() }}',
            },
            success:function(response){
                $.each(all_ids, function(key, val){
                    $('#baidang_ids'+val).remove();
                })
                location.replace('/dashboard/baiviet');
            }
        });
    });
    });
</script>
@endsection
</main>
@endsection