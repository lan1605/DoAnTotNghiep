@extends('admin.layout.index')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    @include('layouts.breadcrumb')
    @include('layouts.notificationLogin')
    <!--end breadcrumb-->
    @if (session('success_login'))
            <script>
                Lobibox.notify('success_login', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    icon: 'bx bx-check-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    msg: '{{session('success_login')}}'
                });
            </script>
        @endif
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
                                    <option value="0">Tất cả chủ đề</option>
                                    @if (isset($role))
                                    @foreach ($role as $item)
                                        <option value="<?php echo $item->id_chude?>" {{request()->id_chude==$item->id_chude ? 'selected' : false}}><?php echo $item->ten_chude?></option>
                                    @endforeach
                                        
                                    @endif
                                </select>
                            </div>
                            <div class="mb-2 mb-sm-0 ms-2">
                                <select name="find_lession" id="baihoc" class="form-select">
                                    <option value="0">Tất cả bài học</option>
                                    @if (!isset(request()->find_lession))
                                    <option value="0">Tất cả bài học</option>
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
                                    <option value="0">Tất cả loại câu hỏi</option>
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
                            <a href="#" class="btn btn-success mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-import"><i class="lni lni-exit-down me-2"></i>Import</a>
                            <button class="btn btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-deleteAll" type="button"
                                @php
                                    if (count($cauhois)==0){
                                        echo "disabled";
                                    }
                                    else {
                                        echo "";
                                    }
                                @endphp
                            ><i class="bi-trash-fill me-2"></i>Xóa</button>
                            <a href="/dashboard/cauhoi/them" class="btn btn-primary mb-3 mb-lg-0"><i class="bi bi-plus-square-fill me-2"></i>Thêm mới</a>    
                        </div>
                        <div class="modal fade" id="exampleModal-import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thêm câu hỏi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/dashboard/cauhoi/" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <label class="form-label">Loại câu hỏi<span class="text-danger">*</span></label>
                                            <select name="id_loaicauhoi_excel" id="" class="form-select @error('id_loaicauhoi') is-invalid @enderror">
                                                <?php
                                                    $loaicauhois = App\Models\LoaiCauHoi::all();
                                                ?>
                                                @foreach ($loaicauhois as $item)
                                                    <option value="{{$item->id}}" >{{$item->ten_loaicauhoi}}</option>
                                                @endforeach
                                            </select>
                                            <label class="form-label">Chủ đề<span class="text-danger">*</span></label>
                                            <select name="id_chude_excel" id="chude_excel" class="form-select">
                                                <option value="0">-Chọn chủ đề-</option>
                                                <?php
                                                    $chudes = App\Models\ChuDe::all();
                                                    
                                                ?>
                                                @foreach ($chudes as $item)
                                                    <option value="{{$item->id_chude}}"  >{{$item->ten_chude}}</option>
                                                @endforeach
                                            </select>
                                            <label class="form-label">Bài học<span class="text-danger">*</span></label>
                                            <select name="id_baihoc_excel" id="baihoc_excel" class="form-select">
                                                <option value="0">-Chọn bài học-</option>
                                            </select>
                                            <script>
                                                $(document).ready(function () {
                                                $('#chude_excel').on('change', function () {
                                                    var chudeID = this.value;
                                                    $.ajax({
                                                        url: '{{ route('ajax.cauhoi') }}?id_chude='+chudeID,
                                                        type: 'get',
                                                        success: function (res) {
                                                            $('#baihoc_excel').html('<option value="">-Chọn bài học-</option>');
                                                            $.each(res, function (key, value) {
                                                                $('#baihoc_excel').append('<option value="' + value
                                                                    .id_baihoc + '">' + value.ten_baihoc + '</option>');
                                                            });
                                                        }
                                                        
                                                    });
                                                });
                                            });
                    
                                            </script>
                                            <input type="file" name="file" id="" class="form-control mt-2">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-success">Import</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                        </div>
                      </div>
                </div>
                
        </div>
        <div class="card-body">
            @if (count($cauhois)==0)
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
                            <th>Tên câu hỏi</th>
                            <th>Nội dung</th>
                            <th>Loại câu hỏi</th>
                            <th>Bài học</th>
                            <th>Người tạo</th>
                            <th>Thời gian tạo</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </thead>
                <tbody>
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
                                    {{$cauhoi->created_at->format('d-m-Y H:i:s')}}
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
                location.replace('/dashboard/cauhoi');
            }
        });
    });
    });
  </script>
@endsection
