<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KetQua;
use App\Models\BaiHoc;
use App\Models\User;
use App\Models\BaiTap;
use App\Models\LamBaiTap;

class ThongTinLamBaiController extends Controller
{
    public function index(Request $req){
        $filter =[];
        $queryFilter=[];
        $keysfilter ='';
        if (isset($req->find_cate)){
            if ($req->find_cate==0){
                $all = BaiTap::all();
                foreach ($all as $item){
                    $queryFilter[]=$item->id_baitap;
                }
            }
            else {
                $find_cate = $req->find_cate;
                $find_lession = BaiHoc::where('id_chude', $find_cate)->get();
                foreach ($find_lession as $item){
                    $filter[] = $item->id_baihoc;
                }

            }
        }
        else{
            $all = BaiTap::all();
                foreach ($all as $item){
                    $queryFilter[]=$item->id_baitap;
                }
        }
        $baitap =  BaiTap::whereIn('id_baihoc', $filter)->get();
                foreach ($baitap as $item){
                    $queryFilter[]=$item->id_baitap;
                }
        // dd($baitap);          
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
        
        $thongtin =  KetQua::whereIn('id_baitap',$queryFilter)->orderBy('created_at')->paginate(10);

        $thongtin->setCollection($thongtin->groupBy(function($data) {
            return $data->id_baitap;
        }));
        
        // dd($thongtin);   
        return view('admin.thong-tin-lam-bai.index', ['route'=>route('quanly.thongtinlambai'), 'thongtin'=>$thongtin,'titlePage'=>'Quản lý thông tin làm bài', 'breadcrumb'=> 'Danh sách bài tập đã làm']);
    }
    public function delete($slug){
        $baitap = BaiTap::where('slug', $slug)->first();

        $thongtin = KetQua::where('id_baitap', $baitap->id_baitap)->delete();
        $lambai = LamBaiTap::where('id_baitap', $baitap->id_baitap)->delete();
        

        // dd($baitap, $thongtin, $lambai);
        if ($thongtin){
            return back()->with('success', 'Bạn đã xóa thành công');
        }
        else {
            return back()->with('errors', 'Thất bại, vui lòng thử lại.');
        }
    }
    public function deleteAll(Request $req){
        $ids = $req->ids;

        $thongtin = KetQua::whereIn('id_baitap', $ids)->delete();
        $lambai = LamBaiTap::whereIn('id_baitap', $ids)->delete();

        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }
    public function view($slug, $id_hocvien){
        $baitap = BaiTap::where('slug', $slug)->first();

        // dd($baitapBT);
        $user = User::where('id',$id_hocvien)->first();
        $thongtin = KetQua::where('id_hocvien', $id_hocvien)->where('id_baitap', $baitap->id_baitap)->orderBy('created_at')->get()->groupBy(function($data) {
            return $data->id_hocvien;
        });

        return view('admin.thong-tin-lam-bai.result', ['thongtin'=>$thongtin,'baitap'=>$baitap,
        'titlePage'=>$baitap->ten_baitap,'linkPage'=>'/dashboard/thongtinlambai/'.$baitap->slug, 'breadcrumb'=> 'Thông tin làm bài của học viên '.$user->name ]);
    }
    public function detail($slug){

        $baitap = BaiTap::where('slug', $slug)->first();
        $thongtin =  KetQua::where('id_baitap',$baitap->id_baitap)->orderBy('created_at')->paginate(10);

        $thongtin->setCollection($thongtin->groupBy(function($data) {
            return $data->id_hocvien;
        }));

        // dd($thongtin);

        return view('admin.thong-tin-lam-bai.detail', ['thongtin'=>$thongtin,'baitap'=>$baitap,
        'titlePage'=>'Quản lý thông tin làm bài','linkPage'=>'/dashboard/thongtinlambai', 'breadcrumb'=> $baitap->ten_baitap]);
    }
    public function deleteOne($slug, $id_hocvien){
        $baitap = BaiTap::where('slug', $slug)->first();

        $user = User::where('id',$id_hocvien)->first();

        $thongtin = KetQua::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', $user->id)->delete();

        $kiemtra = KetQua::where('id_baitap',$baitap->id_baitap)->orderBy('created_at')->get();

        if (count($kiemtra)==0){
            return redirect('/dashboard/thongtinlambai')->with('success', 'Bạn đã xóa thành công');
        }
        else {
            return back()->with('success', 'Bạn đã xóa thành công');
        }
    }
}
