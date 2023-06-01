<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ThongTinLamBai;
use App\Models\KetQua;
use App\Models\BaiHoc;

use App\Models\LamBaiTap;
use App\Models\BaiTap;
use App\Models\ChuDe;
use DB;
class QuaTrinhOnTapController extends Controller
{
    public function index(Request $req){
        $queryFilter=[];
        $filter=[];
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

        $thongtin = KetQua::whereIn('id_baitap',$queryFilter)->where('id_hocvien', Auth::user()->id)->orderBy('created_at')->get()->groupBy(function($data) {
            return $data->id_baitap;
        });

        return view('pages.qua-trinh-on-tap.index', ['thongtin'=>$thongtin,'page'=>'Quá trình ôn tập',  'title'=>'Quá trình ôn tập']);
    }
    public function viewDetail(Request $req, $slug){
        $baitap = BaiTap::where('slug', $slug)->first();

        $users = KetQua::where('id_hocvien', Auth::user()->id)->where('id_baitap', $baitap->id_baitap)->orderBy('created_at')->get()->groupBy(function($data) {
            return $data->id_baitap;
        });

        
        return view('pages.qua-trinh-on-tap.result',['baitap'=>$baitap, 'users'=>$users,'page'=>'Quá trình ôn tập', 'link'=>'/qua-trinh-on-tap','title'=>'Bài tập '.$baitap->ten_baitap]);        
}
}
