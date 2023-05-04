<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Admin;

class QuyenController extends Controller
{
    public function index(Request $req){
        $keysfilter ='';
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
        $roles = Role::where('ten_quyen','like','%'.$keysfilter.'%')->paginate(10);
        return view('admin.quyen.list', ['route'=>route('quanly.quyen'), 'roles'=>$roles,'titlePage'=>'Quản lý quyền quản trị', 'breadcrumb'=> 'Danh sách quyền quản trị']);
    }
    public function addPost(Request $req){
        $this->validate($req,
    	[
    		'ten_quyen'=>'required|min:2|unique:role_admin',
    	],
    	[
    		'ten_quyen.required'=>'bạn chưa nhập tên quyền quản trị ',
            'ten_quyen.min'=>'Tên quyền ít nhất 2 ký tự',
            'ten_quyen.unique' => 'Tên quyền đã tồn tại',
    	]);
        
        $quyen = new Role;
        
        $quyen->ten_quyen = $req->ten_quyen;
        $quyen->save();

        if ($quyen){
            return redirect('/dashboard/quyen')->with('success','Bạn đã thêm thành công!!');
        }
        else {
            return redirect('/dashboard/quyen')->with('error','Thất bại, vui lòng thử lại sau.');
        }
    }
    public function editPost(Request $req, $id){
        $quyen = Role::find($id);
        $this->validate($req,
    	[
    		'ten_quyenEdit'=>'required|min:2',
    	],
    	[
    		'ten_quyenEdit.required'=>'bạn chưa nhập tên quyền  ',
            'ten_quyenEdit.min'=>'Tên quyền ít nhất 2 ký tự',
    	]);
        $quyen->ten_quyen = $req->ten_quyenEdit;
        $quyen->save();

        if ($quyen){
            return redirect('/dashboard/quyen')->with('success','Bạn đã thay đổi thành công!!');
        }
        else {
            return redirect('/dashboard/quyen')->with('error','Thất bại, vui lòng thử lại sau.');
        }
    }
    public function delete($id){
        
        $chude =Role::where('id',$id)->first();
        $chude->delete();
        $admin = Admin::where('role_id', $id);
        if (!empty($admin)){
            $admin->delete();
        }
        // Admin::where('id_role', $id)->delete();


    if ($chude) {
        return redirect('/dashboard/quyen')->with('success','Bạn đã xóa chủ đề thành công!!');
    }

    return redirect('/dashboard/quyen')->with('error','Thất bại, vui lòng thử lại sau.');
} 
}
