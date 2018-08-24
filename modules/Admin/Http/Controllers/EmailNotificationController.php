<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\EmailNotification;
use Yajra\Datatables\Datatables;
use Validator;

class EmailNotificationController extends AdminController {

    public function index(Request $request) {
        return view('admin.emailNotification.index');
    }

    public function get_list() {
        $email = EmailNotification::select(['id', 'email_code', 'subject', 'about']);
        
        return Datatables::of($email)
                        ->addColumn('action', function ($model) {
                                    return '<a href="' . Route("emailNotification-edit", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-pencil"></i> Edit</a>';
                                })
                        ->make(true);
    }

    public function get_edit($id = "") {
        if ($id == "") {
            return redirect()->route('emailNotification');
        }
        $model = EmailNotification::find($id);
        if (empty($model)) {
            return redirect()->route('emailNotification')->with('error_msg', 'Data Not found.');
        }
        return view('admin.emailNotification.edit', ['model' => $model]);
    }

    public function post_edit(Request $request, $id = "") {
        if ($id == "") {
            return redirect()->route('emailNotification');
        }
        $model = EmailNotification::find($id);
        if (empty($model)) {
            return redirect()->route('emailNotification')->with('error_msg', 'Data Not found.');
        }
        $validator = Validator::make($request->all(), [

                    'subject' => 'required',
                    'body' => 'required'
        ]);
        if ($validator->passes()) {
            $model->subject = $request->input('subject');
            $model->about = $request->input('about');
            $model->body = $request->input('body');
            $model->save();
            $request->session()->flash('success_msg', 'Email Notification updated successfully.');
        }
        return redirect()->route('emailNotification-edit', ['id' => $id])->withErrors($validator)->withInput();
    }

}
