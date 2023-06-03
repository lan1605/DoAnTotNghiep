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
            <div class="col-12 col-lg-8">
                <h3 class="text-left">Nội dung bài viết</h3>
                <div class="card border shadow-none w-100">
                    
                <div class="card-body">
                
                    <article>
                        {!! $baidang->noidung_baidang !!}
                    </article>
            </div>
                </div>
                <h3 class="text-left">Bình luận bài đăng ({{count($binhluan)}} bình luận)</h3>
                

                        @foreach($binhluan as $comment)
                            <div class="card rounded overflow-hidden shadow-none bg-white border mt-3 mb-3">
                                <div class="card-body">
                                    <div class="d-flex gap-3">
                                        <div class="product-box">
                                            <img src="<?php
                                            $user = App\Models\User::find($comment->id_hocvien);
                                            if ($user->img_admin==NULL){
                                                echo "../../assets/images/icons/user.svg";
                                            }
                                            else {
                                                
                                                echo "../admins/$user->img_admin";
                                            }
                                            ?>" alt="">
                                        </div>
                                        
                                        <div class="d-flex w-100 flex-column">
                                            <h5 class="py-0">{{$user->name}}</h5>
                                            @if ($comment->id_traloi!=null)
                                                <p class="py-0">Trả lời 
                                                    @php
                                                    
                                                        $userID = App\Models\BinhLuan::where('id',$comment->id_traloi)->first();
                                                        $name= App\Models\User::find($userID->id_hocvien);
                                                        // dd($userID);
                                                    @endphp
                                                    <strong>{{$name->name}}</strong>
                                                </p>

                                            @else
                                                {{''}}
                                            @endif
                                            <p class="py-0">{!! $comment->noidung_binhluan !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @endforeach
            </div>
            {{-- <div class="col-12 col-lg-4">
                
                    </div> --}}
            </div>
    </div>
                </div>
            </div>
    
    
                </div>
            </div>
</div>
</div>

</main>
@endsection
{{-- @section('javascript')

<script type="text/javascript">
    $(document).ready(function () {
            $('#chude').on('change', function () {
                var chudeID = this.value;
                $('#baihoc').html('');
                $.ajax({
                    url: '{{ route('ajax.baitap') }}?id_chude='+chudeID,
                    type: 'get',
                    success: function (res) {
                        $('#baihoc').html('<option value="0">Tất cả</option>');
                        $.each(res, function (key, value) {
                            $('#baihoc').append('<option value="' + value
                                .id_baihoc + '">' + value.ten_baihoc + '</option>');
                        });
                    }
                    
                });
            });
        })
  </script>
@endsection --}}