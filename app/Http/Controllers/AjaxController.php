<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiHoc;
use App\Models\BaiTap;
use App\Models\CauHoi;
use \Illuminate\Http\Response;

class AjaxController extends Controller
{
    public function getBaiHoc(Request $req)
    {
//         $baihoc = BaiHoc::where('id_chude',$id_chude)->get();
//         dd($baihoc);
//         return response()->json($baihoc);
            $baihoc = BaiHoc::where('id_chude', $req->id_chude)->get();

            if (count($baihoc) > 0) {
            return \Response::json($baihoc);
            }
    }

    public function getBaiTap(Request $req){
        $baihoc = BaiHoc::where('id_chude', $req->id_chude)->get();
        $idBh = [];
        foreach ($baihoc as $item){
            $idBh[] = $item->id_baihoc;
        }
        $baitap = BaiTap::whereIn('id_baihoc', $idBh)->get();
        $id = [];
        if (count($baitap) > 0){
            foreach ($baitap as $item){
                $id[] = $item->id_baihoc;
            }
            $baihoctap = BaiHoc::where('id_chude', $req->id_chude)->whereIn('id_baihoc', $id)->get();

            return \Response::json($baihoctap);
        }
    }
    public function GetTenCauHoi(Request $req){
        $cauhoi = CauHoi::where('id_baihoc', $req->baihoc)->get();

        if (count($cauhoi)===0){
            $tencauhoi = 'Câu 1';
        }
        else {
            $tencauhoi_cu = CauHoi::where('id_baihoc', $req->baihoc)->orderBy('id', 'DESC')->latest()->first();
            $stt = explode(' ',$tencauhoi_cu->ten_cauhoi);
                
                $num = (int)$stt[1]+1;
                // dd($num);
                $tencauhoi = 'Câu '.$num;
                // dd ($tencauhoi_cu, count($cauhoi), $tencauhoi);
        }

        return \Response::json($tencauhoi);

    }
}