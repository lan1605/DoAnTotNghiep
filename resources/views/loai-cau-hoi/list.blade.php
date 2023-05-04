@extends('admin.layout.index')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    @include('layouts.breadcrumb')
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-header py-3">
        <h6 class="mb-0">{{$titlePage}}</h6>
        </div>
        <div class="card-body">
        <div class="row">
            @include('layouts.notication')
            <div class="col-12 col-lg-4 d-flex">
                <div class="card border shadow-none w-100">
                    <div class="card-body">
                        @if ($route)
                        <form class="row g-3" method="post" action="/dashboard/loaicauhoi/">
                            @csrf
                            <div class="col-12">
                            <label class="form-label">Tên loại câu hỏi</label>
                            <input type="text" class="form-control @error('ten_loaicauhoi') is-invalid  @enderror " placeholder="Tên loại câu hỏi..." name="ten_loaicauhoi" value="{{ old('ten_loaicauhoi')}}">
                            @error('ten_loaicauhoi')
                                <span class="invalid-feedback" role="alert" >
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            {{-- <div class="col-12">
                            <label class="form-label">Mô tả </label>
                            <textarea name="mo_ta" id="" cols="30" rows="10" placeholder="Mô tả chủ đề..." class="form-control @error('mo_ta') is-invalid  @enderror">{{old('mo_ta')}}</textarea>
                            @error('mo_ta')
                                <span class="invalid-feedback" role="alert" >
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div> --}}
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-primary">Thêm loại câu hỏi</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                    </div>
            </div>
            <div class="col-12 col-lg-8 d-flex">
            <div class="card border shadow-none w-100">
                <div class="card-body">
                    <form action="" method="get" class="d-sm-flex mb-3">
                        <div class="mb-2 mb-sm-0 ms-2">
                            <div class="ms-auto position-relative">
                                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                                <input class="form-control ps-5" type="text" placeholder="tìm kiếm loại câu hỏi..."name="key_find" value="{{Request()->key_find}}">
                            </div>
                        </div>
                        <div class="mb-2 mb-sm-0 ms-2">
                            <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="btn btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-deleteAll"><i class="bi-trash-fill me-2"></i>Xóa</a>
                        </div>
                    </form>
                @if (count($loaicauhois)==0)
                    {{'Không có thông tin hiển thị'}}
                @else
                <div class="table-responsive">
                    <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                        <th><input class="form-check-input" type="checkbox" id="select_all"></th>
                        <th>Tên loại câu hỏi</th>
                        <th>Thời gian tạo</th>
                        <th>Tùy chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loaicauhois as $loaicauhoi)
                        <tr id="loaicauhoi_ids{{$loaicauhoi->id}}">
                            <td>
                                <input class="form-check-input checkbox-item" type="checkbox" name="ids" value="{{$loaicauhoi->id}}">
                            </td>
                            <td>
                                {{$loaicauhoi->ten_loaicauhoi}}
                            </td>
                            <td>{{$loaicauhoi->created_at}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <i class="bi bi-pencil-fill text-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-edit{{$loaicauhoi->id}}" aria-label="View"></i>
                                    <i class="bi bi-trash-fill text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$loaicauhoi->id}}" aria-label="Delete"></i>
                                    </div>
                            </td>
                        </tr>
                        {{-- xóa chủ đề --}}
                        <div class="modal fade" id="exampleModal-{{$loaicauhoi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa loại câu hỏi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Bạn có chắc muốn xóa loại "{{$loaicauhoi->ten_loaicauhoi}}"?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <a href="/dashboard/loaicauhoi/xoa/{{$loaicauhoi->id}}" class="btn btn-danger">Xóa loại câu hỏi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- thay đổi thông tin chủ đề --}}
                        <div class="modal fade" id="exampleModal-edit{{$loaicauhoi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thay đổi loại câu hỏi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" method="get" action="/dashboard/loaicauhoi/{{$loaicauhoi->id}}">
                                            {{csrf_field()}}
                                            <div class="col-12 mt-2">
                                            <label class="form-label">Tên loại câu hỏi</label>
                                            <input type="text" class="form-control @error('ten_loaicauhoiEdit') is-invalid  @enderror" placeholder="Tên loại câu hỏi..." name="ten_loaicauhoiEdit" value="{{$loaicauhoi->ten_loaicauhoi}}">
                                            @error('ten_loaicauhoiEdit')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <br>
                                            {{-- <div class="col-12">
                                                <label class="form-label">Mô tả </label>
                                                <textarea name="mo_ta" id="" cols="30" rows="10" placeholder="Mô tả chủ đề..." class="form-control @error('mo_ta') is-invalid  @enderror">{{$loaicauhoi->mo_ta}}</textarea>
                                                @error('mo_ta')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <br> --}}
                                            <div class="col-12">
                                                <div class="d-grid">
                                                <button class="btn btn-primary">Thay đổi loại câu hỏi</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
                {{ $loaicauhois->links('pagination.custom') }}
                Hiển thị {{ $loaicauhois->firstItem() }} đến {{ $loaicauhois->lastItem() }} trong tổng số {{$loaicauhois->total()}} dòng
                </div>
                <div class="modal fade" id="exampleModal-deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xóa loại câu hỏi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">Bạn có chắc muốn xóa các loại câu hỏi này?</div>
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
        </div><!--end row-->
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
                url:'{{ route('loaicauhoi.delete.all')}}',
                type:'DELETE',
                data:{
                    ids: all_ids,
                    _token: '{{ csrf_token() }}',
                },
                success:function(response){
                    $.each(all_ids, function(key, val){
                        $('#loaicauhoi_ids'+val).remove();
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