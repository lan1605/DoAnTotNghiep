<?php

namespace App\Http\Middleware;

use App\Models\BaiHoc;
use Closure;
use Illuminate\Http\Request;
use App\Models\KetQua;
use App\Models\BaiTap;
use Auth;

class LamBaiTap
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id= BaiTap::where('slug', $request->slug)->first();

        $baihoc = BaiHoc::where('id_baihoc', $id->id_baihoc)->first();
        if (KetQua::where('id_hocvien', Auth::user()->id)->where('id_baitap', $id->id_baitap)->where('tong_diem','!=',null)->count()==3){
            return redirect('bai-hoc/'.$baihoc->slug)->with('error', 'Bạn không còn quyền truy cập vào trang này.');
        }
        else {
            return $next($request);
        }
    }
}
