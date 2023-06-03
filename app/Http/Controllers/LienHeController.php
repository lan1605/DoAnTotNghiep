<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LienHe;
use App\Mail\sendMail;

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
    public function store(Request $req){
        $keysfilter ='';
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
        $lienhes = LienHe::where('ten','like','%'.$keysfilter.'%')->orWhere('email','like','%'.$keysfilter.'%')->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.lien-he.index', ['lienhes'=>$lienhes,'titlePage'=>'Quản lý liên hệ', 'breadcrumb'=> 'Danh sách liên hệ']);
    }
    public function delete($id){
        $lienhe = LienHe::find($id);

        $lienhe->delete();

        if ($lienhe){
            return redirect()->back()->with('success', 'Bạn đã xóa thành công!');
        }
        else {
            return redirect()->back()->with('error', 'Thất bại, vui lòng thử lại!');
        }
    }
    public function deleteAll(Request $req){
        $id = $req->ids;
        LienHe::whereIn('id', $id)->delete();
        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }
    public function detail($id){
        $lienhe = LienHe::find($id);

        return view('admin.lien-he.send', ['lienhe'=>$lienhe,'titlePage'=>'Quản lý liên hệ', 'breadcrumb'=> 'Chi tiết liên hệ của '.$lienhe->ten,'linkPage'=>'/dashboard/lienhe']);
    }

    public function send(Request $req, $id){
        $lienhe = LienHe::find($id);

        $lienhe->noidung_phanhoi = $req->noi_dung;
        $lienhe->save();

        $details = [
            'ten'=>$lienhe->ten,
            'email'=>$lienhe->email,
            'sdt'=>$lienhe->sdt,
            'noidung_lienhe'=>$lienhe->noidung_lienhe,
            'noidung_phanhoi'=>$req->noi_dung,

        ];
        \Mail::to($lienhe->email)->send(new sendMail($details));

        return back()->with('success', 'Đã gửi phản hồi thành công');
    }
}
