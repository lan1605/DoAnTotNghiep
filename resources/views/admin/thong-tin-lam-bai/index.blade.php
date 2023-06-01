@extends('admin.layout.index')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    @include('layouts.breadcrumb')
    <!--end breadcrumb-->
    @include('layouts.notificationLogin')
    <div class="card">
        <div class="card-header py-3">
            <div class="card-body">
                <div class="row">
                    @include('layouts.notication')
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
                                    <a href="#" class="btn btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-deleteAll"><i class="bi-trash-fill me-2"></i>Xóa</a>
                                </div>
                            </form>
                            @if (count($thongtin)==0)
                                {{"Không có thông tin hiển thị"}}   
                            @else  
                                {{-- @php
                                    foreach($thongtin as $timezone => $userList) {
                                        echo '<ul>';
                                            echo '<li>' . $timezone . '</li>';

                                            echo '<ul>'; 
                                            foreach($userList as $user) {
                                                echo '<li>User Email: ' . $user->id_baitap . '</li>';
                                            }
                                            echo '</ul>';

                                        echo '</ul>';
                                    }
                                @endphp --}}
                                <div class="table-responsive">
                                    <table class="table align-middle table-striped">
                                    <tbody>
                                        <tr >
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="select_all">
                                                </div>
                                            </th>
                                            <th>STT</th>
                                            <th>Bài tập</th>
                                            <th>Chủ đề</th>
                                            <th>Số lượng học viên đã làm</th>
                                            <th>Tùy chọn</th>
                                        </tr>
                                            @php
                                            $dem = 0;
                                            @endphp
                                            @foreach ($thongtin as $item=>$value)
                                            @php
                                                $dem = $dem +1;
                                            @endphp
                                                <tr id="thongtin_ids{{$item}}">
                                                    <td>
                                                        <div class="form-check">
                                                        <input class="form-check-input checkbox-item" type="checkbox" name="ids" value="{{$item}}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            {{$dem}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            @php
                                                                $baitap = App\Models\BaiTap::find($item);
                                                                // dd($baitap);
                                                            @endphp
                                                            {{$baitap->ten_baitap}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            @php
                                                                $baihoc = App\Models\BaiHoc::find($baitap->id_baihoc);
                                                                $chude = App\Models\ChuDe::find($baihoc->id_chude);
                                                                echo $chude->ten_chude;
                                                            @endphp
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            @php
                                                                $hocvien = App\Models\KetQua::where('id_baitap',$item)->orderBy('created_at')->get()->groupBy(function($data) {
                                                                    return $data->id_hocvien;
                                                                });
                                                
                                                            @endphp
                                                            {{count($hocvien)}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <a href="/dashboard/thongtinlambai/{{$baitap->slug}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-eye-fill"></i></a>
                                                            <i class="bi bi-trash-fill text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$baitap->slug}}" aria-label="Delete"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="exampleModal-{{$baitap->slug}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Xóa thông tin làm bài</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">Bạn có chắc muốn xóa không?</div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                <a href="/dashboard/thongtinlambai/xoa/{{$baitap->slug}}" class="btn btn-danger">Xóa</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                    </tbody>
                                    </table>
                                    {{-- {{ $thongtin->links('pagination.custom') }} --}}
                                    {{-- <div class="float-start mt-2">
                                        Hiển thị {{ $thongtin->firstItem() }} đến {{ $thongtin->lastItem() }} trong tổng số {{$thongtin->total()}} dòng
                                    </div> --}}
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
<div class="modal fade" id="exampleModal-deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa thông tin làm bài</h5>
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
                url:'{{ route('thongtinlambai.delete.all')}}',
                type:'DELETE',
                data:{
                    ids: all_ids,
                    _token: '{{ csrf_token() }}',
                },
                success:function(response){
                    $.each(all_ids, function(key, val){
                        $('#thongtin_ids'+val).remove();
                    })
                    location.reload();
                }
            });
        });
        });
    </script>
@endsection