<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cmspage;
use Yajra\Datatables\Datatables;
use Validator;

class CmspageController extends AdminController {

    public function index(Request $request) {
        return view('admin.cmspage.index');
    }

    public function get_list() {
        $email = Cmspage::select(['*'])->orderBy('id', 'DESC');
        return Datatables::of($email)
                        ->addColumn('action', function ($model) {
                            return '<a href="' . Route("cmspage-edit", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-pencil"></i> Edit</a>';
                        })
                        ->make(true);
    }

    public function get_edit($id = "") {
        if ($id == "") {
            return redirect()->route('cmspage');
        }
        $model = Cmspage::find($id);
        if (empty($model)) {
            return redirect()->route('cmspage')->with('error_msg', 'Data Not found.');
        }
        return view('admin.cmspage.edit', ['model' => $model]);
    }

    public function post_edit(Request $request, $id = "") {
        if ($id == "") {
            return redirect()->route('cmspage');
        }
        $model = Cmspage::find($id);
        if (empty($model)) {
            return redirect()->route('cmspage')->with('error_msg', 'Data Not found.');
        }
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'content' => 'required'
        ]);
        if ($validator->passes()) {
            $model->title = $request->input('title');
            $model->content = $request->input('content');
            $model->save();
            $request->session()->flash('success_msg', 'Cmspage updated successfully.');
        }
        return redirect()->route('cmspage-edit', ['id' => $id])->withErrors($validator)->withInput();
    }

}
