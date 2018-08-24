<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Model\LoginHistory;
use App\Model\UserMaster;

class LoginHistoryController extends AdminController
{
   public function index() {

        return view('admin.login_history.index');
    }

    public function get_list() {
        $categories = LoginHistory::select(['id', 'user_master_id', 'ip', 'created_at']);
        return Datatables::of($categories)
                       
                        ->editColumn('user_master_id', function($model) {
                            $model=  UserMaster::find($model->user_master_id);
                            return $model->first_name . " " . $model->last_name;
                        })
                       
                       
                        ->make(true);
    }
}
