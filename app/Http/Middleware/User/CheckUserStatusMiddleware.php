<?php

namespace App\Http\Middleware\User;

use Closure;
use Auth;

class CheckUserStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
        if(Auth::check() && Auth::user()->status == '1' && Auth::user()->level_user =="staf_tu"){
                // Auth::logout();
                return redirect('/staf_tu/dashboard');
            
        }
        elseif(Auth::check() && Auth::user()->status == '1' && Auth::user()->level_user =="pimpinan"){
            // Auth::logout();
            return redirect('/pimpinan/dashboard');
        }
        elseif(Auth::check() && Auth::user()->status == '0' && Auth::user()->level_user =="staf_tu"){
            Auth::logout();
            // return redirect('/staf_tu/dashboard');
        }
        elseif(Auth::check() && Auth::user()->status == '0' && Auth::user()->level_user =="pimpinan"){
            Auth::logout();
            // return redirect('/pimpinan/dashboard');
        }
        else{
            Auth::logout();
        }
        return $response;
    }
}
