<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiTap;
use App\Models\BaiHoc;
use App\Models\CauHoi;

class BaiTapController extends Controller
{
    public function index(Request $req){
        $queryFilter=[];
        $keysfilter ='';
        if (isset($req->find_cate)){
            if ($req->find_cate==0){
                $all = BaiHoc::all();
                foreach ($all as $item){
                    $queryFilter[]=$item->id_baihoc;
                }
            }
            else {
                $find_cate = $req->find_cate;
                $find_lession = BaiHoc::where('id_chude', $find_cate)->get();
                foreach ($find_lession as $item){
                    $queryFilter[] = $item->id_baihoc;
                }

            }
        } 
        else{
            $all = BaiHoc::all();
                foreach ($all as $item){
                    $queryFilter[]=$item->id_baihoc;
                }
        } 
        // dd($queryFilter);
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
        
        $baitaps =  BaiTap::whereIn('id_baihoc',$queryFilter)->where(function ($query) use ($keysfilter){
            $query->where('ten_baitap','like','%'.$keysfilter.'%')->orWhere('slug','like','%'.$keysfilter.'%');
        })->paginate(10);  
        // dd($baitaps); 
        return view('baitap.list', ['route'=>route('quanly.baitap'), 'baitaps'=>$baitaps,'titlePage'=>'Quản lý bài tập', 'breadcrumb'=> 'Danh sách bài tập']);
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
    		
            'soluong'=>'required',
            // 'thoigian'=>'required',
            'id_baihoc'=>'required'
        ],
    	[
            'soluong.required'=>'bạn chưa nhập số lượng câu hỏi',
            // 'thoigian.required'=>'bạn chưa nhập thời gian làm bài',
            'id_baihoc.required'=>'bạn chọn bài học',
    	]);
        $ten_baihoc = BaiHoc::find($req->id_baihoc)->ten_baihoc;
        if (BaiTap::where('ten_baitap', $ten_baihoc)->count()>0){
            return redirect('dashboard/baitap/')->with('error','Bài tập này đã tồn tại, vui lòng thử lại');
        }
        else {
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
       
        $baitap->ten_baitap = $ten_baihoc;
        $baitap->soluong_cauhoi = $req->soluong;
        $baitap->thoigian_lambai = $req->soluong*1;
        $tong_cauhoi = CauHoi::where('id_baihoc', $req->id_baihoc)->get();
        $baitap->tong_cauhoi = count($tong_cauhoi);
        $baitap->slug = Controller::locdau($ten_baihoc);
        $baitap->id_baihoc = $req->id_baihoc;
        $baitap->save();
        return redirect('dashboard/baitap/')->with('success','Bạn đã thêm thành công');
        }
        
    }
    
    public function editPost(Request $req, $id){
        $this->validate($req,
    	[
            'soluongEdit'=>'required'
            // 'thoigian'=>'required',
        ],
    	[
            'soluongEdit.required'=>'bạn chưa nhập số lượng câu hỏi'
            // 'thoigian.required'=>'bạn chưa nhập thời gian làm bài',

    	]);

        $baitap = BaiTap::find($id);
        // $ten_baihoc = BaiHoc::find($req->id_baihocEdit)->ten_baihoc;
        $baitap->soluong_cauhoi = $req->soluongEdit;
        // $baitap->ten_baitap = $ten_baihoc;
        $baitap->thoigian_lambai = $req->soluongEdit * 1;
        // $baitap->slug = Controller::locdau($ten_baihoc);
        // $baitap->id_baihoc = $req->id_baihocEdit;
        $baitap->save();

        if ($baitap){
            return redirect('dashboard/baitap/')->with('success','Bạn đã thay đổi thành công');
        }
        else {
            return redirect('dashboard/baitap/')->with('error','Thất bại, vui lòng thử lại');
        }
    }
    public function deleteAll(Request $req){
        $id = $req->ids;
        BaiTap::whereIn('id_baitap', $id)->delete();
        // return redirect('/dashboard/quantrivien')->with('success','Bạn đã xóa thành công!');
        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }
}
