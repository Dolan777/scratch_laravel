<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Model\UserMaster;
use Hash;

class DashboardController extends AdminController {

    public function index() {
        $data_msg = [];
        $data_msg['total_artist'] = UserMaster::where('type_id', 2)->where('status', '1')->get()->count();
        $data_msg['total_customer'] = UserMaster::where('type_id', 3)->where('status', '1')->get()->count();
        return view('admin.dashboard.index', $data_msg);
    }

    public function get_profile() {
        $model = UserMaster::find(Auth()->guard('admin')->user()->id);
        return view('admin.dashboard.profile', ['model' => $model]);
    }

    public function post_profile(Request $request) {
        $validator = Validator::make($request->all(), [
                    'full_name' => 'required',
                    'email' => 'required|email',
        ]);
        $validator->after(function($validator)use ($request) {
            $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', 3)->where('id', '<>', Auth()->guard('admin')->user()->id)->get();
            if (count($other_user) > 0) {
                $validator->errors()->add('email', 'Email id already in use.');
            }
        });
        if ($validator->passes()) {
            $model = UserMaster::find(Auth()->guard('admin')->user()->id);
            $model->full_name = $request->input('full_name');
            $model->email = $request->input('email');
            $model->save();
            $request->session()->flash('success_msg', 'Profile updated successfully.');
        }
        return redirect()->route('admin-profile')->withErrors($validator)->withInput();
    }

    public function get_change_password() {
        $model = UserMaster::find(Auth()->guard('admin')->user()->id);
        return view('admin.dashboard.change_password', ['model' => $model]);
    }

    public function post_change_password(Request $request) {
        $validator = Validator::make($request->all(), [
                    'current_password' => 'required',
                    'password' => 'required|min:6|max:16|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
                    'confirm_password' => 'required|same:password',
                        ], [
                    'password.regex' => 'Password must contain at-least 1 capital letter, 1 small letter and 1 number.'
        ]);
        $validator->after(function($validator)use ($request) {
            $other_user = UserMaster::where('id', Auth()->guard('admin')->user()->id)->get()->first();
            if (Hash::check($request->input('current_password'), $other_user->password) == false) {
                $validator->errors()->add('current_password', 'Your current password does not match.');
            }
        });
        if ($validator->passes()) {
            $model = UserMaster::find(Auth()->guard('admin')->user()->id);
            $model->password = Hash::make($request->input('password'));
            $model->save();
            $request->session()->flash('success_msg', 'Password updated successfully.');
        }
        return redirect()->route('admin-change-password')->withErrors($validator)->withInput();
    }

    public function get_change_image() {
        $model = UserMaster::where('id', Auth::guard('admin')->id())->get()->first();
        return view('admin.dashboard.change_image', ['model' => $model]);
    }

    public function post_change_image(Request $request) {
        $validator = Validator::make($request->all(), [
                    'image' => 'required|mimes:png,jpeg,jpg,JPEG,gif'
        ]);
        if ($validator->passes()) {
            $model = UserMaster::where('id', Auth::guard('admin')->id())->get()->first();
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $model->image = $imagename;
            }
            $model->save();
            return redirect()->route('user-change-image')->with('success_msg', 'Profile image updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

}
