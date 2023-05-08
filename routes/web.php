<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
return view('welcome');
});

Auth::routes(['verify' => true]);


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
//quyền của quản trị viên
Route::middleware(['admin'])->group(function () {
    //quản lý học viên
    Route::prefix('/dashboard/hocvien')->group(function () {
        Route::get('/',[HocVienController::class,'getDanhsach'])->name('quanly.hocvien');
        Route::get('/xoa/{id}',[HocVienController::class,'xoaHocvien']);
        Route::get('/{id}',[HocVienController::class,'xemchitiet']);
        Route::delete('/selected',[HocVienController::class, 'deleteAll'])->name('hocvien.delete.all');
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
        
    });
    //quản lý bài đăng
    Route::prefix('/dashboard/baidang')->group(function () {
        Route::get('/',[BaiDangController::class, 'index'])->name('quanly.baidang');
        Route::get('/xoa/{id}',[BaiDangController::class, 'delete']);
        Route::get('/{id}',[BaiDangController::class, 'detailGet']);
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
    });
    //quản lý bài tập
    Route::prefix('/dashboard/baitap')->group(function () {
        Route::get('/',[BaiTapController::class,'index'])->name('quanly.baitap');
        Route::get('/xoa/{id_baitap}',[BaiTapController::class,'delete']);
        // Route::delete('/selected',[BaiTapController::class, 'deleteAll'])->name('cauhoi.delete.all');
        Route::post('/',[BaiTapController::class,'add']);
        Route::get('/{id_baitap}',[BaiTapController::class,'editGet']);
        Route::post('/{id_baitap}',[BaiTapController::class,'editPost']);
        Route::delete('/selected',[BaiTapController::class, 'deleteAll'])->name('baitap.delete.all');


    });
});
Route::get('/baihoc', [BaiHocController::class,'indexPage'])->name('baihoc.index');
Route::prefix('ajax')->group(function () {
    Route::get('/cauhoi',[AjaxController::class,'getBaiHoc'])->name('ajax.cauhoi');
    
});



