<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard){
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.dashboard');
                }
                break;
            default:
            if(Auth::check() && Auth::user()->status == '1' && Auth::user()->level_user =="staf_tu"){
                // Auth::logout();
                return "berhasil";
                // return redirect('/staf_tu/dashboard');
            
            }
            elseif(Auth::check() && Auth::user()->status == '1' && Auth::user()->level_user =="pimpinan"){
                // Auth::logout();
                return redirect('/pimpinan/dashboard');
            }
            elseif(Auth::check() && Auth::user()->status == '0' && Auth::user()->level_user =="staf_tu"){
                // Auth::logout();
                return "gagal";
                // return redirect('/staf_tu/dashboard');
            }
            elseif(Auth::check() && Auth::user()->status == '0' && Auth::user()->level_user =="pimpinan"){
                Auth::logout();
                // return redirect('/pimpinan/dashboard');
            }
            else{
                Auth::logout();
            }
                    break;
            }
        
        return $next($request);
    }
}
