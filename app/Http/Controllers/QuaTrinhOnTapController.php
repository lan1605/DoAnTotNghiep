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

        foreach($users as $timezone => $userList) {
            echo '<ul>';
                echo '<li>' . $timezone . '</li>';
                $baitap = BaiTap::find($timezone);
                // $baihoc = BaiHoc::find($baitap->id_baihoc);
                // $chude = ChuDe::find($baihoc->id_chude);
                // echo $chude->ten_chude;
                echo '<ul>'; 
                $dem = 0;
                
                foreach($userList as $user) {
                    echo '<li>User Email: ' . $user->id_baitap . $user->tong_diem.$user->updated_at. '</li>';
                    $cauhoi = LamBaiTap::where('id_baitap', $baitap->id_baitap)->where('updated_at', $user->updated_at)->where('id_hocvien',Auth::user()->id)->take($baitap->soluong_cauhoi)->orderBy('updated_at', 'DESC')->orderBy('id_cauhoi', 'ASC')->get();
                    $dem = $dem +1;
                    
                }
                echo '</ul>';
                
                echo '</ul>';
                dd($cauhoi);
                echo $dem;
            }
    }
}
