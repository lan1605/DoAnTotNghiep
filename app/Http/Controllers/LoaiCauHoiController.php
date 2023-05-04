<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiCauHoi;
use App\Models\CauHoi;

class LoaiCauHoiController extends Controller
{
    //
    public function index(Request $req){
        $keysfilter ='';
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
        $loaicauhois = LoaiCauHoi::where('ten_loaicauhoi','like','%'.$keysfilter.'%')->paginate(10);
        return view('loai-cau-hoi.list', ['route'=>route('quanly.loaicauhoi'), 'loaicauhois'=>$loaicauhois,'titlePage'=>'Quản lý câu hỏi', 'breadcrumb'=> 'Danh sách loại câu hỏi']);
    }
    public function addPost(Request $req){
        $this->validate($req,
    	[
    		'ten_loaicauhoi'=>'required|min:2|unique:loai_cau_hois',
    	],
    	[
    		'ten_loaicauhoi.required'=>'bạn chưa nhập tên loại câu hỏi ',
            'ten_loaicauhoi.min'=>'Tên loại câu hỏi ít nhất 2 ký tự',
            'ten_loaicauhoi.unique' => 'Tên loại câu hỏi đã tồn tại',
    	]);
        $loaicauhoi = new LoaiCauHoi;
        $loaicauhoi->ten_loaicauhoi = $req->ten_loaicauhoi;
        // $loaicauhoi->mo_ta = $req->mo_ta;
        $loaicauhoi->save();

        if ($loaicauhoi){
            return redirect('/dashboard/loaicauhoi')->with('success','Bạn đã thêm thành công!!');
        }
        else {
            return redirect('/dashboard/loaicauhoi')->with('error','Thất bại, vui lòng thử lại sau.');
        }
    }
    public function editPost(Request $req, $id){
        $loaicauhoi = LoaiCauHoi::find($id);
        $this->validate($req,
    	[
    		'ten_loaicauhoiEdit'=>'required|min:2',
    	],
    	[
    		'ten_loaicauhoiEdit.required'=>'bạn chưa nhập tên loại câu hỏi ',
            'ten_loaicauhoiEdit.min'=>'Tên loại câu hỏi ít nhất 2 ký tự',
    	]);
        $loaicauhoi->ten_loaicauhoi = $req->ten_loaicauhoiEdit;
        // $loaicauhoi->slug = Controller::locdau($req->ten_chudeEdit);
        // $loaicauhoi->mo_ta = $req->mo_ta;
        $loaicauhoi->save();

        if ($loaicauhoi){
            return redirect('/dashboard/loaicauhoi')->with('success','Bạn đã thay đổi thành công!!');
        }
        else {
            return redirect('/dashboard/loaicauhoi')->with('error','Thất bại, vui lòng thử lại sau.');
        }
    }
    public function delete($id){
        
        $loaicauhoi =LoaiCauHoi::where('id',$id)->first();
        $loaicauhoi->delete();
        $cauhoi = CauHoi::where('id', $id);
        if (!empty($loaicauhoi)){
            $loaicauhoi->delete();
        }


    if ($loaicauhoi) {
        return redirect('/dashboard/loaicauhoi')->with('success','Bạn đã xóa chủ đề thành công!!');
    }

    return redirect('/dashboard/loaicauhoi')->with('error','Thất bại, vui lòng thử lại sau.');
} 
    public function deleteAll(Request $req){
        $id = $req->ids;
        LoaiCauHoi::whereIn('id', $id)->delete();
        $cauhoi = CauHoi::where('id', $id);
        if (!empty($loaicauhoi)){
            $loaicauhoi->delete();
        }
        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }
}
