<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
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
        if ( Auth::user()->status_id == statusOrder('inactive')) {
            return redirect()->route('complete-registration');
            exit();
        }

        return $next($request);
    }
}
