<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BinhLuan;
use App\Models\BaiDang;
use Illuminate\Support\Facades\Auth;


class BinhLuanController extends Controller
{
    public function store(Request $request)
    {
        $comment = new BinhLuan;
        $comment->noidung_binhluan = strip_tags($request->noi_dung);
        $comment->id_hocvien = Auth::user()->id;
        $post = BaiDang::where('slug',$request->post_id)->first();
        $comment->id_baidang = $post->id;
        // dd($post);
        $post->binhluan()->save($comment);

        if ($comment){
            return back()->with('success','Bạn đã thêm bình luận');
        }
        else {
            return back()->with('error','Thất bại, vui lòng thử lại');
        }
    }
    public function replyStore(Request $request)
    {
        $reply = new BinhLuan();
        $reply->noidung_binhluan = strip_tags($request->noi_dung);
        $reply->id_hocvien = Auth::user()->id;
        $reply->id_traloi = $request->comment_id;
        $post = BaiDang::where('id',$request->post_id)->first();
        $reply->id_baidang = $post->id;

        $post->binhluan()->save($reply);

        return back();

    }
    public function delete($id){
        $comment = BinhLuan::find($id);
        $commentAll = BinhLuan::all();
        $reply = BinhLuan::where('id_traloi', $id)->get();
        $comment->delete();
        // dd($reply);
        if ($comment){
            // foreach ($reply as $item){
            //     foreach ($commentAll as $all){
            //         if ($item->id==$all->id_traloi){
            //             dd('có');
            //         }
            //         else {
            //             dd('ko');
            //         }
            //         $item->delete();
            //     }
            // }
            return back()->with('success','Xóa bình luận thành công');
        }
        else {
            return back()->with('error','Thất bại, vui lòng thử lại');
        }
    }
    public function edit(Request $req){
        $comment = BinhLuan::find($req->comment_id);

        
        $comment->noidung_binhluan = strip_tags($req->noi_dung);

        $comment->save();

        if ($comment){
            return back()->with('success','Chỉnh sửa bình luận thành công');
        }
        else {
            return back()->with('error','Thất bại, vui lòng thử lại');
        }
    }
    public function deleteAdmin($id)
    {
        $comment = BinhLuan::find($id);
        $commentAll = BinhLuan::all();
        $reply = BinhLuan::where('id_traloi', $id)->get();
        $comment->delete();
        // dd($reply);
        if ($comment){
            // foreach ($reply as $item){
            //     foreach ($commentAll as $all){
            //         if ($item->id==$all->id_traloi){
            //             dd('có');
            //         }
            //         else {
            //             dd('ko');
            //         }
            //         $item->delete();
            //     }
            // }
            return back()->with('success','Xóa bình luận thành công');
        }
        else {
            return back()->with('error','Thất bại, vui lòng thử lại');
        }
    }
}
