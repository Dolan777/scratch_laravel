<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {

        $route=\Route::current()->getName();
            $pages=['admin-login','admin-logout'];
           if (Auth::guest() && !in_array($route, $pages)) {
               
                if ($request->ajax() || $request->wantsJson()) {
                    return response('Unauthorized.', 401);
                } else {
                    return redirect()->route('/');
                }
            } else if (!Auth::guest() && !in_array(Auth::user()->type_id, [1,2])) {
                 
                if ($request->ajax() || $request->wantsJson()) {
                    return response('Unauthorized.', 401);
                } else {
                    return redirect()->route('/');
                }
            }

        return $next($request);
    }

}
