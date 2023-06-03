<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BaiDang;
use App\Models\BinhLuan;
use App\Models\ThoiGianHoc;
use App\Models\LuuBaiHoc;
use App\Models\KetQua;
use Auth;
use Hash;
use Illuminate\Support\Facades\File;

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
        $thongtin = KetQua::where('id_hocvien', $user->id)->orderBy('created_at')->get()->groupBy(function($data) {
            return $data->id_baitap;
        });
        // $binhluan = BinhLuan::where('id_baidang', $id_baidang[]);
        return view('admin.hocvien.detail',['user'=> $user,'baidang'=> $baidang, 'baihocdaluu' => $arrId, 'thongtin'=>$thongtin,
        'linkPage'=> '/dashboard/hocvien','titlePage' => 'Học viên', 'breadcrumb'=>'Chi tiết học viên']);
    }
    public function deleteAll(Request $req){
        $id = $req->ids;
        User::whereIn('id', $id)->delete();
        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }
    public function  viewDetail(){
        $user = User::find(Auth::user()->id);
        return view('pages.thong-tin-ca-nhan.index',['user'=>$user, 'page'=>'Thông tin cá nhân', 'title'=>'Chi tiết thông tin']);
    }
    public function editDetail(Request $req){
        $user = User::find(Auth::user()->id);
        $this->validate($req,
    	[
    		'name'=>'required|min:2',
            'email'=>'required|email',
            'img_hocvien'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    	],
    	[
    		'name.required'=>'bạn chưa nhập tên ',
            'name.min'=>'tên người dùng ít nhất 2 ký tự',
            'email.required'=>'bạn chưa nhập email',
            'email.email'=>'email không đúng định dạng',
            'img_hocvien.required'=>'bạn chưa chọn ảnh',
            'img_hocvien.max'=>'ảnh của bạn tối đa 2048Kb',
            'img_hocvien.mimes'=>'ảnh của bạn không đúng định dạng jpeg,png,jpg,gif,svg',
            'sdt.required'=>'bạn chưa nhập số điện thoại',
            'dia_chi.required'=>'bạn chưa nhập địa chỉ'
    	]);

        if ($req->old_password){
            if (Hash::check($req->old_password, $user->password)){
                return back()->with('error_old', 'Không đúng mật khẩu, vui lòng nhập lại');
            }
            else {
                if ($req->hasFile('img_hocvien')){
                    if (File::exists('hocviens/'.$user->img_hocvien)){
                        File::delete('hocviens/'.$user->img_hocvien);
                    }
                    $fileName = $req->imgName . '.' . $req->file('img_hocvien')->extension();        
                    // $req->file('img_hocvien')->storeAs('profile/admin', $fileName);
                    $req->file('img_hocvien')->move(public_path('hocviens'), $fileName);
                    $user->img_hocvien = $fileName;
                    $user->name = $req->name;
                    $user->email = $req->email;
                    $user->sdt = $req->sdt;
                    $user->gioi_tinh = $req->gioi_tinh;
                    $user->dia_chi = $req->dia_chi;
                    $user->password = Hash::make($req->new_password);
                    $user->save();
                }
                else {
                    $user->name = $req->name;
                    $user->email = $req->email;
                    $user->sdt = $req->sdt;
                    $user->gioi_tinh = $req->gioi_tinh;
                    $user->dia_chi = $req->dia_chi;
                    $user->password = Hash::make($req->new_password);
                    $user->save();
                }
            }
        }
        else {
            if ($req->hasFile('img_hocvien')){
                if (File::exists('hocviens/'.$user->img_hocvien)){
                    File::delete('hocviens/'.$user->img_hocvien);
                }
                $fileName = $req->imgName . '.' . $req->file('img_hocvien')->extension();        
                // $req->file('img_hocvien')->storeAs('profile/admin', $fileName);
                $req->file('img_hocvien')->move(public_path('hocviens'), $fileName);
                $user->img_hocvien = $fileName;
                $user->name = $req->name;
                $user->email = $req->email;
                $user->sdt = $req->sdt;
                $user->gioi_tinh = $req->gioi_tinh;
                $user->dia_chi = $req->dia_chi;
                $user->save();
            }
            else {
                $user->name = $req->name;
                $user->email = $req->email;
                $user->sdt = $req->sdt;
                $user->gioi_tinh = $req->gioi_tinh;
                $user->dia_chi = $req->dia_chi;
                $user->save();
            }
    }
    if ($user){
        return redirect('/thong-tin-ca-nhan')->with('success', 'Thay đổi thành công');
    }
    else {
        return redirect('/thong-tin-ca-nhan')->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }
    }
    public function deleteDetail(){
        $user = User::find(Auth::user()->id);

        $user->delete();

        if ($user){
            return redirect('/dashboard/hocvien')->with('success', 'Bạn đã xóa thành công');
        }
        else {
            return back()->with('error', 'Thất bại, vui lòng thử lại');
        }
    }
    public function deleteBT($id){
        $idBT = request()->ids;

        $thongtin = KetQua::whereIn('id_baitap', $idBT)->where('id_hocvien', $id)->delete();

        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }
    public function deleteBD($id){
        $idBD = request()->ids;

        $thongtin = BaiDang::whereIn('id', $idBD)->where('id_hocvien', $id)->delete();

        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }

}
