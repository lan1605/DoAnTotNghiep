@extends('admin.layout.index')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    @include('layouts.breadcrumb')
    <!--end breadcrumb-->

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
                                    <input class="form-control ps-5" type="text" placeholder="tìm kiếm bài học..."name="key_find" value="{{Request()->key_find}}">
                                </div>
                            </div>
                            <div class="mb-2 mb-sm-0 ms-2">
                                <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                            </div>
                        </form>
                        <div class="ms-auto">
                            <a href="#" class="btn btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-deleteAll"><i class="bi-trash-fill me-2"></i>Xóa</a>
                            <a href="/dashboard/baihoc/them" class="btn btn-primary mb-3 mb-lg-0"><i class="bi bi-plus-square-fill me-2"></i>Thêm mới</a>    
                        </div>
                      </div>
                </div>
                
        </div>
        <div class="card-body">
            @if (count($baihocs)==0)
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
                        <th>Mã bài học</th>
                        <th>Tên bài học</th>
                        <th>Đường dẫn tĩnh</th>
                        <th>Chủ đề</th>
                        <th>Trạng thái</th>
                        <th>Người đăng</th>
                        <th>Tùy chọn</th>
                    </tr>
    
                    @foreach ($baihocs as $baihoc)
                        <tr id="baihoc_ids{{$baihoc->id_baihoc}}">
                            <td>
                                <div class="form-check">
                                <input class="form-check-input checkbox-item" type="checkbox" name="ids" value="{{$baihoc->id_baihoc}}">
                                </div>
                            </td>
                            <td><span><h6 class="mb-0 product-title">{{$baihoc->id_baihoc}}</h6></span></td>
                            <td><span>{{$baihoc->ten_baihoc}}</span></td>
                            <td><span class="white-space--text">{{$baihoc->slug}}</span></td>
                            <td><span>
                                <?php
                                if (isset($baihoc->id_chude)){
                                    $idCD = $baihoc->id_chude;
                                    $chude = App\Models\ChuDe::find($idCD);
                                    echo $chude->ten_chude;
                                }
                                else {
                                    echo '_';
                                }   
                                ?>
                            </span></td>
                            <td>
                                @if ($baihoc->tinh_trang==0)
                                    <span class="badge rounded-pill bg-warning">Chưa hiển thị</span>
                                @else
                                <span class="badge rounded-pill bg-success">Đã hiển thị</span>
                                @endif
                            </td>
                            <td>
                                <span>
                                    <?php
                                        $idAdmin = $baihoc->id_admin;
                                        if ($idAdmin==null){
                                            echo '_';
                                        }
                                        else {
                                            echo App\Models\Admin::find($idAdmin)->name; 
                                        }
                                           
                                    ?>
                                </span>
                            </td>
                            
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="/dashboard/baihoc/{{$baihoc->id_baihoc}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-pencil-fill"></i></a>
                                <i class="bi bi-trash-fill text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$baihoc->id_baihoc}}" aria-label="Delete" style="cursor: pointer"></i>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal-{{$baihoc->id_baihoc}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa bài học</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Bạn có chắc muốn xóa bài học "{{$baihoc->ten_baihoc}}"?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <a href="/dashboard/baihoc/xoa/{{$baihoc->id_baihoc}}" class="btn btn-danger">Xóa bài học</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                </table>
                {{ $baihocs->links('pagination.custom') }}
                <div class="float-start mt-2">
                    Hiển thị {{ $baihocs->firstItem() }} đến {{ $baihocs->lastItem() }} trong tổng số {{$baihocs->total()}} dòng
                </div>
            </div>
            
            {{-- Hiển thị {{ $baihocs->firstItem() }} đến {{ $baihocs->lastItem() }} trong tổng số {{$baihocs->total()}} dòng --}}
            <div class="modal fade" id="exampleModal-deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xóa bài học</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Bạn có chắc muốn xóa bài học này?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <a href="#" id="deleteAll" class="btn btn-danger">Xóa</a>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Hiển thị {{ $baihocs->firstItem() }} đến {{ $baihocs->lastItem() }} trong tổng số {{$baihocs->total()}} dòng --}}
                    @endif
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
            url:'{{ route('baihoc.delete.all')}}',
            type:'DELETE',
            data:{
                ids: all_ids,
                _token: '{{ csrf_token() }}',
            },
            success:function(response){
                $.each(all_ids, function(key, val){
                    $('#baihoc_ids'+val).remove();
                });
                location.reload();
            }
        });
    });
    });
</script>
@endsection