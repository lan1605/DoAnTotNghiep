<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiDang;
use App\Models\BinhLuan;
use Auth;

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
    public function indexPage(Request $req){
        $filter =[];
        $keysfilter ='';
        if (!empty($req->find_cate)){
            if ($req->find_cate==0){
                $filter[]=[];
            }
            else {
                $find_cate = $req->find_cate;
                $filter[] = ['bai_dangs.id_chude', '=', $find_cate];
            }
        }
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
        $baidangs = BaiDang::where($filter)->where(function ($query) use ($keysfilter){
            $query->where('ten_baidang','like','%'.$keysfilter.'%')->orWhere('slug','like','%'.$keysfilter.'%');
        })->orderBy('id_chude', 'ASC')->paginate(20);
        
        return view('pages.baidang.index',['route'=>route('baidang.index'), 'baidangs'=>$baidangs]);  
    }
    public function viewDetail($slug){
        $baidang = BaiDang::where('slug', $slug)->where('id_hocvien',Auth::user()->id)->first();

        return view('pages.baidang.detail',['baidang'=>$baidang]);
    }
    public function addGet(){
        return view('pages.baidang.add',['route'=>route('baidang.them')]);
    }
}
