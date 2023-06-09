<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\AdminInfoController;
use App\Http\Controllers\HocVienController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ChuDeController;
use App\Http\Controllers\BaiTapController;
use App\Http\Controllers\BaiHocController;
use App\Http\Controllers\BaiDangController;
use App\Http\Controllers\LoaiCauHoiController;
use App\Http\Controllers\CauHoiController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\QuyenController;
use App\Http\Controllers\LamBaiTapController;
use App\Http\Controllers\LienHeController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\ThongTinLamBaiController;
use App\Http\Controllers\QuaTrinhOnTapController;
use App\Http\Controllers\ThongKeController;




Route::get('/', function () {
return view('welcome');
});




//admin
// Route::get('/dashboard',function(){

Route::post('admin-password/email',[ForgotPasswordController::class,'sendResetLinkEmail'])->name('admin.password.email');
Route::get('admin-password/reset',[ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
Route::post('admin-password/reset',[ResetPasswordController::class, 'reset'])->name('admin.password.update');
Route::get('admin-password/reset/{token}',[ResetPasswordController::class,'showResetForm'])->name('admin.password.reset');
Route::get('/admin',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');
// Route::get('/dashboard/profile',[AdminInfoController::class, 'getProfile'])->name('admin.profile')->middleware(['auth:admin', 'admin']);

Route::middleware(['auth:admin'])->group(function () {
Route::get('/dashboard',[DashBoardController::class,'index'])->name('quanly.trangchu');
Route::get('/dashboard/profile',[AdminInfoController::class, 'getProfile'])->name('admin.profile');
Route::post('/dashboard/profile',[AdminInfoController::class, 'update']);
Route::get('/dashboard/profile/xoa',[AdminInfoController::class, 'destroy']);
//quyền của quản trị viên
Route::middleware(['admin'])->group(function () {
    //quản lý học viên
    Route::prefix('/dashboard/hocvien')->group(function () {
        Route::get('/',[HocVienController::class,'getDanhsach'])->name('quanly.hocvien');
        Route::get('/xoa/{id}',[HocVienController::class,'xoaHocvien']);
        Route::get('/{id}',[HocVienController::class,'xemchitiet']);
        Route::delete('/selected',[HocVienController::class, 'deleteAll'])->name('hocvien.delete.all');
        Route::delete('/selected/{id}',[HocVienController::class, 'deleteBT'])->name('hocvienBT.delete.all');
        Route::delete('/selectedBD/{id}',[HocVienController::class, 'deleteBD'])->name('hocvienBD.delete.all');
    });
    //quản lý quản trị viên
    Route::prefix('/dashboard/quantrivien')->group(function () {
        Route::get('/',[AdminInfoController::class,'index'])->name('quanly.quantrivien');
        Route::get('/xoa/{id}',[AdminInfoController::class,'xoa']);
        // Route::get('/{id}',[AdminInfoController::class,'xemchitiet']);
        Route::get('/them',[AdminInfoController::class,'themGet'])->name('quanly.quantrivien.them');
        Route::post('/them',[AdminInfoController::class,'themPost']);
        Route::get('/{id}',[AdminInfoController::class,'xemchitietGet']);
        Route::post('/{id}',[AdminInfoController::class,'xemchitietPost']);
        Route::delete('/selected',[AdminInfoController::class, 'deleteAll'])->name('admin.delete.all');
    });
    //quản lý quyền quản trị
    Route::prefix('/dashboard/quyen')->group(function () {
        Route::get('/',[QuyenController::class,'index'])->name('quanly.quyen');
        Route::post('/',[QuyenController::class,'addPost']);
        Route::get('/{id}',[QuyenController::class,'editPost']);
        Route::get('/xoa/{id}',[QuyenController::class,'delete']);
        Route::delete('/selected',[QuyenController::class, 'deleteAll'])->name('quyen.delete.all');
        
    });
    //quản lý bài đăng
    Route::prefix('/dashboard/baiviet')->group(function () {
        Route::get('/',[BaiDangController::class, 'index'])->name('quanly.baidang');
        Route::get('/xoa/{id}',[BaiDangController::class, 'delete']);
        Route::get('/{id}',[BaiDangController::class, 'detailGet']);
        Route::delete('/selected',[BaiDangController::class, 'deleteAll'])->name('baidang.delete.all');
        
    });
    Route::get('/dashboard/binhluan/{id}/xoa', [BinhLuanController::class, 'deleteAdmin']);
    //Quản lý liên hệ
    Route::prefix('/dashboard/lienhe')->group(function () {
        Route::get('/',[LienHeController::class, 'store']);
        Route::get('/{id}',[LienHeController::class, 'detail']);
        Route::post('/{id}',[LienHeController::class, 'send']);
        Route::get('/xoa/{id}',[LienHeController::class, 'delete']);
        Route::delete('/selected',[LienHeController::class, 'deleteAll'])->name('lienhe.delete.all');
    });
    
});
    //quản lý chủ đề
    Route::prefix('/dashboard/chude')->group(function () {
        Route::get('/',[ChuDeController::class,'index'])->name('quanly.chude');
        Route::post('/',[ChuDeController::class,'addPost']);
        Route::get('/{id_chude}',[ChuDeController::class,'editPost']);
        Route::get('/xoa/{id_chude}',[ChuDeController::class,'delete']);
        Route::delete('/selected',[ChuDeController::class, 'deleteAll'])->name('chude.delete.all');
    });
    //quản lý bài học
    Route::prefix('/dashboard/baihoc')->group(function () {
        Route::get('/', [BaiHocController::class, 'index'])->name('quanly.baihoc');
        Route::get('/them', [BaiHocController::class, 'addGet'])->name('quanly.baihoc.them');
        Route::post('/them', [BaiHocController::class, 'addPost']);
        Route::post('/them/images', [ImageController::class,'store'])->name('images.upload');
        Route::get('/xoa/{id_baihoc}',[BaiHocController::class,'destroy']);
        Route::get('/{id_baihoc}',[BaiHocController::class,'editGet']);
        Route::post('/{id_baihoc}',[BaiHocController::class,'editPost']);
        Route::delete('/selected',[BaiHocController::class, 'deleteAll'])->name('baihoc.delete.all');

    });
    
    //quản lý loại câu hỏi
    Route::prefix('/dashboard/loaicauhoi')->group(function () {
        Route::get('/',[LoaiCauHoiController::class,'index'])->name('quanly.loaicauhoi');
        Route::post('/',[LoaiCauHoiController::class,'addPost']);
        Route::get('/xoa/{id}',[LoaiCauHoiController::class,'delete']);
        Route::get('/{id}',[LoaiCauHoiController::class,'editPost']);
        Route::delete('/selected',[LoaiCauHoiController::class, 'deleteAll'])->name('loaicauhoi.delete.all');
    });
    //quản lý câu hỏi
    Route::prefix('dashboard/cauhoi')->group(function () {
        Route::get('/', [CauHoiController::class,'index'])->name('quanly.cauhoi');
        Route::get('/xoa/{id}',[CauHoiController::class,'delete']);
        Route::get('/them',[CauHoiController::class,'addGet'])->name('quanly.cauhoi.them');
        Route::post('/them',[CauHoiController::class,'addPost']);
        Route::get('/{id}',[CauHoiController::class,'editGet']);
        Route::post('/{id}',[CauHoiController::class,'editPost']);
        Route::delete('/selected',[CauHoiController::class, 'deleteAll'])->name('cauhoi.delete.all');
        Route::post('/', [CauHoiController::class,'import']);
    });
    //quản lý bài tập
    Route::prefix('/dashboard/baitap')->group(function () {
        Route::get('/',[BaiTapController::class,'index'])->name('quanly.baitap');
        Route::get('/xoa/{id_baitap}',[BaiTapController::class,'delete']);
        // Route::delete('/selected',[BaiTapController::class, 'deleteAll'])->name('cauhoi.delete.all');
        Route::post('/',[BaiTapController::class,'add']);
        // Route::get('/{id_baitap}',[BaiTapController::class,'editGet']);
        Route::get('/{id_baitap}',[BaiTapController::class,'editPost']);
        Route::delete('/selected',[BaiTapController::class, 'deleteAll'])->name('baitap.delete.all');


    });
    Route::prefix('/dashboard/thongke')->group(function () {
        Route::get('/', [ThongKeController::class, 'index'])->name('quanly.thongke');
    });
    //Quản lý thông tin bài làm
    Route::prefix('/dashboard/thongtinlambai')->group(function () {
        Route::get('/{slug}', [ThongTinLamBaiController::class, 'detail']);
        Route::get('/', [ThongTinLamBaiController::class,'index'])->name('quanly.thongtinlambai');
        Route::get('/xoa/{slug}', [ThongTinLamBaiController::class,'delete']);
        Route::delete('/selected',[ThongTinLamBaiController::class, 'deleteAll'])->name('thongtinlambai.delete.all');
        Route::get('/{slug}/{id_hocvien}', [ThongTinLamBaiController::class, 'view']);
        Route::get('/{slug}/{id_hocvien}/xoa', [ThongTinLamBaiController::class, 'deleteOne']);
        
    });
});
//Học bài

Route::middleware(['hocvien'])->group(function () {
    
    Route::prefix('/bai-hoc')->group(function () {
        Route::get('/danh-sach-da-luu',[BaiHocController::class,'daLuu']);
        Route::get('/{slug}', [BaiHocController::class,'viewDetail']);
        Route::post('/{slug}',[BaiHocController::class, 'Luubaihoc']);
        Route::get('/{slug}/huy',[BaiHocController::class, 'xoaLuu']);
    });
    Route::middleware(['lambai'])->group(function () {
        Route::prefix('/bai-tap')->group(function () {
        Route::get('/{slug}', [LamBaiTapController::class,'index']);
        Route::post('/{slug}', [LamBaiTapController::class, 'luubailam']);
        Route::get('/{slug}/nop', [LamBaiTapController::class, 'NopBaiLam']);
    });
    });
    Route::prefix('/bai-tap')->group(function () {
        Route::get('/{slug}/ketqua', [LamBaiTapController::class, 'KetQua']);
    });

    Route::prefix('/goc-hoi-dap')->group(function () {
        Route::get('/danh-sach', [BaiDangController::class,'indexMine'])->name('baidang.canhan.index');
        Route::get('/them-moi', [BaiDangController::class,'addGet']);
        Route::post('/them-moi', [BaiDangController::class,'addPost']);
    });
    Route::middleware(['editPost'])->group(function (){
        Route::prefix('/goc-hoi-dap')->group(function () {
            Route::get('/{slug}/chinh-sua', [BaiDangController::class,'editGet']);
            Route::post('/{slug}/chinh-sua',[BaiDangController::class,'editPost']);
            Route::get('/{slug}/xoa',[BaiDangController::class,'deleteMine']);
        });
    });
    Route::post('/comment/store', [BinhLuanController::class, 'store'])->name('comment.add');
    Route::post('/reply/store', [BinhLuanController::class, 'replyStore'])->name('reply.add');
    Route::get('/comment/{id}/xoa', [BinhLuanController::class, 'delete']);
    Route::post('/comment/edit', [BinhLuanController::class, 'edit'])->name('comment.edit');
    Route::get('/thong-tin-ca-nhan', [HocVienController::class, 'viewDetail'])->name('user.profile');
    Route::post('/thong-tin-ca-nhan', [HocVienController::class, 'editDetail']);
    Route::get('/thong-tin-ca-nhan/xoa', [HocVienController::class, 'deleteDetail']);
    Route::get('/qua-trinh-on-tap', [QuaTrinhOnTapController::class, 'index']);
    Route::get('/qua-trinh-on-tap/{slug}', [QuaTrinhOnTapController::class, 'viewDetail']);
});
Route::get('/bai-hoc', [BaiHocController::class,'indexPage'])->name('baihoc.index');
Route::get('/goc-hoi-dap', [BaiDangController::class,'indexPage'])->name('baidang.index');
Route::get('/goc-hoi-dap/{slug}', [BaiDangController::class,'viewDetail']);
// Route::prefix('/bai-hoc')->group(function () {
//     Route::get('/danh-sach-da-luu',[BaiHocController::class,'daLuu'])->middleware('hocvien');
//     Route::get('/', [BaiHocController::class,'indexPage'])->name('baihoc.index');
//     Route::get('/{slug}', [BaiHocController::class,'viewDetail'])->middleware('hocvien');
//     Route::get('/{slug}/luu',[BaiHocController::class, 'Luubaihoc']);
//     Route::get('/{slug}/huy',[BaiHocController::class, 'xoaLuu']);
    
// });
// Làm bài tập
// Route::prefix('/bai-tap')->group(function () {
//     Route::get('/{slug}', [LamBaiTapController::class,'index']);
//     Route::post('/{slug}', [LamBaiTapController::class, 'luubailam']);
//     Route::get('/{slug}/nop', [LamBaiTapController::class, 'NopBaiLam']);
//     Route::get('/{slug}/ketqua', [LamBaiTapController::class, 'KetQua']);
// })->middleware('hocvien');
//Bài viết
// Route::prefix('/goc-hoi-dap')->group(function () {
//     Route::get('/', [BaiDangController::class,'indexPage'])->name('baidang.index');
//     Route::get('/danh-sach', [BaiDangController::class,'indexMine'])->name('baidang.canhan.index')->middleware('hocvien');
//     Route::get('/them-moi', [BaiDangController::class,'addGet'])->middleware('hocvien');
//     Route::post('/them-moi', [BaiDangController::class,'addPost'])->middleware('hocvien');
//     Route::get('/{slug}/chinh-sua', [BaiDangController::class,'editGet']);
//     Route::post('/{slug}/chinh-sua',[BaiDangController::class,'editPost']);
//     Route::get('/{slug}', [BaiDangController::class,'viewDetail']);
//     Route::get('/{slug}/xoa',[BaiDangController::class,'deleteMine']);
// });

//Liên hệ
Route::get('/lien-he',[LienHeController::class,'index']);
Route::post('/lien-he',[LienHeController::class, 'sendMail']);
//Thông tin học viên
// Route::middleware(['hocvien'])->group(function () {
//     Route::get('/thong-tin-ca-nhan', [HocVienController::class, 'viewDetail'])->name('user.profile');
//     Route::post('/thong-tin-ca-nhan', [HocVienController::class, 'editDetail']);
//     Route::get('/thong-tin-ca-nhan/xoa', [HocVienController::class, 'deleteDetail']);
// });
// //Quá trình ôn tập
// Route::get('/qua-trinh-on-tap', [QuaTrinhOnTapController::class, 'index'])->middleware('hocvien');
// Route::get('/qua-trinh-on-tap/{slug}', [QuaTrinhOnTapController::class, 'viewDetail'])->middleware('hocvien');
Route::prefix('ajax')->group(function () {
    Route::get('/cauhoi',[AjaxController::class,'getBaiHoc'])->name('ajax.cauhoi');
    Route::get('/baitap',[AjaxController::class,'getBaiTap'])->name('ajax.baitap');
    Route::get('/tencauhoi',[AjaxController::class,'GetTenCauHoi'])->name('ajax.tencauhoi');
});



Auth::routes(['verify' => true]);