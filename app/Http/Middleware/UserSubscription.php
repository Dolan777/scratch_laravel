<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\UserMaster;
use Auth;

class UserSubscription {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $model = UserMaster::where('id', Auth::guard('user')->user()->id)
                        ->where('subscription_start', '1')
                        ->get()->first();
        if (count($model) == 1) {
            if ($model->next_subscription_date == NULL || $model->next_subscription_date == date('Y-m-d')) {
                return redirect()->route('subscription');
            } else {
                return $next($request);
            }
        } else {
            return $next($request);
        }
    }

}
