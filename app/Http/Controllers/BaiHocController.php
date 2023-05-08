<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiHoc;
use Auth; 
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
    public function indexPage(){
        $baihocs = BaiHoc::all();
        return view('pages.baihoc.index',['route'=>route('baihoc.index'),'baihocs'=>$baihocs]);
    }
}
