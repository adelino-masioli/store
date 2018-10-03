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
            if(Auth::user()->type_id == 4){
                return redirect('/admin/orders-financial');
            }else if(Auth::user()->type_id == 5){
                return redirect('/dashboard');
            }else{
                return redirect('/admin/dashboard');
            }
        }

        return $next($request);
    }
}
