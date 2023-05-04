<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Admin
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

        // if (Auth::check()->user()->role==1) {
        //     return redirect()->route('admin');
        // }

        // if (Auth::check()->user()->role==1) {
        //     return redirect()->route('giangvien');
        // }
        if(Auth::check())
            {
                if(Auth::user()->role_id==1)
                    return $next($request);
                
                else
                    return redirect('/dashboard');
            }
            
    }
}

