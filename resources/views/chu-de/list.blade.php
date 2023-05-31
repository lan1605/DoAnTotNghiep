@extends('admin.layout.index')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    @include('layouts.breadcrumb')
    <!--end breadcrumb-->
    @include('layouts.notificationLogin')
    <div class="card">
        <div class="card-header py-3">
        <h6 class="mb-0">{{$titlePage}}</h6>
        </div>
        <div class="card-body">
        <div class="row">
            @include('layouts.notication')
            <div class="col-12 col-lg-4 ">
                <div class="card border shadow-none w-100">
                    <div class="card-body">
                        @if ($route)
                        <form class="row g-3" method="post" action="/dashboard/chude/">
                            @csrf
                            <div class="col-12">
                            <label class="form-label">Tên chủ đề</label>
                            <input type="text" class="form-control @error('ten_chude') is-invalid  @enderror " placeholder="Tên chủ đề..." name="ten_chude" value="{{ old('ten_chude')}}">
                            @error('ten_chude')
                                <span class="invalid-feedback" role="alert" >
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="col-12">
                            <label class="form-label">Mô tả </label>
                            <textarea  id="editorChude" name="mo_ta" id="" cols="30" rows="10" placeholder="Mô tả chủ đề..." class="form-control @error('mo_ta') is-invalid  @enderror">{{old('mo_ta')}}</textarea>
                            @error('mo_ta')
                                <span class="invalid-feedback" role="alert" >
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-primary">Thêm chủ đề</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                    </div>
            </div>
            <div class="col-12 col-lg-8 ">
            <div class="card border shadow-none w-100">
                <div class="card-body">
                    <form action="" method="get" class="d-sm-flex mb-3">
                        <div class="mb-2 mb-sm-0 ms-2">
                            <div class="ms-auto position-relative">
                                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                                <input class="form-control ps-5" type="text" placeholder="tìm kiếm chủ đề..."name="key_find" value="{{Request()->key_find}}">
                            </div>
                        </div>
                        <div class="mb-2 mb-sm-0 ms-2">
                            <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="btn btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal-deleteAll"><i class="bi-trash-fill me-2"></i>Xóa</a>
                        </div>
                    </form>
                @if (count($chudes)==0)
                    {{'Không có thông tin hiển thị'}}
                @else
                <div class="table-responsive">
                    <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                        <th><input class="form-check-input" type="checkbox" id="select_all"></th>
                        <th>Mã chủ đề</th>
                        <th>Tên chủ đề</th>
                        <th>Đường dẫn tĩnh</th>
                        <th>Thời gian tạo</th>
                        <th>Tùy chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chudes as $chude)
                        <tr id="chude_ids{{$chude->id_chude}}">
                            <td>
                                <input class="form-check-input checkbox-item " type="checkbox" name="ids" value="{{$chude->id_chude}}">
                            </td>
                            <td>
                                {{$chude->id_chude}}
                            </td>
                            <td>
                                {{$chude->ten_chude}}
                            </td>
                            <td>
                                {{$chude->slug}}
                            </td>
                            <td>{{$chude->created_at}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <i class="bi bi-pencil-fill text-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-edit{{$chude->id_chude}}" aria-label="Chỉnh sửa"></i>
                                    <i class="bi bi-trash-fill text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$chude->id_chude}}" aria-label="Xóa"></i>
                                    </div>
                            </td>
                        </tr>
                        {{-- xóa chủ đề --}}
                        <div class="modal fade" id="exampleModal-{{$chude->id_chude}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa chủ đề </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Bạn có chắc muốn xóa chủ đề "{{$chude->ten_chude}}"?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <a href="/dashboard/chude/xoa/{{$chude->id_chude}}" class="btn btn-danger">Xóa chủ đề</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- thay đổi thông tin chủ đề --}}
                        <div class="modal fade" id="exampleModal-edit{{$chude->id_chude}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thay đổi chủ đề</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" method="get" action="/dashboard/chude/{{$chude->id_chude}}">
                                            {{csrf_field()}}
                                            <div class="col-12 mt-2">
                                            <label class="form-label">Tên chủ đề</label>
                                            <input type="text" class="form-control @error('ten_chudeEdit') is-invalid  @enderror" placeholder="Tên chủ đề..." name="ten_chudeEdit" value="{{$chude->ten_chude}}">
                                            @error('ten_chudeEdit')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <br>
                                            <div class="col-12">
                                                <label class="form-label">Mô tả </label>
                                                <textarea name="mo_ta" id="editorChude{{$chude->id_chude}}" cols="20" rows="10" placeholder="Mô tả chủ đề..." class="form-control @error('mo_ta') is-invalid  @enderror">{!! $chude->mo_ta !!}</textarea>
                                                @error('mo_ta')
                                                <span class="invalid-feedback" role="alert" >
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                <button class="btn btn-primary">Thay đổi chủ đề</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            //ckeditor 2
                            
        ClassicEditor.create( document.querySelector( '#editorChude{{ $chude->id_chude }}' ), {
                ckfinder:{
                    uploadUrl: '{{ route('images.upload').'?_token='.csrf_token() }}',
                },
                // More configuration options.
                // ...
            } )
            .then( editor => {
        // console.log( error );
        // editor.ui.view.editable.element.style.height = '100px';
    } )
            .catch( error => {
                console.log( error );
            });
        </script>
                        @endforeach
                        
                    </tbody>
                    </table>
                </div>
                {{ $chudes->links('pagination.custom') }}
                Hiển thị {{ $chudes->firstItem() }} đến {{ $chudes->lastItem() }} trong tổng số {{$chudes->total()}} dòng
                </div>
                <div class="modal fade" id="exampleModal-deleteAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xóa chủ đề</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">Bạn có chắc muốn chủ đề này?</div>
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
        //ckeditor 1
        ClassicEditor
            .create( document.querySelector( '#editorChude' ), {
                ckfinder:{
                    uploadUrl: '{{ route('images.upload').'?_token='.csrf_token() }}',
                },
                // More configuration options.
                // ...editor.ui.view.editable.element.style.height = '500px';
                
            } )
            .then( editor => {
        // console.log( error );
        editor.ui.view.editable.element.style.height = '100px';
    } )
            .catch( error => {
                console.log( error );
            } );
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
                url:'{{ route('chude.delete.all')}}',
                type:'DELETE',
                data:{
                    ids: all_ids,
                    _token: '{{ csrf_token() }}',
                },
                success:function(response){
                    $.each(all_ids, function(key, val){
                        $('#chude_ids'+val).remove();
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