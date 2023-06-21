<style>
    pre{
        background: hsla(0,0%,78%,.3);
    border: 1px solid #c4c4c4;
    border-radius: 2px;
    color: #353535;
    direction: ltr;
    font-style: normal;
    min-width: 200px;
    padding: 1em;
    tab-size: 4;
    text-align: left;
    white-space: pre-wrap;
    }
</style>
@guest
@foreach($comments as $comment)
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
                {!! $comment->noidung_binhluan !!}
            </div>
        </div>
    </div>
</div>
@if ($comment->replies->isNotEmpty())
    @include('pages.binhluan.display', ['comments' => $comment->replies])
@endif
@endforeach
@else
@foreach($comments as $comment)
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
                    {!! $comment->noidung_binhluan !!}
                    <a href=""  data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal-reply{{$comment->id}}">Trả lời bình luận</a>
                    
                
                    @if (Auth::user()->id===$comment->id_hocvien)
                    <div class="d-flex justify-content-end" >
                        <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ...
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/comment/{{$comment->id}}/xoa" >Xóa</a>
                            </li>
                            <li><a  class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal-{{$comment->id}}">Chỉnh sửa</a>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            
            
        </div>
    </div>
    @if ($comment->replies->isNotEmpty())
    @include('pages.binhluan.display', ['comments' => $comment->replies])
@endif
    <div class="modal fade" id="exampleExtraLargeModal-{{$comment->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa bình luận</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('comment.edit') }}">
                        @csrf
                            <textarea class="form-control rounded-0 border-0" name="noi_dung" id='ckeditor{{$comment->id}}'>{!! $comment->noidung_binhluan !!}</textarea>
                            {{-- <input type="hidden" name="post_id" value="{{ $baidang->slug }}" /> --}}
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary float-end"> Thay đổi </button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleExtraLargeModal-reply{{$comment->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Trả lời bình luận</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('reply.add') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control rounded-0 border-0" name="noi_dung" id='ckeditorReply{{$comment->id}}'></textarea>
                            <input type="hidden" name="post_id" value="{{ $post_id }}" />
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary float-end"> Trả lời </button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script>
           var myEditor;
        ClassicEditor
            .create( document.querySelector( '#ckeditor{{$comment->id}}' ), {
                ckfinder:{
                    uploadUrl: '{{ route('images.upload').'?_token='.csrf_token() }}',
                },

                // More configuration options.
                // ...
                
            } )
            .then( editor => {
                // console.log( error );
                editor.ui.view.editable.element.style.height = '100px';
                
                
            } )
            .catch( error => {
                console.log( error );
            } );

        ClassicEditor
            .create( document.querySelector( '#ckeditorReply{{$comment->id}}' ), {
                ckfinder:{
                    uploadUrl: '{{ route('images.upload').'?_token='.csrf_token() }}',
                },
                
                // More configuration options.
                // ...
                
            } )
            .then( editor => {
                // console.log( error );
                editor.ui.view.editable.element.style.height = '100px';
                
            } )
            .catch( error => {
                console.log( error );
            } );
            
            
        </script>
@endforeach
@endguest