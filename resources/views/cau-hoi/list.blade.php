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
                                <select name="id_chude" id="chude" class="form-select">
                                    <option value="0">Tất cả</option>
                                    @if (isset($role))
                                    @foreach ($role as $item)
                                        <option value="<?php echo $item->id_chude?>" {{request()->id_chude==$item->id_chude ? 'selected' : false}}><?php echo $item->ten_chude?></option>
                                    @endforeach
                                        
                                    @endif
                                </select>
                            </div>
                            <div class="mb-2 mb-sm-0 ms-2">
                                <select name="find_lession" id="baihoc" class="form-select">
                                    <option value="0">Tất cả</option>
                                    @if (!isset(request()->find_lession))
                                    <option value="0">Tất cả</option>
                                @else
                                    <?php
                                        $baihoc = App\Models\BaiHoc::where('id_chude', request()->id_chude)->get();
                                    ?>
                                    @foreach ($baihoc as $item)
                                    <option value="<?php echo $item->id_baihoc?>" {{request()->find_lession==$item->id_baihoc ? 'selected' : false}}><?php echo $item->ten_baihoc?></option>
                                    @endforeach
                                @endif
                                </select>
                                
                            </div>
                            <div class="mb-2 mb-sm-0 ms-2">
                                <?php
                                    $loaicauhoi = App\Models\LoaiCauHoi::all();    
                                ?>
                                <select name="find_cate" id="chude" class="form-select">
                                    <option value="0">Tất cả</option>
                                    @if (isset($loaicauhoi))
                                    @foreach ($loaicauhoi as $item)
                                        <option value="<?php echo $item->id?>" {{request()->find_cate==$item->id ? 'selected' : false}}><?php echo $item->ten_loaicauhoi?></option>
                                    @endforeach
                                        
                                    @endif
                                </select>
                            </div>
                            
                            <div class="mb-2 mb-sm-0 ms-2">
                                <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    $('#chude').on('change', function () {
                                        var chudeID = this.value;
                                        $.ajax({
                                            url: '{{ route('ajax.cauhoi') }}?id_chude='+chudeID,
                                            type: 'get',
                                            success: function (res) {
                                                $('#baihoc').html('<option value="0">Tất cả</option>');
                                                $.each(res, function (key, value) {
                                                    $('#baihoc').append('<option value="' + value
                                                        .id_baihoc + '"{{request()->find_lession=='+value.id_baihoc+' ? "selected" : false}}>' + value.ten_baihoc + '</option>');
                                                });
                                            }
                                            
                                        });
                                    });
                                });
                            </script>
                        </form>
                        <div class="ms-auto">
                            <a href="#" class="btn btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-deleteAll"><i class="bi-trash-fill me-2"></i>Xóa</a>
                            <a href="/dashboard/cauhoi/them" class="btn btn-primary mb-3 mb-lg-0"><i class="bi bi-plus-square-fill me-2"></i>Thêm mới</a>    
                        </div>
                      </div>
                </div>
                
        </div>
        <div class="card-body">
            @if (count($cauhois)==0)
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
                        <th>STT</th>
                        <th>Tên câu hỏi</th>
                        <th>Nội dung</th>
                        <th>Loại câu hỏi</th>
                        <th>Bài học</th>
                        <th>Người tạo</th>
                        <th>Thời gian tạo</th>
                        <th>Tùy chọn</th>
                    </tr>
                    <?php $stt = 0?>
                    @foreach ($cauhois as $cauhoi)
                    <?php
                        $stt = $stt +1;
                    ?>
                        <tr id="cauhoi_ids{{$cauhoi->id}}">
                            <td>
                                <div class="form-check">
                                <input class="form-check-input checkbox-item" type="checkbox" name="ids" value="{{$cauhoi->id}}">
                                </div>
                            </td>
                            <td><span><h6 class="mb-0 product-title">{{$stt}}</h6></span></td>
                            <td><span>{{$cauhoi->ten_cauhoi}}</span></td>
                            <td><span>{!! $cauhoi->noi_dung !!}</span></td>
                            <td><span>
                                <?php
                                    if (isset($cauhoi->id_loaicauhoi)){
                                    $id = $cauhoi->id_loaicauhoi;
                                    $loaicauhoi = App\Models\LoaiCauHoi::find($id);
                                    echo $loaicauhoi->ten_loaicauhoi;
                                }
                                else {
                                    echo '_';
                                }   
                                ?>
                            </span></td>
                            <td><span>
                                <?php
                                    if (isset($cauhoi->id_baihoc)){
                                    $id = $cauhoi->id_baihoc;
                                    $baihoc = App\Models\BaiHoc::find($id);
                                    echo $baihoc->ten_baihoc;
                                }
                                else {
                                    echo '_';
                                }   
                                ?>
                            </span></td>
                            <td><span>
                                <?php
                                    if (isset($cauhoi->id_admin)){
                                    $id = $cauhoi->id_admin;
                                    $admin = App\Models\Admin::find($id);
                                    echo $admin->name;
                                }
                                else {
                                    echo '_';
                                }   
                                ?>
                            </span></td>
                            <td>
                               <span>
                                @if (isset($cauhoi->created_at))
                                    {{$cauhoi->created_at}}
                                @else
                                    {{'_'}}
                                @endif
                               </span>
                            </td>
                    
                            
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="/dashboard/cauhoi/{{$cauhoi->id}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-pencil-fill"></i></a>
                                <i class="bi bi-trash-fill text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$cauhoi->id}}" aria-label="Delete" style="cursor: pointer"></i>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal-{{$cauhoi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa câu hỏi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Bạn có chắc muốn xóa "{{$cauhoi->ten_cauhoi}}"?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <a href="/dashboard/cauhoi/xoa/{{$cauhoi->id}}" class="btn btn-danger">Xóa câu hỏi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                </table>
            </div>
            {{ $cauhois->links('pagination.custom') }}
            Hiển thị {{ $cauhois->firstItem() }} đến {{ $cauhois->lastItem() }} trong tổng số {{$cauhois->total()}} dòng
            <div class="modal fade" id="exampleModal-deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xóa câu hỏi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Bạn có chắc muốn xóa các câu hỏi này?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <a href="#" id="deleteAll" class="btn btn-danger">Xóa</a>
                        </div>
                    </div>
                </div>
            </div>
                    @endif
                    

</div>
</div>
    
    
</div>
</div>

</main>
@endsection
@section('javascript')

<script type="text/javascript">
    
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
            url:'{{ route('cauhoi.delete.all')}}',
            type:'DELETE',
            data:{
                ids: all_ids,
                _token: '{{ csrf_token() }}',
            },
            success:function(response){
                $.each(all_ids, function(key, val){
                    $('#cauhoi_ids'+val).remove();
                });
                location.reload();
            }
        });
    });
    });
  </script>
@endsection
