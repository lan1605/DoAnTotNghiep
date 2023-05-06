<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiDang;
use App\Models\BinhLuan;

class BaiDangController extends Controller
{
    public function index(){
        $baidangs = BaiDang::paginate(10);
        return view('admin.bai-dang.list', ['route'=>route('quanly.baidang'), 'baidangs'=>$baidangs,'titlePage'=>'Quản lý bài đăng', 'breadcrumb'=> 'Danh sách bài đăng']);
    }
    public function delete($id){
        $baidang = BaiDang::find($id)->delete();

        if ($baidang){
            return redirect('dashboard/baidang')->with('success','Bạn đã xóa thành công!');
        }
        else {
            return redirect('dashboard/baidang')->with('errors', 'Thất bại, vui lòng thử lại!!');
        }
    }
    public function detailGet($id){
        $baidang = BaiDang::find($id);
        $binhluan = BinhLuan::where('id_baidang', $id)->get();

        return view('admin.bai-dang.detail', ['baidang'=>$baidang, 'binhluan'=>$binhluan, 
        'titlePage'=>'Quản lý bài đăng', 'breadcrumb'=> 'Chi tiết bài đăng','linkPage'=>'dashboard/baidang']);
    }
}
