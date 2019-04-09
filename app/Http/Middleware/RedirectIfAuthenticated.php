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
                if (Auth::guard($guard)->check()) {
                    if(Auth::user()->level_user == "staf_tu")
                    {
                        return redirect('/staf_tu/dashboard');
                    }
                    elseif(Auth::user()->level_user == "pimpinan")
                    {
                        return redirect('/pimpinan/dashboard');
                    }
                }
                break;
        }
        
        return $next($request);
    }
}
