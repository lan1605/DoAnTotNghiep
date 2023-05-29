<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThoiGianHoc;
use App\Models\BaiHoc;
use Auth;

class QuaTrinhHocTapController extends Controller
{
    public function quatrinh(Request $req){
        $filter =[];
        $keysfilter ='';
        if (!empty($req->find_cate)){
            if ($req->find_cate==0){
                $filter[]=[];
            }
            else {
                $find_cate = $req->find_cate;
                $filter[] = ['bai_hocs.id_chude', '=', $find_cate];
            }
        }
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
        $baihocs = BaiHoc::where($filter)->where(function ($query) use ($keysfilter){
            $query->where('ten_baihoc','like','%'.$keysfilter.'%')->orWhere('slug','like','%'.$keysfilter.'%');
        })->orderBy('id_chude', 'ASC')->paginate(10);
        
        
        $lichsu = ThoiGianHoc::where('id_hocvien', Auth::user()->id)->get();

        // dd($lichsu);

        return view('pages.qua-trinh-hoc-tap.index',['baihoc'=>$baihocs, 'lichsu'=>$lichsu, 'page'=>'Quá trình học tập',  'title'=>'Quá trình học tập']);
    }
}
