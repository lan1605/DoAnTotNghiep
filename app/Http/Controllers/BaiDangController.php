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
        })->orderBy('id_chude', 'ASC')->paginate(10);
        
        $baidangmoi = BaiDang::orderBy('created_at','DESC')->inRandomOrder()->limit(10);
        return view('pages.baidang.index',['route'=>route('baidang.index'), 'baidangs'=>$baidangs,'baidangmoi'=>$baidangmoi,
        'page'=>'Góc hỏi đáp', 'title'=>'Danh sách']);  
    }
    public function viewDetail($slug){
        $baidang = BaiDang::where('slug', $slug)->first();
        
        $cungchude = BaiDang::where('id','!=', $baidang->id)->where('id_chude',$baidang->id_chude)->get();

        $cungtacgia = BaiDang::where('id','!=', $baidang->id)->where('id_hocvien',$baidang->id_hocvien)->get();
        $baidang->truy_cap = $baidang->truy_cap+1;
        $baidang->save();

        return view('pages.baidang.detail',['baidang'=>$baidang, 'cungchude'=> $cungchude, 'cungtacgia'=>$cungtacgia, 'page'=>'Góc hỏi đáp', 'title'=>$baidang->ten_baidang, 'link'=>'/goc-hoi-dap']);
    }
    public function addGet(){
        return view('pages.baidang.add',['page'=>'Góc hỏi đáp', 'title'=>'Thêm mới bài viết', 'link'=>'/goc-hoi-dap']);
    }
    public function addPost(Request $req){
        $this->validate($req,
    	[
    		'ten_baidang'=>'required|min:2',
            'noi_dung' => 'required',
            'id_chude'=>'required',
        ],
    	[
    		'ten_baidang.required'=>'bạn chưa nhập tên bài đăng ',
            'ten_baidang.min'=>'tên bài đăng ít nhất 2 ký tự',
            'noi_dung.required'=>'bạn chưa nhập nội dung bài đăng ',
            'id_chude.required'=>'bạn chưa chọn chủ đề',
    	]);

        $baidang = new BaiDang;
        $baidang->ten_baidang = $req->ten_baidang;
        $baidang->noidung_baidang = $req->noi_dung;
        $baidang->slug = Controller::locdau($req->ten_baidang);
        $baidang->id_chude = $req->id_chude;
        $baidang->id_hocvien = Auth::user()->id;
        $baidang->save();

        if ($baidang) {
            return redirect('/goc-hoi-dap/them-moi')->with('success', 'Thêm bài đăng thành công');
        }
        else {
            return redirect('/goc-hoi-dap/them-moi')->with('error', 'Thất bại, vui lòng thử lại');
        }
    }
    public function indexMine(Request $req){
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
        $baidangs = BaiDang::where($filter)->where('id_hocvien',Auth::user()->id)->where(function ($query) use ($keysfilter){
            $query->where('ten_baidang','like','%'.$keysfilter.'%')->orWhere('slug','like','%'.$keysfilter.'%');
        })->orderBy('id_chude', 'ASC')->paginate(10);

        return view('pages.baidang.list',['route'=>route('baidang.canhan.index'), 'baidangs'=>$baidangs,'page'=>'Góc hỏi đáp', 'title'=>'Danh sách bài viết của bạn', 'link'=>'/goc-hoi-dap']);  
    }
    public function deleteMine($slug){
        $baidang = BaiDang::where('slug', $slug)->where('id_hocvien', Auth::user()->id)->first();

        $baidang->delete();

        if ($baidang){
            return redirect()->back()->with('success', 'Bạn đã xóa thành công!');
        }
        else {
            return redirect()->back()->with('error', 'Thất bại, vui lòng thử lại!');
        }
    }
    public function editGet($slug){
        $baidang = BaiDang::where('slug', $slug)->where('id_hocvien', Auth::user()->id)->first();

        return view('pages.baidang.edit',['baidang'=>$baidang, 'page'=>'Góc hỏi đáp', 'title'=>$baidang->ten_baidang, 'link'=>'/goc-hoi-dap']);
    }
    public function editPost(Request $req, $slug){
        $baidang = BaiDang::where('slug', $slug)->where('id_hocvien', Auth::user()->id)->first();

        $this->validate($req,
    	[
    		'ten_baidangEdit'=>'required|min:2',
            'noi_dungEdit' => 'required',
            'id_chudeEdit'=>'required',
        ],
    	[
    		'ten_baidangEdit.required'=>'bạn chưa nhập tên bài đăng ',
            'ten_baidangEdit.min'=>'tên bài đăng ít nhất 2 ký tự',
            'noi_dungEdit.required'=>'bạn chưa nhập nội dung bài đăng ',
            'id_chudeEdit.required'=>'bạn chưa chọn chủ đề',
    	]);
        
        $baidang->ten_baidang = $req->ten_baidangEdit;
        $baidang->noidung_baidang = $req->noi_dungEdit;
        $baidang->slug = Controller::locdau($req->ten_baidangEdit);
        $baidang->id_chude = $req->id_chudeEdit;
        $baidang->id_hocvien = Auth::user()->id;
        $baidang->save();

        if ($baidang) {
            return redirect('goc-hoi-dap/'.$slug.'/chinh-sua')->with('success', 'Thay đổi bài đăng thành công');
        }
        else {
            return redirect('goc-hoi-dap/'.$slug.'/chinh-sua')->with('error', 'Thất bại, vui lòng thử lại');
        }
    }
}
