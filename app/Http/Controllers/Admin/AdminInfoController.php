<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Auth;

class AdminInfoController extends Controller
{
    public function getProfile(){
        $user = Admin::find(Auth::user()->id_admin);
        return view('info.admin', ['user'=>$user,'route' => route('admin.profile'),'titlePage'=>'Thông tin cá nhân','breadcrumb'=>'Thông tin cá nhân']);
    }
    public function update(Request $req){
        $user = Admin::find(Auth::user()->id_admin);
        $this->validate($req,
    	[
    		'name'=>'required|min:2',
            'email'=>'required|email',
            'img_admin'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sdt'=>'required',
            'dia_chi'=>'required'
    	],
    	[
    		'name.required'=>'bạn chưa nhập tên ',
            'name.min'=>'tên người dùng ít nhất 2 ký tự',
            'email.required'=>'bạn chưa nhập email',
            'email.email'=>'email không đúng định dạng',
            'img_admin.required'=>'bạn chưa chọn ảnh',
            'img_admin.max'=>'ảnh của bạn tối đa 2048Kb',
            'img_admin.mimes'=>'ảnh của bạn không đúng định dạng jpeg,png,jpg,gif,svg',
            'sdt.required'=>'bạn chưa nhập số điện thoại',
            'dia_chi.required'=>'bạn chưa nhập địa chỉ'
    	]);

        if ($req->old_password){
            if (Hash::check($req->old_password, $user->password)){
                return back()->with('error_old', 'Không đúng mật khẩu, vui lòng nhập lại');
            }
            else {
                if ($req->hasFile('img_admin')){
                    if (File::exists('admins/'.$user->img_admin)){
                        File::delete('admins/'.$user->img_admin);
                    }
                    $fileName = $req->imgName . '.' . $req->file('img_admin')->extension();        
                    // $req->file('img_admin')->storeAs('profile/admin', $fileName);
                    $req->file('img_admin')->move(public_path('admins'), $fileName);
                    $user->img_admin = $fileName;
                    $user->name = $req->name;
                    $user->email = $req->email;
                    $user->sdt = $req->sdt;
                    $user->gioi_tinh = $req->gioi_tinh;
                    $user->dia_chi = $req->dia_chi;
                    $user->password = Hash::make($req->new_password);
                    $user->save();
                }
                else {
                    $user->name = $req->name;
                    $user->email = $req->email;
                    $user->sdt = $req->sdt;
                    $user->gioi_tinh = $req->gioi_tinh;
                    $user->dia_chi = $req->dia_chi;
                    $user->password = Hash::make($req->new_password);
                    $user->save();
                }
            }
        }
        else {
            if ($req->hasFile('img_admin')){
                if (File::exists('admins/'.$user->img_admin)){
                    File::delete('admins/'.$user->img_admin);
                }
                $fileName = $req->imgName . '.' . $req->file('img_admin')->extension();        
                // $req->file('img_admin')->storeAs('profile/admin', $fileName);
                $req->file('img_admin')->move(public_path('admins'), $fileName);
                $user->img_admin = $fileName;
                $user->name = $req->name;
                $user->email = $req->email;
                $user->sdt = $req->sdt;
                $user->gioi_tinh = $req->gioi_tinh;
                $user->dia_chi = $req->dia_chi;
                $user->save();
            }
            else {
                $user->name = $req->name;
                $user->email = $req->email;
                $user->sdt = $req->sdt;
                $user->gioi_tinh = $req->gioi_tinh;
                $user->dia_chi = $req->dia_chi;
                $user->save();
            }
    }
    if ($user){
        return redirect('/dashboard/profile')->with('success', 'Thay đổi thành công');
    }
    else {
        return redirect('/dashboard/profile')->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }
    }
    public function destroy(){
        $user = Admin::find(Auth::user()->id_admin);

        $user->delete();

        if ($user){
            return redirect('/admin');
        }
    }
    public function index(Request $req){
        $filter =[];
        $keysfilter ='';
        if (!empty($req->find_role)){
            if ($req->find_role==0){
                $filter[]=[];
            }
            else {
                $find_role = $req->find_role;
                $filter[] = ['admins.role_id', '=', $find_role];
            }
        }
        if ($req->key_find!=null){
            $keysfilter = $req->key_find;
        }
        $users = Admin::where($filter)->where(function ($query) use ($keysfilter){
            $query->where('name','like','%'.$keysfilter.'%')->orWhere('email','like','%'.$keysfilter.'%');
        })->orderBy('truy_cap','DESC')->paginate(10);
        return view('admin.manager.list', ['users'=>$users,
                'route' => route('quanly.quantrivien'),
                'titlePage'=>'Quản lý quản trị viên',
                'breadcrumb'=>'Danh sách quản trị viên',
                'linkPage'=>'/dashboard']);
    }
    public function xoa($id){
        $user=Admin::find($id)->delete();
        if ($user){
            return redirect('/dashboard/quantrivien')->with('success','Bạn đã xóa thành công!!');
        }
        else {
            return redirect('/dashboard/quantrivien')->with('error','Thất bại, vui lòng thử lại.');
        }
    }
    public function themGet(){
        return view('admin.manager.add', ['route' => route('quanly.quantrivien.them'),
                'titlePage'=>'Quản lý quản trị viên',
                'breadcrumb'=>'Thêm quản trị viên mới',
                'linkPage'=>'/dashboard/quantrivien']);
    }
    public function themPost(Request $req){
        $this->validate($req,
    	[
    		'name'=>'required|min:2|unique:admins',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:6|max:32',
            'role_id'=>'required',
            'img_admin'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sdt'=>'required',
            'dia_chi'=>'required'
    	],
    	[
    		'name.required'=>'bạn chưa nhập tên ',
            'name.min'=>'tên người dùng ít nhất 2 ký tự',
            'name.unique'=>'tên người dùng đã tồn tại',
            'email.required'=>'bạn chưa nhập email',
            'email.email'=>'email không đúng định dạng',
            'email.unique'=>'email đã tồn tại',
            'password.required'=>'bạn chưa nhập mật khẩu',
            'password.min'=>'mật khẩu ít nhất 6 ký tự và tối đa 32 ký tự',
            'password.max'=>'mật khẩu ít nhất 6 ký tự và tối đa 32 ký tự',
            'role_id.required'=>'bạn chưa chọn quyền quản trị',
            'img_admin.required'=>'bạn chưa chọn ảnh',
            'img.max'=>'ảnh của bạn tối đa 2048Kb',
            'img.mimes'=>'ảnh của bạn không đúng định dạng jpeg,png,jpg,gif,svg',
            'sdt.required'=>'bạn chưa nhập số điện thoại',
            'dia_chi.required'=>'bạn chưa nhập địa chỉ'
    	]);
        if ($req->hasFile('img_admin')){
                $user = new Admin;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->sdt = $req->sdt;
            $user->dia_chi = $req->dia_chi;
            $user->role_id = $req->role_id;
            $adminOld = Admin::max('id_admin');
            // dd($adminOld);  
            if ($adminOld===null){
                $user->id_admin = 'AD-1';
            }
            else{
                $adminNum = explode('-',$adminOld);
                // dd($adminNum);
                $num = (int)$adminNum[1]+1;
                // dd($num);
                $user->id_admin = 'AD-'.$num;
            }
            $user->gioi_tinh = $req->gioi_tinh;
            $fileName = $req->imgName . '.' . $req->file('img_admin')->extension();        
            // $req->file('img_admin')->storeAs('profile/admin', $fileName);
            $req->file('img_admin')->move(public_path('admins'), $fileName);
            $user->img_admin = $fileName;
            $user->save();

            if ($user){
                return redirect('dashboard/quantrivien/them')->with('success','Thêm quản trị viên thành công!!');
            }
            else {
                return redirect('dashboard/quantrivien/them')->with('error','Thêm thất bại, vui lòng thử lại');
            }
        }
        else {
            $user = new Admin;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->sdt = $req->sdt;
        $user->dia_chi = $req->dia_chi;
        $user->role_id = $req->role_id;
        $adminOld = Admin::max('id_admin');
        // dd($adminOld);  
        if ($adminOld===null){
            $user->id_admin = 'AD-1';
        }
        else{
            $adminNum = explode('-',$adminOld);
            // dd($adminNum);
            $num = (int)$adminNum[1]+1;
            // dd($num);
            $user->id_admin = 'AD-'.$num;
        }
        $user->gioi_tinh = $req->gioi_tinh;
        $user->save();

    	if ($user){
            return redirect('dashboard/quantrivien/them')->with('success','Thêm quản trị viên thành công!!');
        }
        else {
            return redirect('dashboard/quantrivien/them')->with('error','Thêm thất bại, vui lòng thử lại');
        }
        }
    }
    public function xemchitietGet($id_admin){
        $user= Admin::find($id_admin);
        return view('admin.manager.edit',['user'=> $user,
        'linkPage'=> '/dashboard/quantrivien',
        'titlePage' => 'Quản lý quản trị viên',
         'breadcrumb'=>'Chỉnh sửa tài khoản của'.$user->ten_admin]);
    }
    public function xemchitietPost(Request $req, $id_admin){
        $user=Admin::find($id_admin);
        $this->validate($req,
    	[
    		'name'=>'required|min:2',
            'email'=>'required|email',
            'img_admin'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sdt'=>'required',
            'dia_chi'=>'required'
    	],
    	[
    		'name.required'=>'bạn chưa nhập tên ',
            'name.min'=>'tên người dùng ít nhất 2 ký tự',
            'email.required'=>'bạn chưa nhập email',
            'email.email'=>'email không đúng định dạng',
            'img_admin.required'=>'bạn chưa chọn ảnh',
            'img_admin.max'=>'ảnh của bạn tối đa 2048Kb',
            'img_admin.mimes'=>'ảnh của bạn không đúng định dạng jpeg,png,jpg,gif,svg',
            'sdt.required'=>'bạn chưa nhập số điện thoại',
            'dia_chi.required'=>'bạn chưa nhập địa chỉ'
    	]);

        if ($req->hasFile('img_admin')){
            if (File::exists('admins/'.$user->img_admin)){
                File::delete('admins/'.$user->img_admin);
            }
        $user->name = $req->name;
        $user->email = $req->email;
        $user->sdt = $req->sdt;
        $user->dia_chi = $req->dia_chi;
        $user->role_id = $req->role_id;
        $user->gioi_tinh = $req->gioi_tinh;
        $fileName = $req->imgName . '.' . $req->file('img_admin')->extension();        
            // $req->file('img_admin')->storeAs('profile/admin', $fileName);
            $req->file('img_admin')->move(public_path('admins'), $fileName);
            $user->img_admin = $fileName;
        $user->save();
        if ($user){
            return redirect('dashboard/quantrivien')->with('success','Thay đổi quản trị viên thành công!!');
        }
        else {
            return redirect('dashboard/quantrivien')->with('error','Thay đổi thất bại, vui lòng thử lại');
        }
        }    
        else{
            $user->name = $req->name;
        $user->email = $req->email;
        $user->sdt   = $req->sdt  ;
        $user->dia_chi = $req->dia_chi;
        $user->role_id = $req->role_id;
        $user->gioi_tinh = $req->gioi_tinh;
        $user->save();
        if ($user){
            return redirect('dashboard/quantrivien')->with('success','Thay đổi quản trị viên thành công!!');
        }
        else {
            return redirect('dashboard/quantrivien')->with('error','Thay đổi thất bại, vui lòng thử lại');
        }
        }
    }
    public function deleteAll(Request $req){
        $id = $req->ids;
        Admin::whereIn('id_admin', $id)->delete();
        // return redirect('/dashboard/quantrivien')->with('success','Bạn đã xóa thành công!');
        return response()->json(['success'=>'Bạn đã xóa thành công']);
    }
}
