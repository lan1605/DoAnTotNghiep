<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KetQua;
use App\Models\BaiTap;

class ThongKeController extends Controller
{
    public function index(Request $req){
        if (!empty($req->thongke)){
            $baitap = BaiTap::where('id_baihoc',$req->thongke)->first();
            $data = KetQua::select('id', 'tong_diem','id_hocvien')->where('id_baitap', $baitap->id_baitap)->get()->groupBy(function ($data){
                return  $data->tong_diem;
            });
            $diem = [];
            $solan = [];

            foreach ($data as $key => $value){
                $diem[] = $key;
                $solan [] = count($value);
            }
            return view('thongke.index', ['data'=>$data, 'diem'=>$diem, 'solan'=>$solan, 'titlePage'=>'Thống kê','breadcrumb'=>'Thống kê bài tập '.$baitap->ten_baitap, 'title'=>$baitap->ten_baitap]);
        }
        
        // dd($data, $diem, $solan);
        return view('thongke.index', [ 'titlePage'=>'Thống kê','breadcrumb'=>'Thống kê']);
    }
}
