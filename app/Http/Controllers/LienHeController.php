<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LienHe;

class LienHeController extends Controller
{
    public function index(){
        return view('pages.lien-he.index',['page'=>'Liên hệ', 'title'=>'Liên hệ với chúng tôi']);
    }
    public function sendMail(Request $req){
        $this->validate($req,
    	[
    		'name'=>'required',
            'noi_dung' => 'required',
            'email'=>'required|email',
            'sdt'=>'required',
        ],
    	[
    		'name.required'=>'bạn chưa nhập tên  ',
            'name.min'=>'tên  ít nhất 2 ký tự',
            'noi_dung.required'=>'bạn chưa nhập nội dung  ',
            'email.required'=>'bạn chưa nhập email',
            'sdt.required'=>'bạn chưa nhập số điện thoại',
    	]);

        $lienhe = new LienHe;
        
        $lienhe->ten = $req->name;
        $lienhe->email = $req->email;
        $lienhe->noidung_lienhe = $req->noi_dung;
        $lienhe->sdt = $req->sdt;
        $lienhe->save();

        if ($lienhe){
            return back()->with('success', 'Bạn đã gửi liên hệ thành công, xin vui lòng đợi phản hồi của chúng tôi');
        }
        else {
            return back()->with('error', 'Thất bại, vui lòng thử lại');
        }
    }
}
