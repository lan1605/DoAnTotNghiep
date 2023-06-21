<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CauHoi;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Imports\CauHoiImport;
use Maatwebsite\Excel\Facades\Excel;
use Input;
use File;

class CauHoiController extends Controller
{
    public function index(Request $req){
        
        if (empty($req->find_cate) && (empty($req->find_lession))){
            $cauhois = CauHoi::orderBy('id_baihoc', 'ASC')->paginate(10);
        }
        else {
            $filterLession =[];
        if (!empty($req->find_lession)){
            if ($req->find_lession==0){
                $filterLession[]=[];
            }
            else {
                $find_lession = $req->find_lession;
                $filterLession[] = ['cau_hois.id_baihoc', '=', $find_lession];
            }
            $cauhois = CauHoi::where($filterLession)->orderBy('id_baihoc', 'ASC')->paginate(10);
            $cauhois->appends(['id_chude'=>$req->id_chude,'find_lession' => $find_lession]);
        }
        $filter =[];
        if (!empty($req->find_cate)){
            if ($req->find_cate==0){
                $filter[]=[];
            }
            else {
                $find_cate = $req->find_cate;
                $filter[] = ['cau_hois.id_loaicauhoi', '=', $find_cate];
            }
            $cauhois = CauHoi::Where($filter)->orderBy('id_baihoc', 'ASC')->paginate(10);
            $cauhois->appends([ 'find_cate'=>$find_cate]);
        }
        if ($filter != [] && $filterLession != []){
            $cauhois = CauHoi::where($filterLession)->Where($filter)->orderBy('id_baihoc', 'ASC')->paginate(10);
            $cauhois->appends(['id_chude'=>$req->id_chude,'find_lession' => $find_lession, 'find_cate'=>$find_cate]);
        }
        }
        return view('cau-hoi.list', ['route'=>route('quanly.cauhoi'), 'cauhois'=>$cauhois,'titlePage'=>'Quản lý câu hỏi', 'breadcrumb'=> 'Danh sách câu hỏi']);
    }
    public function delete($id){
        $cauhoi = CauHoi::where('id',$id)->delete();
        if ($cauhoi){
            return redirect('dashboard/cauhoi')->with('success', 'Bạn đã xóa thành công');
        }
        else {
            return redirect('dashboard/cauhoi')->with('error', 'Thất bại, vui lòng thử lại!!');
        }
    }
    public function deleteAll(Request $req){
        $id = $req->ids;
        CauHoi::whereIn('id', $id)->delete();
        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }
    public function addGet(){
        return view('cau-hoi.add',['route'=>route('quanly.cauhoi.them'),
        'titlePage'=>'Quản lý câu hỏi', 'breadcrumb'=> 'Thêm câu hỏi mới', 'linkPage'=>'/dashboard/cauhoi'
        ]);
    }
    public function import(Request $req){
        if($req->hasFile('file')){
            Excel::import(new CauHoiImport, $req->file('file'));
            
        }
        else {
            return redirect()->back()->with('error','Đã có lỗi, vui lòng thử lại ');
        }
        return redirect()->back()->with('success','Tải file thành công');
        
    }
    
    
    public function addPost(Request $req){
        $this->validate($req,
    	[
    		'ten_cauhoi'=>'required|min:2',
            'noi_dung' => 'required',
            'dap_an_dung'=>'required',
            'id_baihoc'=>'required',
            'id_loaicauhoi'=>'required'
        ],
    	[
    		'ten_cauhoi.required'=>'bạn chưa nhập tên câu hỏi ',
            'ten_cauhoi.min'=>'tên câu hỏi ít nhất 2 ký tự',
            'noi_dung.required'=>'bạn chưa nhập nội dung câu hỏi ',
            'dap_an_dung.required'=>'bạn chưa nhập đáp án đúng',
            'id_loaicauhoi.required'=>'bạn chọn loại câu hỏi',
            'id_baihoc.required'=>'bạn chọn bài học',
    	]);
        $cauhoi = new CauHoi;
        $cauhoi->ten_cauhoi = $req->ten_cauhoi;
        // $cauhoi->noi_dung = ($req->noi_dung);
        $cauhoi->dap_an_1 = ($req->dap_an_1);
        $cauhoi->dap_an_2 = ($req->dap_an_2);
        $cauhoi->dap_an_3 = ($req->dap_an_3);
        $cauhoi->dap_an_4 = ($req->dap_an_4);
        $cauhoi->dap_an_dung = ($req->dap_an_dung);
        $cauhoi->noi_dung = strip_tags($req->noi_dung);
        // $cauhoi->dap_an_1 = strip_tags($req->dap_an_1);
        // $cauhoi->dap_an_2 = strip_tags($req->dap_an_2);
        // $cauhoi->dap_an_3 = strip_tags($req->dap_an_3);
        // $cauhoi->dap_an_4 = strip_tags($req->dap_an_4);
        // $cauhoi->dap_an_dung = strip_tags($req->dap_an_dung);
        $cauhoi->id_baihoc = $req->id_baihoc;
        $cauhoi->id_admin = Auth::user()->id_admin;
        $cauhoi->id_loaicauhoi = $req->id_loaicauhoi;
        $cauhoi->save();

        if ($cauhoi){
            return redirect('dashboard/cauhoi/them')->with('success','Bạn đã thêm thành công!');
        }
        else {
            return redirect('dashboard/cauhoi/them')->with('error','Thất bại, vui lòng thử lại!!');
        }
    }
    public function editGet($id){
        $cauhoi = CauHoi::find($id);
        return view('cau-hoi.edit',['cauhoi'=>$cauhoi,
        'titlePage'=>'Quản lý câu hỏi', 'breadcrumb'=> 'Chỉnh sửa câu hỏi', 'linkPage'=>'/dashboard/cauhoi'
        ]);
    }
    public function editPost(Request $req, $id){
        $cauhoi = CauHoi::find($id);
        $this->validate($req,
    	[
    		'ten_cauhoi'=>'required|min:2',
            'noi_dung' => 'required',
            'dap_an_dung'=>'required',
            'id_baihoc'=>'required',
            'id_loaicauhoi'=>'required'
        ],
    	[
    		'ten_cauhoi.required'=>'bạn chưa nhập tên câu hỏi ',
            'ten_cauhoi.min'=>'tên câu hỏi ít nhất 2 ký tự',
            'noi_dung.required'=>'bạn chưa nhập nội dung câu hỏi ',
            'dap_an_dung.required'=>'bạn chưa nhập đáp án đúng',
            'id_loaicauhoi.required'=>'bạn chọn loại câu hỏi',
            'id_baihoc.required'=>'bạn chọn bài học',
    	]);

        $cauhoi->ten_cauhoi = $req->ten_cauhoi;
        $cauhoi->noi_dung = strip_tags($req->noi_dung);
        $cauhoi->dap_an_1 =($req->dap_an_1);
        $cauhoi->dap_an_2 =($req->dap_an_2);
        $cauhoi->dap_an_3 =($req->dap_an_3);
        $cauhoi->dap_an_4 =($req->dap_an_4);
        $cauhoi->dap_an_dung =($req->dap_an_dung);
        $cauhoi->id_baihoc = $req->id_baihoc;
        $cauhoi->id_admin = Auth::user()->id_admin;
        $cauhoi->id_loaicauhoi = $req->id_loaicauhoi;
        $cauhoi->save();

        if ($cauhoi){
            return redirect('dashboard/cauhoi/'.$id)->with('success','Bạn đã thay đổi thành công!');
        }
        else {
            return redirect('dashboard/cauhoi'.$id)->with('errors','Thất bại, vui lòng thử lại!!');
        }
    }
}