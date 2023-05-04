<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiHoc;
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
}