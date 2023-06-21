<?php

namespace App\Http\Middleware;

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

        if (KetQua::where('id_hocvien', Auth::user()->id)->where('id_baitap', $id->id_baitap)->count()===3){
            return redirect()->back()->with('error', 'Bạn không còn quyền truy cập vào trang này.');
        }
        else {
            return $next($request);
        }
    }
}
