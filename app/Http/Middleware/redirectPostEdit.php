<?php

namespace App\Http\Middleware;

use App\Models\BaiDang;
use Closure;
use Illuminate\Http\Request;
use Auth;

class redirectPostEdit
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
        // $slug = $request->slug;

        $id = BaiDang::where('slug',$request->slug)->first();
        if (BaiDang::where('id', $id->id)->where('id_hocvien', Auth::user()->id)->count()===0){
            return redirect()->back();
        }
        else {
            return $next($request);
        }
        
    }
}
