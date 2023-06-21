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
                                    <div class="ms-auto position-relative">
                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                                        <input class="form-control ps-5" type="text" placeholder="tìm kiếm học viên..."name="key_find" value="{{Request()->key_find}}">
                                    </div>
                                </div>
                                <div class="mb-2 mb-sm-0 ms-2">
                                    <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                                </div>
                                <div class="ms-auto">
                                    {{-- <p id="select_all" class="btn btn-success mb-0">Chọn tất cả</p> --}}
                                    
                                    @if (count($thongtin)==0)
                                        <a href="#" class="btn btn-danger mb-3 mb-lg-0" style="opacity: 0.5;"><i class="bi-trash-fill me-2"></i>Xóa</a>
                                    @else 
                                        <a href="#" class="btn btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-deleteAll"><i class="bi-trash-fill me-2"></i>Xóa</a>
                                    @endif
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
                                {{-- {{ dd($thongtin);}} --}}
                                <div class="row row-cols-1 row-cols-lg-2 g-lg-3">
                                        @foreach ($thongtin as $item=>$value)
                                            <div class="col">
                                                {{-- <div id="thongtin_ids{{$item}}">
                                                    <input class="form-check-input checkbox-item" type="checkbox" name="ids" value="{{$item}}">
                                                </div> --}}
                                                <div class="card">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            @php
                                                                $user = App\Models\User::find($item);

                                                            @endphp
                                                            <img src="{{$user->img_hocvien==null ? '../../assets/images/icons/user.svg' : '../../hocviens/'.$user->img_hocvien}}" alt="{{$user->name}}" class="card-img">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{$user->name}}</h5>
                                                                @php
                                                                    $hocvien = App\Models\KetQua::where('id_baitap',$baitap->id_baitap)->where('id_hocvien', $item)->get()->groupBy(function($data) {
                                                                    return $data->id_baitap;
                                                                });
                                                                $arr=[];
                                                                foreach ($hocvien as $key=>$value){
                                                                    $arr = $value;
                                                                }
                                                                // dd($arr);
                                                                @endphp
                                                                
                                                                <p class="card-text"></p>
                                                                <p class="card-text">
                                                                    @php
                                                                        Carbon\Carbon::setLocale('vi');
                                                                    @endphp
                                                                    Hoạt động cách đây {{Carbon\Carbon::parse($user->truy_cap)->diffForHumans()}}
                                                                </p>    
                                                                <div class="table-responsive">
                                                                    <table class="table align-middle table-striped">
                                                                    <tbody>
                                                                        <tr >
                                                                            <th>Lần</th>
                                                                            <th>Điểm</th>
                                                                            <th>Số câu đã làm</th>
                                                                            <th>Số câu đúng</th>
                                                                            {{-- <th>Tùy chọn</th> --}}
                                                                        </tr>
                                                                            @php
                                                                            $dem = 0;
                                                                            @endphp
                                                                            @foreach ($arr as $item)
                                                                            @php
                                                                                $dem = $dem +1;
                                                                            @endphp
                                                                                <tr >
                                                                                    <td>
                                                                                        <span>
                                                                                            {{$dem}} 
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        {{$item->tong_diem}}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{$item->socau_dalam}}
                                                                                    </td>
                                                                                    <td>
                                                                                        <span>
                                                                                        {{$item->soluong_caudung}}
                                                                                        </span>
                                                                                    </td>
                                                                                    
                                                                                </tr>
                                                                                
                                                                            @endforeach
                                                                    </tbody>
                                                                    </table>
                                                                </div>
                                                                <a href="/dashboard/thongtinlambai/{{$baitap->slug}}/{{$user->id}}" class="btn btn-primary">Xem chi tiết</a>
                                                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-delete-{{$user->id}}">Xóa</a>
                                                                <div class="modal fade" id="exampleModal-delete-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Xóa thông tin làm bài của {{$user->name}}</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">Bạn có chắc muốn xóa không?</div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                                <a href="/dashboard/thongtinlambai/{{$baitap->slug}}/{{$user->id}}/xoa" class="btn btn-danger">Xóa</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                    
                                </div><!--end row-->
                                
                                
                            
                            @endif
                
                        </div>
                
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

            // $.ajax({
            //     url:'{{ route('thongtinlambai.delete.all')}}',
            //     type:'DELETE',
            //     data:{
            //         ids: all_ids,
            //         _token: '{{ csrf_token() }}',
            //     },
            //     success:function(response){
            //         $.each(all_ids, function(key, val){
            //             $('#thongtin_ids'+val).remove();
            //         })
            //         location.reload();
            //     }
            // });
        });
        });
    </script>
@endsection