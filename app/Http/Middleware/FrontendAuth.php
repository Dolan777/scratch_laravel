<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class FrontendAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'user')
    {
       if (Auth::guard($guard)->guest()) {
           
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                
                return redirect()->route('/',['return_url'=>$request->url()])->with('error_msg','Please login first!!');
            }
        }

        return $next($request);
    }
}
