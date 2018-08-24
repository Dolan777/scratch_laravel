<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Guardian
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
        if (Auth::guard('guardian')->check()) {
            
            return $next($request);
        } else {
            return redirect(Url('/'));
        }
    }
}
