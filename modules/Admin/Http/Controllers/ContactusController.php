<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Contactus;
use Yajra\Datatables\Datatables;

class ContactusController extends AdminController {

    public function index(Request $request) {
        return view('admin.contactus.index');
    }

    public function get_list() {
        $email = Contactus::select(['id', 'name', 'email', 'subject', 'status', 'created_at']);
        return Datatables::of($email)
                        ->addColumn('action', function ($model) {
                            return '<a href="' . Route("contactus-view", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> View</a>';
                        })
                        ->make(true);
    }

    public function get_view($id = "") {
        if ($id == "") {
            return redirect()->route('contactus');
        }
        $model = Contactus::find($id);
        if (empty($model)) {
            return redirect()->route('contactus')->with('error_msg', 'Data Not found.');
        }
        return view('admin.contactus.view', ['model' => $model]);
    }

}
