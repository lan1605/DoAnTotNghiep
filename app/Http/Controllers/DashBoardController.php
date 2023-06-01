<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiTap;
use App\Models\BaiHoc;
use App\Models\Admin;
use App\Models\User;
use App\Models\BaiDang;
use App\Models\CauHoi;
use App\Models\ChuDe;
use App\Models\TruyCap;
use App\Models\LienHe;
use Carbon\Carbon;

class DashBoardController extends Controller
{
    public function index(Request $req){
        //total
        $baitap = BaiTap::count();
        $baihoc = BaiHoc::count();
        $admin = Admin::count();
        $chude = ChuDe::count();
        $hocvien = User::count();
        $baidang = BaiDang::count();
        $cauhoi = CauHoi::count();
        $lienhe = LienHe::count();
        //thống kê lượt truy cập 
        $user_ip = $req->ip();
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString(); //đầu tháng trước
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString(); //cuối tháng trước
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString(); //đầu tháng này
        $oneyear = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        //tổng truy cập tháng trước
        $thangtruoc = User::whereBetween('created_at',[$early_last_month, $end_of_last_month])->get();
        
        $tong_thangtruoc = $thangtruoc->count();
        //tổng truy cập tháng này
        $thangnay = User::whereBetween('created_at',[$end_of_last_month, $now])->get();
        $tong_thangnay = $thangnay->count();
        // dd($thangnay);
        // $truycap_hientai = TruyCap::where('diachi_ip', $user_ip)->get();
        $truycap_hientai=User::where('truy_cap','>=',now()->subMinutes(5))->get();
        $truycap = $truycap_hientai->count();
        if ($truycap < 1){
            $truycap_moi = new TruyCap;
            $truycap_moi->diachi_ip = $user_ip;
            $truycap_moi->thoigian_truycap = $now;
            $truycap_moi->save();
        }
        //tổng số lượng truy cập
        $soluong = User::count();

        $baihoc_truycap = BaiHoc::orderBy('luotxem', 'DESC')->take(20)->get();
        $baidang_truycap = BaiDang::orderBy('truy_cap', 'DESC')->take(20)->get();
        return view('admin.admin',['route'=>route('quanly.trangchu'),'admin'=>$admin,
        // 'giangvien'=>$giangvien, 
        'hocvien'=>$hocvien, 'baitap'=>$baitap,
        'baihoc' => $baihoc, 'baidang'=>$baidang,
        'chude' => $chude, 'cauhoi'=>$cauhoi, 'lienhe'=>$lienhe,'truycap' => $soluong, 'baihoc_truycap'=>$baihoc_truycap, 'baidang_truycap'=>$baidang_truycap,
        'truycap_hientai'=>$truycap, 'tong_thangtruoc'=>$tong_thangtruoc, 'tong_thangnay'=>$tong_thangnay]);
    }
}
