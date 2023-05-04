<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChuDe;
use App\Models\BaiHoc;
use DB;

class ChuDeController extends Controller
{
    public function index(Request $req){
        $keysfilter ='';
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
        $chudes = ChuDe::where('ten_chude','like','%'.$keysfilter.'%')->orWhere('slug','like','%'.$keysfilter.'%')->paginate(10);
        return view('chu-de.list', ['route'=>route('quanly.chude'), 'chudes'=>$chudes,'titlePage'=>'Quản lý chủ đề', 'breadcrumb'=> 'Danh sách chủ đề']);
    }
    public function addPost(Request $req){
        $this->validate($req,
    	[
    		'ten_chude'=>'required|min:2|unique:chu_des',
    	],
    	[
    		'ten_chude.required'=>'bạn chưa nhập tên chủ đề ',
            'ten_chude.min'=>'Tên chủ đề ít nhất 2 ký tự',
            'ten_chude.unique' => 'Tên chủ đề đã tồn tại',
    	]);
        $chudeOld = ChuDe::max('id_chude');
        $chude = new ChuDe;
        if ($chudeOld===null){
            $chude->id_chude = 'CD-1';
        }
        else{
            $chudeNum = explode('-',$chudeOld);
            // dd($baihocNum);
            $num = (int)$chudeNum[1]+1;
            // dd($num);
            $chude->id_chude = 'CD-'.$num;
        }
        $chude->ten_chude = $req->ten_chude;
        $chude->slug = Controller::locdau($req->ten_chude);
        $chude->mo_ta = $req->mo_ta;
        $chude->save();

        if ($chude){
            return redirect('/dashboard/chude')->with('success','Bạn đã thêm thành công!!');
        }
        else {
            return redirect('/dashboard/chude')->with('error','Thất bại, vui lòng thử lại sau.');
        }
    }
    public function editPost(Request $req, $id){
        $chude = ChuDe::find($id);
        $this->validate($req,
    	[
    		'ten_chudeEdit'=>'required|min:2',
    	],
    	[
    		'ten_chudeEdit.required'=>'bạn chưa nhập tên chủ đề ',
            'ten_chudeEdit.min'=>'Tên chủ đề ít nhất 2 ký tự',
    	]);
        $chude->ten_chude = $req->ten_chudeEdit;
        $chude->slug = Controller::locdau($req->ten_chudeEdit);
        $chude->mo_ta = $req->mo_ta;
        $chude->save();

        if ($chude){
            return redirect('/dashboard/chude')->with('success','Bạn đã thay đổi thành công!!');
        }
        else {
            return redirect('/dashboard/chude')->with('error','Thất bại, vui lòng thử lại sau.');
        }
    }
    public function delete($id_chude){
        
        $chude =ChuDe::where('id_chude',$id_chude)->first();
        $chude->delete();
        $baihoc = BaiHoc::where('id_chude', $id_chude);
        if (!empty($baihoc)){
            $baihoc->delete();
        }


    if ($chude) {
        return redirect('/dashboard/chude')->with('success','Bạn đã xóa chủ đề thành công!!');
    }

    return redirect('/dashboard/chude')->with('error','Thất bại, vui lòng thử lại sau.');
} 
public function deleteAll(Request $req){
    $id = $req->ids;
    ChuDe::whereIn('id_chude', $id)->delete();
    BaiHoc::whereIn('id_chude', $id)->delete();
    // return redirect('/dashboard/quantrivien')->with('success','Bạn đã xóa thành công!');
    return response()->json(['success'=>'Bạn đã xóa thành công']);
}
    }
