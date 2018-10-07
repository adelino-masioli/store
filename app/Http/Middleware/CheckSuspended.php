<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSuspended
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
        //check status
        if(Auth::user()->status_id == statusOrder('inactive')){
            Auth::logout();

            session()->flash('error', 'Favor entrar em contato com o suporte.');
            return redirect('/login');
            exit();
        }

        return $next($request);
    }
}
