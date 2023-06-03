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
                                <input class="form-control ps-5" type="text" placeholder="tìm kiếm học viên..."name="key_find" value="{{Request()->key_find}}">
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
            @if (count($users)==0)
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
                            <th>Ảnh</th>
                            <th>Tên học viên</th>
                            <th>Email</th>
                            <th>Giới tính</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Trạng thái</th>
                            <th>Kích hoạt Email</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </thead>
                <tbody>
                    
    
                    @foreach ($users as $user)
                        <tr id="hocvien_ids{{$user->id}}">
                            <td>
                                <div class="form-check">
                                <input class="form-check-input checkbox-item" type="checkbox" name="ids" value="{{$user->id}}">
                                </div>
                            </td>
                            <td class="productlist">
                                <a class="d-flex align-items-center gap-2" href="#">
                                <div class="product-box">
                                    <img src="assets/images/products/01.png" alt="">
                                </div>
                                </a>
                            </td>
                            <td><span><h6 class="mb-0 product-title">{{$user->name}}</h6></span></td>
                            <td><span>{{$user->email}}</span></td>
                            <td><span>
                                <?php
                                    if ($user->gioi_tinh==0){
                                        echo "Nam";
                                    }
                                    else{
                                        echo "Nữ";
                                    }
                                ?>    
                            </span></td>
                            <td><span>@if (isset($user->dia_chi))
                                {{$user->dia_chi}}
                            @else
                                {{"_"}}
                            @endif</span></td>
                            <td><span>@if (isset($user->sdt))
                                {{$user->sdt}}
                            @else
                                {{"_"}}
                            @endif</span></td>
                            <td>@if ($user->truy_cap >= now()->subMinutes(5))
                                <span class="badge rounded-pill bg-success">Đang hoạt động</span>
                            @else
                            <span class="badge rounded-pill bg-danger">Không hoạt động</span>
                            @endif</td>
                            <td><span class="badge rounded-pill bg-danger"><?php
                                $check=$user->email_verified_at;
                                if ($check==NULL){
                                    echo "Chưa kích hoạt";
                                }
                                else {
                                    echo "Đã kích hoạt";
                                }
                            ?></span></td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="/dashboard/hocvien/{{$user->id}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-eye-fill"></i></a>
                                <i class="bi bi-trash-fill text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$user->id}}" aria-label="Delete"></i>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa tài khoản của học viên</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Bạn có chắc muốn xóa tài khoản này?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <a href="/dashboard/hocvien/xoa/{{$user->id}}" class="btn btn-danger">Xóa tài khoản</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                </table>
                {{ $users->links('pagination.custom') }}
                <div class="float-start mt-2">
                    Hiển thị {{ $users->firstItem() }} đến {{ $users->lastItem() }} trong tổng số {{$users->total()}} dòng
                </div>
            </div>

</div>
</div>

<div class="modal fade" id="exampleModal-deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa tài khoản của học viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Bạn có chắc muốn xóa tài khoản?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <a href="#" id="deleteAll" class="btn btn-danger">Xóa tài khoản</a>
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
                url:'{{ route('hocvien.delete.all')}}',
                type:'DELETE',
                data:{
                    ids: all_ids,
                    _token: '{{ csrf_token() }}',
                },
                success:function(response){
                    $.each(all_ids, function(key, val){
                        $('#hocvien_ids'+val).remove();
                    })
                    location.reload('/dashboard/hocvien');
                }
            });
        });
        });
    </script>
@endsection
</main>
@endsection