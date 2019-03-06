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
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->level == "administrator")
            {
                return redirect('/admin/dashboard');
            }
            elseif(Auth::user()->level == "staf_tu")
            {
                return redirect('/staf_tu/dashboard');
            }
            elseif(Auth::user()->level == "pimpinan")
            {
                return redirect('/pimpinan.dashboard');
            }
        }
        
        return $next($request);
    }
}
