<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiTap;
use App\Models\CauHoi;

class BaiTapController extends Controller
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
        $baihoc = BaiTap::where($filter)->where(function ($query) use ($keysfilter){
            $query->where('ten_baitap','like','%'.$keysfilter.'%')->orWhere('slug','like','%'.$keysfilter.'%');
        })->paginate(10);
        $baitap = BaiTap::paginate(10);
        return view('baitap.list', ['route'=>route('quanly.baitap'), 'baitaps'=>$baitap,'titlePage'=>'Quản lý bài tập', 'breadcrumb'=> 'Danh sách bài tập']);
    }
    public function delete($id_baitap){
        $baitap = BaiTap::where('id_baitap', $id_baitap)->delete();
        if ($baitap){
            return redirect('dashboard/baitap')->with('success','Bạn đã xóa thành công!');
        }
        else {
            return redirect('dashboard/baitap')->with('error','Thất bại, vui lòng thử lại!');
        }
    }
    public function add(Request $req){
        $this->validate($req,
    	[
    		'ten_baitap'=>'required|min:2',
            'soluong'=>'required',
            'thoigian'=>'required',
            'id_baihoc'=>'required'
        ],
    	[
    		'ten_baitap.required'=>'bạn chưa nhập tên bài tập ',
            'ten_baitap.min'=>'tên bài tập ít nhất 2 ký tự',
            'soluong.required'=>'bạn chưa nhập số lượng câu hỏi',
            'thoigian.required'=>'bạn chưa nhập thời gian làm bài',
            'id_baihoc.required'=>'bạn chọn bài học',
    	]);
        $baitap = new BaiTap;
        $baitapOld = BaiTap::max('id_baitap');
            // dd($baitapOld);  
            if ($baitapOld===null){
                $baitap->id_baitap = 'BT-1';
            }
            else{
                $baitapNUm = explode('-',$baitapOld);
                // dd($baitapNUm);
                $num = (int)$baitapNUm[1]+1;
                // dd($num);
                $baitap->id_baitap = 'BT-'.$num;
            }
        $baitap->ten_baitap = $req->ten_baitap;
        $baitap->soluong_cauhoi = $req->soluong;
        $baitap->thoigian_lambai = $req->thoigian;
        $baitap->slug = Controller::locdau($req->ten_baitap);
        $baitap->id_baihoc = $req->id_baihoc;
        $baitap->save();

        if ($baitap){
            return redirect('dashboard/baitap/')->with('success','Bạn đã thêm thành công');
        }
        else {
            return redirect('dashboard/baitap/')->with('error','Thất bại, vui lòng thử lại');
        }
    }
    public function editGet($id){
        $baitap = BaiTap::find($id);
        $cauhoi = CauHoi::where('id_baitap', $id)->get();
        
        return view('baitap.edit', ['baitap'=>$baitap,
        'cauhois'=>$cauhoi,
        'titlePage'=>'Quản lý bài tập', 
        'breadcrumb'=> 'Chỉnh sửa bài tập',
        'linkPage'=>'/dashboard/baitap']);
    }
    public function editPost(Request $req, $id){
        $this->validate($req,
    	[
    		'ten_baitap'=>'required|min:2',
            'soluong'=>'required',
            'thoigian'=>'required',
            'id_baihoc'=>'required'
        ],
    	[
    		'ten_baitap.required'=>'bạn chưa nhập tên bài tập ',
            'ten_baitap.min'=>'tên bài tập ít nhất 2 ký tự',
            'soluong.required'=>'bạn chưa nhập số lượng câu hỏi',
            'thoigian.required'=>'bạn chưa nhập thời gian làm bài',
            'id_baihoc.required'=>'bạn chọn bài học',
    	]);

        $baitap = BaiTap::find($id);
        $baitap->ten_baitap = $req->ten_baitap;
        $baitap->soluong_cauhoi = $req->soluong;
        $baitap->thoigian_lambai = $req->thoigian;
        $baitap->slug = Controller::locdau($req->ten_baitap);
        $baitap->id_baihoc = $req->id_baihoc;
        $baitap->save();

        if ($baitap){
            return redirect('dashboard/baitap/'.$id)->with('success','Bạn đã thay đổi thành công');
        }
        else {
            return redirect('dashboard/baitap/'.$id)->with('error','Thất bại, vui lòng thử lại');
        }
    }
    public function deleteAll(Request $req){
        $id = $req->ids;
        BaiTap::whereIn('id_baitap', $id)->delete();
        // return redirect('/dashboard/quantrivien')->with('success','Bạn đã xóa thành công!');
        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }
}
