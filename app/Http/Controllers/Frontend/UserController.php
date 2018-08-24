<?php

namespace App\Http\Controllers\Frontend;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;
use Session;
use Auth;
use App\Model\UserMaster;
use App\Model\Product;
use Image;
use File;

class UserController extends FrontController {

  
    public function dashboard() {



        return view('frontend.user.dashboard');
    }


}
