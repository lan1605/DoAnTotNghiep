<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BaiDang;
use App\Models\BinhLuan;
use App\Models\ThoiGianHoc;
use App\Models\LuuBaiHoc;

class HocVienController extends Controller
{
    public function getDanhsach(Request $req)
    {
        $keysfilter ='';
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
    	$users = User::where('name','like','%'.$keysfilter.'%')->orWhere('email','like','%'.$keysfilter.'%')->orderBy('truy_cap','DESC')->paginate(10);
    	return view('admin.hocvien.list',['users'=>$users, 
            'route'=>'quanly.hocvien', 
            'titlePage'=>'Quản lý học viên', 
            'breadcrumb'=>'Danh sách học viên']);
    }

    public function xoaHocvien($id){
        $user = User::find($id)->delete();
        BaiDang::where('id_hocvien', $id)->delete();
    	if ($user){
            return redirect('/dashboard/hocvien')->with('success','Bạn đã xóa thành công!!');
        }
        else {
            return redirect('/dashboard/hocvien')->with('error','Thất bại, vui lòng thử lại.');
        }
    }
    public function xemchitiet($id){
        $user= User::find($id);
        $baidang = BaiDang::where('id_hocvien', $user->id)->take(10)->orderBy('created_at', 'DESC')->get();

        $baihoc = ThoiGianHoc::where('id_hocvien', $id)->get();
        $daluu = LuuBaiHoc::all();
        $arrId= [];
        foreach ($baihoc as $item) {
            foreach ($daluu as $item_dl){
                if ($item->id_baihoc === $item_dl->id_baihoc){
                    $arrId [] = $item;
                }
            }
        }
        
        // $binhluan = BinhLuan::where('id_baidang', $id_baidang[]);
        return view('admin.hocvien.detail',['user'=> $user,'baidang'=> $baidang, 'baihocdaluu' => $arrId,
        'linkPage'=> '/dashboard/hocvien','titlePage' => 'Học viên', 'breadcrumb'=>'Chi tiết học viên']);
    }
    public function deleteAll(Request $req){
        $id = $req->ids;
        User::whereIn('id', $id)->delete();
        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }
}
