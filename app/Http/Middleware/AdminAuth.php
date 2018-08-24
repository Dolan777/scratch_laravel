<?php 
namespace App\Http\Middleware;
use Closure;
use Auth;
class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function handle($request, Closure $next)
//    {
//        return $next($request);
//    }
      public function handle($request, Closure $next, $guard = 'admin')
    {
         
        if (Auth::guard($guard)->guest()) {
           
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/admin-login');
            }
        }

        return $next($request);
    }
}
