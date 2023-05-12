<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiTap;
use App\Models\CauHoi;
use App\Models\LamBaiTap;
use Auth;

class LamBaiTapController extends Controller
{
    public function index($slug){
        $baitap = BaiTap::where('slug', $slug)->first();
        // $posts = Post::inRandomOrder()
        //         ->limit(5)
        //         ->get();
        $lambaitap = LamBaiTap::where('id_baitap', $baitap->id_baitap)->where('id_hocvien',Auth::user()->id)->limit($baitap->soluong_cauhoi)->get();

        $cauhoi = CauHoi::where('id_baihoc','=', $baitap->id_baihoc)->inRandomOrder()->limit($baitap->soluong_cauhoi)->get();
        $arr=[];
        foreach ($cauhoi as $item){
            $arr[] = ['id_baitap'=>$baitap->id_baitap,'id_hocvien'=>Auth::user()->id,'id_cauhoi'=>$item->id];

        }
        dd($arr);
        if (!isset($lambaitap)){
            $taomoi = LamBaiTap::insert($arr[]);
        }
    }
}
