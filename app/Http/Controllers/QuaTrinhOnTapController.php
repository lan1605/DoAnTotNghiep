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

        $users = KetQua::where('id_hocvien', Auth::user()->id)->orderBy('created_at')->get()->groupBy(function($data) {
            return $data->id_baitap;
        });

        return view('pages.qua-trinh-on-tap.index', ['users'=>$users,'page'=>'Quá trình ôn tập',  'title'=>'Quá trình ôn tập']);
    }
    public function viewDetail(Request $req, $slug){
        $baitap = BaiTap::where('slug', $slug)->first();

        $users = KetQua::where('id_hocvien', Auth::user()->id)->where('id_baitap', $baitap->id_baitap)->orderBy('created_at')->get()->groupBy(function($data) {
            return $data->id_baitap;
        });

        
        return view('pages.qua-trinh-on-tap.result',['baitap'=>$baitap, 'users'=>$users,'page'=>'Quá trình ôn tập', 'link'=>'/qua-trinh-on-tap','title'=>$baitap->ten_baitap]);        
}
}
