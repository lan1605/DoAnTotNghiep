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
                            <div class="ms-auto position-relative">
                                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                                <input class="form-control ps-5" type="text" placeholder="tìm kiếm..."name="key_find" value="{{Request()->key_find}}">
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
            @if (count($lienhes)==0)
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
                        <th>Người liên hệ</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Nội dung liên hệ</th>
                        <th>Tìm trạng</th>
                        <th>Tùy chọn</th>
                    </tr>
                    <?php $dem = 0?>
                    @foreach ($lienhes as $lienhe)
                    <?php $dem = $dem +1?>
                        <tr id="lienhe_ids{{$lienhe->id}}">
                            <td>
                                <div class="form-check">
                                <input class="form-check-input checkbox-item" type="checkbox" name="ids" value="{{$lienhe->id}}">
                                </div>
                            </td>
                            <td class="productlist">
                                {{$dem}}
                            </td>
                            <td><span><h6 class="mb-0 product-title">{{$lienhe->ten}}</h6></span></td>
                            <td><span>{{$lienhe->email}}</span></td>
                            <td><span>@if (isset($lienhe->sdt))
                                {{$lienhe->sdt}}
                            @else
                                {{"_"}}
                            @endif</span></td>
                            <td><span>{{$lienhe->noidung_lienhe}}</span></td>
                            <td><span>@if (isset($lienhe->noidung_phanhoi))
                                <span class="badge rounded-pill bg-success">Đã phản hồi</span>
                            @else
                            <span class="badge rounded-pill bg-danger">Chưa phản hồi</span>
                            @endif</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="/dashboard/lienhe/{{$lienhe->id}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" ><i class="bx bx-mail-send"></i></a>
                                <i class="bi bi-trash-fill text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$lienhe->id}}" ></i>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal-{{$lienhe->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa liên hệ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Bạn có chắc muốn xóa không?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <a href="/dashboard/lienhe/xoa/{{$lienhe->id}}" class="btn btn-danger">Xóa</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                </table>
                {{ $lienhes->links('pagination.custom') }}
                <div class="float-start mt-2">
                    Hiển thị {{ $lienhes->firstItem() }} đến {{ $lienhes->lastItem() }} trong tổng số {{$lienhes->total()}} dòng
                </div>
            </div>

</div>
</div>

<div class="modal fade" id="exampleModal-deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa liên hệ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Bạn có chắc muốn xóa hay không?</div>
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
                url:'{{ route('lienhe.delete.all')}}',
                type:'DELETE',
                data:{
                    ids: all_ids,
                    _token: '{{ csrf_token() }}',
                },
                success:function(response){
                    $.each(all_ids, function(key, val){
                        $('#lienhe_ids'+val).remove();
                    })
                    location.reload();
                }
            });
        });
        });
    </script>
@endsection
</main>
@endsection