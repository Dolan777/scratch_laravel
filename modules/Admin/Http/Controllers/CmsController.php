<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cms;
use Yajra\Datatables\Datatables;
use Validator;

class CmsController extends AdminController {

    public function index(Request $request) {
        return view('admin.cms.index');
    }

    public function get_list() {
        $email = Cms::select(['*'])->orderBy('page_name', 'ASC');
        return Datatables::of($email)
                        ->addColumn('action', function ($model) {
                            return '<a href="' . Route("cms-edit", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-pencil"></i> Edit</a>';
                        })
                        ->make(true);
    }

    public function get_edit($id = "") {
        if ($id == "") {
            return redirect()->route('cms');
        }
        $model = Cms::find($id);
        if (empty($model)) {
            return redirect()->route('cms')->with('error_msg', 'Data Not found.');
        }
        return view('admin.cms.edit', ['model' => $model]);
    }

    public function post_edit(Request $request, $id = "") {
        if ($id == "") {
            return redirect()->route('cms');
        }
        $model = Cms::find($id);
        if (empty($model)) {
            return redirect()->route('cms')->with('error_msg', 'Data Not found.');
        }
        $validator = Validator::make($request->all(), [
                    'image' => 'mimes:png,jpeg,jpg,JPEG,gif,mp4',
                        ], [
                    'image.mimes' => 'File type not supported. Only jpg, jpeg, JPEG, png, gif and mp4 supported.',
        ]);
        if ($validator->passes()) {
            $model->section_content = $request->input('section_content');
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/cms');
                $sample_image->move($destinationPath, $imagename);
                $model->image = $imagename;
            }
            $model->save();
            $request->session()->flash('success_msg', 'Cms updated successfully.');
        }
        return redirect()->route('cms-edit', ['id' => $id])->withErrors($validator)->withInput();
    }

}
