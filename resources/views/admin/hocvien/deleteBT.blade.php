<div class="modal fade" id="exampleModal-deleteAllBT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa thông tin làm bài của {{$user->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Bạn có chắc muốn xóa không?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <a href="#" class="btn btn-danger" id="deleteAllBT">Xóa</a>
            </div>
        </div>
    </div>
</div>
@section('javascript')
    <script>
        $(function(e){
            $("#select_all_bt").click(function(){
                $('.checkbox_BT').prop('checked', $(this).prop('checked'));
            });
        $('#deleteAllBT').click(function(e){
            e.preventDefault();
            var all_ids =[];
            $('input:checkbox[name=ids_BT]:checked').each(function(){
                all_ids.push($(this).val());
            });

            $.ajax({
                url:'{{ route('hocvienBT.delete.all', $user->id)}}',
                type:'DELETE',
                data:{
                    ids: all_ids,
                    _token: '{{ csrf_token() }}',
                },
                success:function(response){
                    $.each(all_ids, function(key, val){
                        $('#bt_ids'+val).remove();
                    })
                    location.replace('/dashboard/hocvien/{{$user->id}}');
                }
            });
        });
        });
    </script>