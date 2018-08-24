<?php

namespace Modules\Admin\Http\Controllers;

use Validator;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\UserMaster;
use App\Model\UserType;
use App\Model\LoginHistory;

class AuthController extends AdminController {

    public function __construct() {

        if (\Route::current()->getName() != "admin-logout") {
            $this->auth_check();
        }
    }

    public function auth_check() {
        if (!Auth()->guard('admin')->guest()) {
            Redirect('/admin/admin-dashboard')->send();
        }
    }

    public function index() {
        return view('admin.auth.login');
    }

    public function post_login(Request $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required|min:6'
        ]);

        if ($validator->passes()) {
            $model = UserMaster::where('email', $request->email)
//                            ->where('password', Hash::make($request->password))
                            ->whereIn('type_id', [1,4])
                            ->where('status', '1')
                            ->get()->first();


            if (count($model) == 1) {

                if (Hash::check($request->password, $model->password)) {
                    Auth::guard('admin')->login($model);

                    $ip = get_user_ip();
                    
                    //---------Previous user logout------------
                    $prev_login = \App\Model\LoginHistory::where('user_master_id', Auth()->guard('admin')->id())->where('ip', $ip)->orderBy('id', 'DESC')->get()->first();
                    if (count($prev_login) == 1) {
                        if ($prev_login->type == 'login') {

                            $minutes_to_add = 60;
                            $time = new \DateTime(date('Y-m-d H:i:s'));
                            $time->add(new \DateInterval('PT' . $minutes_to_add . 'M'));
                            $stamp = $time->format('Y-m-d H:i:s');
                            
                            if (date('Y-m-d H:i:s') > $stamp) {
                                $upd_time = $stamp;
                            } else {
                                $upd_time = date('Y-m-d H:i:s');
                            }

                            $login = new LoginHistory();
                            $login->user_master_id = Auth()->guard('admin')->user()->id;
                            $login->type = 'logout';
                            $login->ip = $ip;
                            $login->created_at = $upd_time;
                            $login->save();
                        }
                    }


                    $login = new LoginHistory();
                    $login->user_master_id = Auth()->guard('admin')->user()->id;
                    $login->type = 'login';
                    $login->ip = $ip;
                    $login->created_at = date('Y-m-d H:i:s');
                    $login->save();


                    return redirect()->route('admin-dashboard')->with('success_msg', 'You have successfully login');
                } else {
                    return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Login Failed!! Please check your credentials');
                }
            } else {
                return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Login Failed!! Please check your credentials');
            }
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Login Failed!! Please check the below error');
        }
    }

    public function logout() {
        $ip = get_user_ip();
        $login = new LoginHistory();
        $login->user_master_id = Auth()->guard('admin')->user()->id;
        $login->type = 'logout';
        $login->ip = $ip;
        $login->created_at = date('Y-m-d H:i:s');
        $login->save();
        Auth::guard('admin')->logout();
        return redirect('admin/admin-login')->with('success_msg', 'You have been successfully logout !!');
    }

}
