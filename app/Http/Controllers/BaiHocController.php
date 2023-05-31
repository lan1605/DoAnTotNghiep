<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiHoc;
use App\Models\BaiTap;
use App\Models\KetQua;
use App\Models\LuuBaiHoc;
use App\Models\ThoiGianHoc;
use File;
use Illuminate\Support\Facades\Auth; 
class BaiHocController extends Controller
{
    public function index(Request $req){
        $filter =[];
        $keysfilter ='';
        if (!empty($req->find_cate)){
            if ($req->find_cate==0){
                $filter[]=[];
            }
            else {
                $find_cate = $req->find_cate;
                $filter[] = ['bai_hocs.id_chude', '=', $find_cate];
            }
        }
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
        $baihoc = BaiHoc::where($filter)->where(function ($query) use ($keysfilter){
            $query->where('ten_baihoc','like','%'.$keysfilter.'%')->orWhere('slug','like','%'.$keysfilter.'%');
        })->paginate(10);
        
        return view('baihoc.list', ['route'=>route('quanly.baihoc'), 'baihocs'=>$baihoc,'titlePage'=>'Quản lý bài học', 'breadcrumb'=> 'Danh sách bài học']);
    }
    public function addGet(){
        return view('baihoc.add',['route'=>route('quanly.baihoc.them'), 'titlePage'=>'Quản lý bài học', 'breadcrumb'=> 'Thêm bài học mới', 'linkPage'=>'/dashboard/baihoc']);
    }
    public function addPost(Request $req){
        $this->validate($req,
    	[
    		'ten_baihoc'=>'required|min:2|unique:bai_hocs',
            'noi_dung'=>'required',
            'chude'=>'required',
            'tinh_trang'=>'required',
    	],
    	[
    		'ten_baihoc.required'=>'bạn chưa nhập tên bài học ',
            'ten_baihoc.min'=>'tên bài học ít nhất 2 ký tự',
            'ten_baihoc.unique'=>'tên bài học đã tồn tại',
            'noi_dung.required'=>'bạn chưa nhập nội dung',
            'chude_required'=>'bạn chưa chọn chủ đề',
            'tinh_trang'=>'bạn chưa chọn chủ đề',
    	]);
        $baihoc = new BaiHoc;
        $baihoc->ten_baihoc = $req->ten_baihoc;
        $baihoc->noi_dung = $req->noi_dung;
        $baihoc->id_admin = Auth::user()->id_admin;
        $baihoc->id_chude = $req->chude;
        $baihoc->tinh_trang = $req->tinh_trang;
        $baihoc->slug=Controller::locdau($req->ten_baihoc);
        $baihocOld = BaiHoc::max('id_baihoc');
        // dd($baihocOld);  
        if ($baihocOld===null){
            $baihoc->id_baihoc = 'BH-1';
        }
        else{
            $baihocNum = explode('-',$baihocOld);
            // dd($baihocNum);
            $num = (int)$baihocNum[1]+1;
            // dd($num);
            $baihoc->id_baihoc = 'BH-'.$num;
        }
        if($req->hasFile('video')){
            $originName = $req->ten_baihoc;
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $req->file('video')->getClientOriginalExtension();
            $fileName = $fileName .'.'.$extension;
            $req->file('video')->move(public_path('media/videos'), $fileName);

            $url = asset('media/videos/'.$fileName);
            $baihoc->video=$url;
        }
        $baihoc->save();
        if ($baihoc){
            return redirect('dashboard/baihoc/them')->with('success','Thêm bài học mới thành công!!');
        }
        else {
            return redirect('dashboard/baihoc/them')->with('error','Thất bại, vui lòng thử lại!!');
        }
    }
    public function editGet($id_baihoc){
        $baihoc= BaiHoc::find($id_baihoc);
        return view('baihoc.edit',['baihoc'=> $baihoc,
        'linkPage'=> '/dashboard/baihoc',
        'titlePage' => 'Quản lý bài học',
         'breadcrumb'=>'Chỉnh sửa bài học']);
    }
    public function editPost(Request $req, $id_baihoc){
        $baihoc = BaiHoc::find($id_baihoc);
        $this->validate($req,
    	[
    		'ten_baihoc'=>'required|min:2',
            'noi_dung'=>'required',
            'chude'=>'required',
            'tinh_trang'=>'required',
    	],
    	[
    		'ten_baihoc.required'=>'bạn chưa nhập tên bài học ',
            'ten_baihoc.min'=>'tên bài học ít nhất 2 ký tự',
            'noi_dung.required'=>'bạn chưa nhập nội dung',
            'chude_required'=>'bạn chưa chọn chủ đề',
            'tinh_trang'=>'bạn chưa chọn chủ đề',
    	]);
        if ($req->hasFile('video')){
            if (File::exists('media/videos/'.$baihoc->video)){
                File::delete('media/videos/'.$baihoc->video);
            }
            $originName = $req->ten_baihoc;
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $req->file('video')->getClientOriginalExtension();
            $fileName = $fileName .'.'.$extension;
            $req->file('video')->move(public_path('media/videos'), $fileName);

            $url = asset('media/videos/'.$fileName);
            $baihoc->video=$url;
            $baihoc->ten_baihoc = $req->ten_baihoc;
            $baihoc->slug=Controller::locdau($req->ten_baihoc);
            $baihoc->noi_dung = $req->noi_dung;
            $baihoc->id_chude = $req->chude;
            $baihoc->tinh_trang = $req->tinh_trang;

            $baihoc->save();

            if ($baihoc){
                return redirect('dashboard/baihoc')->with('success','Thay đổi bài học thành công!!');
            }
            else {
                return redirect('dashboard/baihoc')->with('error','Thất bại, vui lòng thử lại!!');
            }
        }
        else {
            $baihoc->ten_baihoc = $req->ten_baihoc;
            $baihoc->slug=Controller::locdau($req->ten_baihoc);
            $baihoc->noi_dung = $req->noi_dung;
            $baihoc->id_chude = $req->chude;
            $baihoc->tinh_trang = $req->tinh_trang;

            $baihoc->save();

            if ($baihoc){
                return redirect('dashboard/baihoc')->with('success','Thay đổi bài học thành công!!');
            }
            else {
                return redirect('dashboard/baihoc')->with('error','Thất bại, vui lòng thử lại!!');
            }
        }
    }
    public function destroy($id_baihoc){
        $baihoc = BaiHoc::where('id_baihoc',$id_baihoc);
        $baihoc->delete();
        if ($baihoc){
            return redirect('/dashboard/baihoc')->with('success','Xóa bài học thành công!!');
        }
        else {
            return redirect('/dashboard/baihoc')->with('error','Thất bại, vui lòng thử lại!!');
        }
    }
    public function deleteAll(Request $req){
        $id = $req->ids;
        BaiHoc::whereIn('id_baihoc', $id)->delete();
        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }
    //Pages
    public function indexPage(Request $req){
        $filter =[];
        $keysfilter ='';
        if (!empty($req->find_cate)){
            if ($req->find_cate==0){
                $filter[]=[];
            }
            else {
                $find_cate = $req->find_cate;
                $filter[] = ['bai_hocs.id_chude', '=', $find_cate];
            }
        }
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
        $baihocs = BaiHoc::where($filter)->where(function ($query) use ($keysfilter){
            $query->where('ten_baihoc','like','%'.$keysfilter.'%')->orWhere('slug','like','%'.$keysfilter.'%');
        })->where('tinh_trang','=',1)->orderBy('id_chude', 'ASC')->get();

        return view('pages.baihoc.index',['route'=>route('baihoc.index'),
        'baihocs'=>$baihocs,'page'=>'Bài học', 'title'=>'Danh sách bài học']);
    }
    public function viewDetail($slug){
        $chitiet = BaiHoc::where('slug',$slug)->first();

        $chitiet->luotxem = $chitiet->luotxem+1;
        $chitiet->save();

        $next_id = BaiHoc::where('id_baihoc', '>',$chitiet->id_baihoc)->where('id_chude', $chitiet->id_chude)->min('id_baihoc');
        $prev_id = BaiHoc::where('id_baihoc', '<',$chitiet->id_baihoc)->where('id_chude', $chitiet->id_chude)->max('id_baihoc');

        $daluu = ThoiGianHoc::where('id_baihoc',$chitiet->id_baihoc)->where('id_hocvien',Auth::user()->id)->orderBy('created_at', 'DESC')->first();
        $baitap = BaiTap::where('id_baihoc', $chitiet->id_baihoc)->first();
        $solanlambai = KetQua::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $thoigianlambai = KetQua::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
        if(isset($daluu)){
            $capnhat = ThoiGianHoc::find($daluu->id);
            $capnhat->updated_at = date('Y-m-d G:i:s');
            // dd($capnhat);
            $capnhat->save();
        }
        else {
            $thoigianhoc = new ThoiGianHoc;
            $thoigianhoc->id_hocvien = Auth::user()->id;
            $thoigianhoc->id_baihoc = $chitiet->id_baihoc;
            $thoigianhoc->save();
        }
        // $daluu->touch();
        

        $cungchude = BaiHoc::where('id_baihoc','!=' ,$chitiet->id_baihoc)->where('id_chude', $chitiet->id_chude)->get();
        return view('pages.baihoc.detail',[ 'chitiet'=>$chitiet, 'cungchude'=>$cungchude, 'next'=> $next_id, 'prev'=> $prev_id, 
        'page'=>'Bài học', 'link'=>'/baihoc', 'title'=>$chitiet->ten_baihoc, 'solanlambai'=>count($solanlambai),'thoigian'=>$thoigianlambai]); 
    }
    public function Luubaihoc($slug){
        $baihoc_id= BaiHoc::where('slug',$slug)->first();

        $id = ThoiGianHoc::where('id_baihoc', $baihoc_id->id_baihoc)->orderBy('created_at', 'DESC')->first();
        $luubaihoc = new LuuBaiHoc;
        
        $baihocdaluu = LuuBaiHoc::where('id_baihoc', $baihoc_id->id_baihoc)->first();

        if(!isset($baihocdaluu)){
            $luubaihoc->id_thoigianhoc = $id->id;
            $luubaihoc->id_baihoc = $id->id_baihoc;
            $luubaihoc->save();

            return redirect('bai-hoc/'.$slug)->with('success','Bạn đã lưu thành công');
        }
        else {
            return redirect('bai-hoc/'.$slug)->with('already','Bài học này bạn đã lưu');
        }
        
    }

    public function xoaLuu($slug){
        $baihoc_id= BaiHoc::where('slug',$slug)->first();

        $id = ThoiGianHoc::where('id_baihoc', $baihoc_id->id_baihoc)->orderBy('created_at', 'DESC')->first();
        
        $baihocdaluu = LuuBaiHoc::where('id_baihoc', $baihoc_id->id_baihoc)->first();

        $baihocdaluu->delete();

        if ($baihocdaluu){
            return redirect('bai-hoc/'.$slug)->with('success','Bạn đã xóa khỏi danh sách thành công');
        }
        else {
            return redirect('bai-hoc/'.$slug)->with('error','Lỗi, vui lòng thử lại');
        }
    }
    public function daLuu(Request $req){
        $daluu = Luubaihoc::all();

        $arrIDthoigian = [];
        foreach ($daluu as $item){
            $arrIDthoigian [] = $item->id_thoigianhoc;
        }

        $thoigianhoc = ThoiGianHoc::where('id_hocvien', Auth::user()->id)->whereIn('id', $arrIDthoigian)->get();

        $arrIDbaihoc = [];

        foreach ($thoigianhoc as $item){
            $arrIDbaihoc [] = $item->id_baihoc;
        }
        $filter =[];
        $keysfilter ='';
        if (!empty($req->find_cate)){
            if ($req->find_cate==0){
                $filter[]=[];
            }
            else {
                $find_cate = $req->find_cate;
                $filter[] = ['bai_hocs.id_chude', '=', $find_cate];
            }
        }
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }

        $baihocs = BaiHoc::whereIn('id_baihoc', $arrIDbaihoc)->where($filter)->where(function ($query) use ($keysfilter){
            $query->where('ten_baihoc','like','%'.$keysfilter.'%')->orWhere('slug','like','%'.$keysfilter.'%');
        })->orderBy('id_chude', 'ASC')->get();
        // dd($thoigianhoc);
        return view('pages.baihoc.list',['baihocs'=>$baihocs, 'page'=>'Bài học', 'link'=>'/bai-hoc', 'title'=>'Danh sách bài học đã lưu']);
    }

    
}
