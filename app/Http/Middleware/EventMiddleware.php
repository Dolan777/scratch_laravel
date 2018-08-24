<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\EventMaster;

class EventMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->session()->has('photo_event')) {
            $value = $request->session()->get('photo_event');
            $value = base64_decode($value);
            $value = explode(('-'), $value);
            $m = EventMaster::where('event_code', $value[0])->where('event_token', $value[1])->count();
            if ($m == 1) {
                return $next($request);
            } else {
                return redirect('/')->with('error_msg', 'Unauthorize access!!');
            }
        } else {
            return redirect('/')->with('error_msg', 'Unauthorize access!!');
        }
    }

}
