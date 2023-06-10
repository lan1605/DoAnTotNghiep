<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiHoc;
use App\Models\BaiTap;
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
}